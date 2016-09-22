<?php

namespace backend\controllers;

use Yii;
use common\models\University;
use backend\models\UniversitySearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use common\models\Country;
use common\models\State;
use common\models\City;
use common\models\Degree;
use common\models\Majors;
use common\models\UniversityAdmission;
use common\components\Roles;
use common\components\AccessRule;
use backend\models\EmployeeLogin;
use common\models\UniversityCourseList;
use yii\db\Expression;
use yii\helpers\Json;
use yii\web\UploadedFile;
use common\models\FileUpload;
use backend\models\UniversityDepartments;
use common\components\Model;
use common\models\Others;
use yii\helpers\FileHelper;

/**
 * UniversityController implements the CRUD actions for University model.
 */
class UniversityController extends Controller
{
    /**
     * @inheritdoc
     */    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::classname(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'dependent-states', 'dependent-cities', 'dependent-courses', 'upload-photos', 'delete-photo', 'dependent-courses'],
                        'allow' => true,
                        'roles' => [Roles::ROLE_ADMIN, Roles::ROLE_EDITOR]
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => [EmployeeLogin::ROLE_ADMIN]
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all University models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UniversitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single University model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    private function validateForm($tabs, $model)
    {
        $rules = [
            'Profile' => ['name', 'establishment_date', 'institution_type', 'establishment', 'address', 'country_id',
                          'state_id', 'city_id', 'pincode', 'email', 'website', 'phone_1', 'phone_2', 'contact_person',
                          'contact_person_designation', 'contact_email', 'contact_mobile', 'fax'],
            'About' => ['description'],
            'Misc' => ['location']
        ];     
        
        $flag = true;
        foreach($tabs as $tab) {            
            if(isset($rules[$tab]) && !$model->validate($rules[$tab])) {                
                $flag = false;
                break;
            }
        }

        if ($flag) {
            return [
                'action' => 'next',
                'count' => count($tabs)
            ];            
        }
        return [
            'action' => 'same'
        ];
    }

    private function getCurrentTabAndTabs($tabs) {
        $map = [
            'Profile' => [
                'currentTab' => 'About',
                'tabs' => ['Profile', 'About']
            ],
            'Profile,About' => [
                'currentTab' => 'Misc',
                'tabs' => ['Profile', 'About', 'Misc']
            ],
            'Profile,About,Misc' => [
                'currentTab' => 'Department',
                'tabs' => ['Profile', 'About', 'Misc', 'Department']
            ],
            'Profile,About,Misc,Department' => [
                'currentTab' => 'Gallery',
                'tabs' => ['Profile', 'About', 'Misc', 'Department','Gallery']
            ],
            'Profile,About,Misc,Department,Gallery' => [
                'currentTab' => 'Admissions',
                'tabs' => ['Profile', 'About', 'Misc', 'Department','Gallery','Admissions']
            ],
            'Profile,About,Misc,Department,Gallery,Admissions' => [
                'currentTab' => 'Admissions',
                'tabs' => ['Profile', 'About', 'Misc', 'Department','Gallery','Admissions']
            ],
        ];

        return $map[$tabs];
    }

    /**
     * Creates a new University model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = Yii::$app->request->post('id');
        if (!empty($model)) {
            $model = $this->findModel($model); 
        } else {
            $model = new University();
        }
        $upload = new FileUpload();
        $departments = $model->universityDepartments;               
        $courses = $model->universityCourseLists;
        $univerityAdmisssions = $model->universityAdmissions;       
        $currentTab = 'Profile';
        $tabs = ['Profile'];
        $countries = ArrayHelper::map(Country::getAllCountries(), 'id', 'name');

        if ($model->load(Yii::$app->request->post())) {                                          
            $currentTab = Yii::$app->request->post('currentTab');                                    
            $tabs = explode(',', Yii::$app->request->post('tabs'));                        
            $result = $this->validateForm($tabs, $model);                                            
            if ($result['action'] === 'next') {                                               
                $isModelSaved = false;                
                if ($result['count'] >= 3 ) {                   
                    $this->setSpatialPoints($model, Yii::$app->request->post()['University']['location']);                                        
                    $model->created_by = Yii::$app->user->identity->id;
                    $model->updated_by = Yii::$app->user->identity->id;
                    $model->created_at = gmdate('Y-m-d H:i:s');
                    $model->updated_at = gmdate('Y-m-d H:i:s');                    
                    $isModelSaved = $model->save();                    
                }                              
                if ($isModelSaved) {                        
                    $dependentUpdates = false;
                    if($result['count'] >= 4) {
                        $dependentUpdates = $this->updateDepartments($departments, $model, $courses);
                        $departments = $this->findModel($model->id)->universityDepartments;                                      
                    }                    
                    if ($dependentUpdates && $result['count'] >= 5) {                                                                       
                        $dependentUpdates = $this->saveCoverPhoto($upload, $model);
                        $dependentUpdates = $this->saveLogo($upload, $model);
                    }
                    if ($dependentUpdates && $result['count'] >= 6) {                        
                        $model = $this->findModel($model->id);                                         
                        $dependentUpdates = $this->updateAdmissions($univerityAdmisssions, $model);                         
                        if($dependentUpdates) {
                            return $this->redirect(['view', 'id' => $model->id]);
                        }                       
                        
                    }                   
                }                
                $tabs = $this->getCurrentTabAndTabs(implode(',', $tabs));                                               
                $currentTab = $tabs['currentTab'];                
                $tabs = $tabs['tabs'];
            }           
        }        
        return $this->render('create', [
            'id' => isset($model->id) ? $model->id : null,
            'model' => $model,
            'institutionType' => $this->getOthers('institution_type'),
            'establishment' => $this->getOthers('establishment'),
            'courseType' => $this->getOthers('course_type'),
            'upload' => $upload,
            'currentTab' => $currentTab,
            'tabs' => $tabs,
            'countries' => $countries,
            'degree' => $this->getDegreeList(),
            'majors' => $this->getMajorsList(),
            'departments' => (empty($departments)) ? [new UniversityDepartments] : $departments,
            'courses' => (empty($courses)) ? [new UniversityCourseList] : $courses,
            'univerityAdmisssions' => (empty($univerityAdmisssions)) ? [new UniversityAdmission] : $univerityAdmisssions,
        ]);
    }

    /**
     * Updates an existing University model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {        
        $model = $this->findModel($id);
        $upload = new FileUpload();
        $departments = $model->universityDepartments;               
        $courses = $model->universityCourseLists;
        $univerityAdmisssions = $model->universityAdmissions;       
        $currentTab = 'Profile';
        $tabs = ['Profile', 'About', 'Misc', 'Department', 'Gallery', 'Admissions'];
        $countries = ArrayHelper::map(Country::getAllCountries(), 'id', 'name');
        
        if ($model->load(Yii::$app->request->post())) {                                    
            $result = $this->validateForm($tabs, $model);                                            
            if ($result['action'] === 'next') {                                                               
                $isModelSaved = false;                
                if ($result['count'] >= 3 ) {                   
                    $this->setSpatialPoints($model, Yii::$app->request->post()['University']['location']);                  
                    $model->updated_by = Yii::$app->user->identity->id;                    
                    $model->updated_at = gmdate('Y-m-d H:i:s');
                    $isModelSaved = $model->save(false);                    
                }                              
                if ($isModelSaved) {                        
                    $dependentUpdates = false;
                    if($result['count'] >= 4) {
                        $dependentUpdates = $this->updateDepartments($departments, $model, $courses);
                        $departments = $this->findModel($model->id)->universityDepartments;                                      
                    }                    
                    if ($dependentUpdates && $result['count'] >= 5) {                                                                       
                        $dependentUpdates = $this->saveCoverPhoto($upload, $model);
                        $dependentUpdates = $this->saveLogo($upload, $model);
                    }
                    if ($dependentUpdates && $result['count'] >= 6) {                        
                        $model = $this->findModel($model->id);                                         
                        $dependentUpdates = $this->updateAdmissions($univerityAdmisssions, $model);                         
                        if($dependentUpdates) {
                            return $this->redirect(['view', 'id' => $model->id]);
                        }                       
                        
                    }                   
                }
            }           
        }
        return $this->render('update', [
            'id' => $id,
            'model' => $model,
            'institutionType' => $this->getOthers('institution_type'),
            'establishment' => $this->getOthers('establishment'),
            'courseType' => $this->getOthers('course_type'),
            'upload' => $upload,
            'currentTab' => $currentTab,
            'tabs' => $tabs,
            'countries' => $countries,
            'degree' => $this->getDegreeList(),
            'majors' => $this->getMajorsList(),
            'departments' => (empty($departments)) ? [new UniversityDepartments] : $departments,
            'courses' => (empty($courses)) ? [new UniversityCourseList] : $courses,
            'univerityAdmisssions' => (empty($univerityAdmisssions)) ? [new UniversityAdmission] : $univerityAdmisssions,
        ]);
    }

    private function setSpatialPoints($model, $location) {
        $location = str_replace(['POINT', '(', ')'], '', $location);
        $location = explode(',', $location);
        $location[0] = floatval($location[0]);
        $location[1] = floatval($location[1]);
        $model->location = new Expression("GeomFromText('POINT($location[0] $location[1])')");
    }

    private function saveCoverPhoto($image, $university) {
        $newFile = UploadedFile::getInstance($image, 'imageFile');
        if (isset($newFile)) {
            $image->imageFile = UploadedFile::getInstance($image, 'imageFile');              
            if ($image->upload($university)) {            
                return true; 
            } else {
                return false;
            }
        }                
        return true;
    }

    private function saveLogo($image, $university) {
        $newFile = UploadedFile::getInstance($image, 'logoFile');
        if (isset($newFile)) {
            $image->logoFile = UploadedFile::getInstance($image, 'logoFile');              
            if ($image->uploadLogo($university)) {            
                return true; 
            } else {
                return false;
            }
        }                
        return true;
    }

    private function updateDepartments($deparmtents, $university, $courses) {                        
        $oldIDs = ArrayHelper::map($deparmtents, 'id', 'id');        
        $deparmtents = Model::createMultiple(UniversityDepartments::classname(), $deparmtents);            
        Model::loadMultiple($deparmtents, Yii::$app->request->post());        
        $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($deparmtents, 'id', 'id')));        

        // validate all models        
        $valid = Model::validateMultiple($deparmtents,['name', 'email']);       
        if ($valid) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if (!empty($deletedIDs)) {
                    UniversityDepartments::deleteAll(['id' => $deletedIDs]);
                }
                $departmentIndex = 0;
                foreach ($deparmtents as $department) {
                    $department->university_id = $university->id;
                    $department->created_by = Yii::$app->user->identity->id;
                    $department->updated_by = Yii::$app->user->identity->id;
                    $department->created_at = gmdate('Y-m-d H:i:s');
                    $department->updated_at = gmdate('Y-m-d H:i:s');
                    if (! ($flag = $department->save())) {
                        $transaction->rollBack();
                        break;
                    } else {
                        //update courses. 
                        if (! ($flag = $this->updateCourses($department, $departmentIndex, $university))) {
                            break;
                        }
                    }
                    $departmentIndex++;
                }
                if ($flag) {                    
                    $transaction->commit();
                    return true;                
                }

                $transaction->rollBack();
                return false;
            } catch (Exception $e) {
                $transaction->rollBack();
                return false;
            }
        }
    }

    private function updateCourses($department, $departmentIndex, $university) {        
        $courses = $department->universityCourseLists;
        $courseList = Yii::$app->request->post('UniversityCourseList')[$departmentIndex];
        $oldIDs = ArrayHelper::map($courses, 'id', 'id');
        $newCourses = [];
        $valid;        
        foreach($courseList as $course) {
            $data["UniversityCourseList"] = $course;
            if (!empty($course['id'])) {
                $course = $this->findCourseModel($course['id']);                
            } else {
                $course = new UniversityCourseList();
                $course->created_by = Yii::$app->user->identity->id;                
                $course->created_at = gmdate('Y-m-d H:i:s');                
            }
            $course->department_id = $department->id;
            $course->university_id = $university->id;
            $course->updated_at = gmdate('Y-m-d H:i:s');
            $course->updated_by = Yii::$app->user->identity->id;                
            $course->load($data);
            $course->name = $course->degree->name . ' ' . $course->major->name;
            if(! $valid = $course->validate()) {
                return false;
            }
            array_push($newCourses, $course);              
        }    

        $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($courseList, 'id', 'id')));

        if ($valid) {
            if(!empty($deletedIDs)) {
                UniversityCourseList::deleteAll(['id' => $deletedIDs]);
            }
            //var_dump($newCourses[1]);
            //var_dump($newCourses[1]->save());
            //die();
            foreach($newCourses as $course) {               
                if (! $course->save(false)) {                   
                    return false;
                }
            }               
        }
        return true;
    }

    private function findCourseModel($id)
    {
        if (($model = UniversityCourseList::findOne($id)) !== null) {
            return $model;
        } else {
            return null;
        }
    }

    private function updateCourses1($courses, $university, $departments) {               
        $oldIDs = ArrayHelper::map($courses, 'id', 'id');
        $courses = Model::createMultiple(UniversityCourseList::classname(), $courses);                
        $result = Model::loadMultiple($courses, Yii::$app->request->post());        
        $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($courses, 'id', 'id')));        
        // validate all models
        $valid = Model::validateMultiple($courses, ['degree_id', 'major_id', 'fees', 'intake', 'duration']);        
        if ($valid) {                        
            try {
                if (!empty($deletedIDs)) {
                    UniversityCourseList::deleteAll(['id' => $deletedIDs]);
                }                                
                foreach ($courses as $course) {                                    
                    $course->university_id = $university->id;
                    $course->department_id = $departments[$course->department_id];
                    $course->name = $course->degree->name . ' ' . $course->major->name;
                    $course->created_by = Yii::$app->user->identity->id;
                    $course->updated_by = Yii::$app->user->identity->id;
                    $course->created_at = gmdate('Y-m-d H:i:s');
                    $course->updated_at = gmdate('Y-m-d H:i:s');                    
                    if (! ($flag = $course->save())) {                                                                        
                        break;
                    } else {
                        $this->courseIdMap[$value] = $course->id;
                    }
                    $i++;
                }
                if ($flag) {                    
                    return true;
                }
            } catch (Exception $e) {                
                return false;
            }
        }
    }

    private function updateAdmissions($univerityAdmisssions, $university) {                      
        $oldIDs = ArrayHelper::map($univerityAdmisssions, 'id', 'id');        
        $univerityAdmisssions = Model::createMultiple(UniversityAdmission::classname(), $univerityAdmisssions);        
        $result = Model::loadMultiple($univerityAdmisssions, Yii::$app->request->post());               
        $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($univerityAdmisssions, 'id', 'id')));                        
        // validate all models
        $valid = Model::validateMultiple($univerityAdmisssions, ['start_date', 'end_date', 'admission_link', 'admission_fees']);                                               
        if ($valid) {
            $transaction = \Yii::$app->db->beginTransaction();            
            try {
                if (!empty($deletedIDs)) {
                    UniversityAdmission::deleteAll(['id' => $deletedIDs]);
                }
                foreach ($univerityAdmisssions as $admission) {                                        
                    $admission->university_id = $university->id;                    
                    $admission->created_by = Yii::$app->user->identity->id;
                    $admission->updated_by = Yii::$app->user->identity->id;
                    $admission->created_at = gmdate('Y-m-d H:i:s');
                    $admission->updated_at = gmdate('Y-m-d H:i:s');                    
                    if (! ($flag = $admission->save())) {
                        $transaction->rollBack();                                                
                        break;
                    }
                }
                if ($flag) {
                    $transaction->commit();
                    return true;
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                return false;
            }
        }
    }    

    /**
     * Deletes an existing University model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the University model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return University the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = University::findBySql('SELECT *, AsText(location) AS location FROM university WHERE id=' . $id)->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDependentStates() {        
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $country_id = $parents[0];
                $states = State::getStatesForCountry($country_id);                
                echo Json::encode(['output'=>$states, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function actionDependentCities() {        
        if (isset($_POST['depdrop_parents'])) {            
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {                
                $country_id = $parents[0];
                $state_id = $parents[1];                
                $cities = City::getCitiesForCountryAndState($country_id, $state_id);                
                echo Json::encode(['output'=>$cities, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    private function getDegreeList() {
        return ArrayHelper::map(Degree::find()->orderBy('id')->all(), 'id', 'name');
    }

    private function getMajorsList() {
        return ArrayHelper::map(Majors::find()->orderBy('id')->all(), 'id', 'name');
    }

    private function getOthers($name) {
        $model = [];
        if (($model = Others::findBySql('SELECT value FROM others WHERE name="' . $name . '"')->one()) !== null) {           
            $model = explode(',', $model->value);
            return $model;
        }
    }

    public function actionDependentCourses() {               
        if (isset($_POST['depdrop_parents'])) {                        
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {                
                $department_id = $parents[0];                
                $courses = UniversityCourseList::getCoursesForUniversityAndDepartment($department_id);                
                echo Json::encode(['output'=>$courses, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }

    public function getCourses($department_id) {        
        if (($model = UniversityDepartments::findBySql('SELECT id, name FROM university_admission WHERE department_id=' . $department_id)->all()) !== null) {
            return ArrayHelper::map($model, 'id', 'name');
        } else {
            return [];
        }
    }

    public function actionUploadPhotos() {
        $university = Yii::$app->request->post('university_id');
        $result = is_dir("./../web/uploads/$university/photos");		
		if (!$result) {			
			$result = FileHelper::createDirectory("./../web/uploads/$university/photos");			
		}
        $sourcePath = $_FILES['photos']['tmp_name'];
        $ext = pathinfo($_FILES['photos']['name'], PATHINFO_EXTENSION);
        $targetPath = "./../web/uploads/$university/photos/" . date_timestamp_get(date_create()) . '.' . $ext; // Target path where file is to be stored
        if (move_uploaded_file($sourcePath,$targetPath)) {
            echo json_encode([]);
        }
        else {
            echo json_encode(['error' => 'Processing request ' . $sourcePath]);
        }        
    }

    public function actionDeletePhoto() {
        $university = Yii::$app->request->post('university_id');
        $key = Yii::$app->request->post('key');
        if (unlink("./../web/uploads/$university/photos/$key")) {
            echo json_encode([]);
        } else {
            echo json_encode(['error' => 'Processing request ']);
        }        
    }
}
