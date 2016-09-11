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
                        'actions' => ['index', 'view', 'create', 'update', 'dependent-states', 'dependent-cities', 'dependent-courses'],
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

    /**
     * Creates a new University model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {        
        $model = new University();
        $departments = new UniversityDepartments();
        $upload = new FileUpload();
        $departments = [new UniversityDepartments];        
        $courses = [new UniversityCourseList];    
        $univerityAdmisssions = $model->universityAdmissions;    
        $model->created_by = Yii::$app->user->identity->id;
        $model->created_at = gmdate('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->identity->id;
        $model->updated_at = gmdate('Y-m-d H:i:s');
        $model->status = 10;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {                        
            $this->setSpatialPoints($model, Yii::$app->request->post()['University']['location']);            
            if ($model->save()) {                
                $this->saveCoverPhoto($upload, $model);                
                $this->updateDepartments($departments, $model);                
                $this->updateCourses($courses, $model);
                $this->updateAdmissions($univerityAdmisssions, $model);
            } else {
                $countries = ArrayHelper::map(Country::getAllCountries(), 'id', 'name');
                return $this->render('create', [
                    'model' => $model,
                    'upload' => $upload,
                    'countries' => $countries,
                    'degree' => $this->getDegreeList(),
                    'majors' => $this->getMajorsList(),
                    'departments' => (empty($departments)) ? [new UniversityDepartments] : $departments,
                    'courses' => (empty($courses)) ? [new UniversityCourseList] : $courses,                    
                    'univerityAdmisssions' => (empty($univerityAdmisssions)) ? [new UniversityAdmission] : $univerityAdmisssions,
                ]);    
            }               
        } else {            
            $countries = ArrayHelper::map(Country::getAllCountries(), 'id', 'name');            
            return $this->render('create', [
                'model' => $model,
                'upload' => $upload,
                'countries' => $countries,
                'degree' => $this->getDegreeList(),
                'majors' => $this->getMajorsList(),
                'departments' => (empty($departments)) ? [new UniversityDepartments] : $departments,
                'courses' => (empty($courses)) ? [new UniversityCourseList] : $courses,
                'univerityAdmisssions' => (empty($univerityAdmisssions)) ? [new UniversityAdmission] : $univerityAdmisssions,
            ]);
        }
    }

    private function setSpatialPoints($model, $location) {        
        $location = str_replace(['POINT', '(', ')'], '', $location);        
        $location = explode(',', $location);        
        $location[0] = floatval($location[0]);
        $location[1] = floatval($location[1]);        
        $model->location = new Expression("GeomFromText('POINT($location[0] $location[1])')");
    }

    private function saveCoverPhoto($image, $university) {        
        $image->imageFile = UploadedFile::getInstance($image, 'imageFile');       
        if ($image->upload($university)) {
            return; 
        }
    }

    private function updateDepartments($deparmtents, $university) {                
        $oldIDs = ArrayHelper::map($deparmtents, 'id', 'id');        
        $deparmtents = Model::createMultiple(UniversityDepartments::classname(), $deparmtents);            
        Model::loadMultiple($deparmtents, Yii::$app->request->post());        
        $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($deparmtents, 'id', 'id')));        

        // validate all models        
        $valid = Model::validateMultiple($deparmtents,['name']);        

        if ($valid) {
            $transaction = \Yii::$app->db->beginTransaction();            
            try {
                if (!empty($deletedIDs)) {
                    UniversityDepartments::deleteAll(['id' => $deletedIDs]);
                }
                foreach ($deparmtents as $deparmtent) {                    
                    $deparmtent->university_id = $university->id;
                    $deparmtent->created_by = Yii::$app->user->identity->id;
                    $deparmtent->updated_by = Yii::$app->user->identity->id;
                    $deparmtent->created_at = gmdate('Y-m-d H:i:s');
                    $deparmtent->updated_at = gmdate('Y-m-d H:i:s');                    
                    if (! ($flag = $deparmtent->save())) {
                        $transaction->rollBack();                                                
                        break;
                    }
                }
                if ($flag) {
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $university->id]);
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                return $this->redirect(['view', 'id' => $university->id]);
            }
        }
    }

    private function updateCourses($courses, $university) {
        $oldIDs = ArrayHelper::map($courses, 'id', 'id');
        $courses = Model::createMultiple(UniversityCourseList::classname(), $courses);                
        $result = Model::loadMultiple($courses, Yii::$app->request->post());        
        $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($courses, 'id', 'id')));        
        // validate all models
        $valid = Model::validateMultiple($courses, ['name', 'degree_id', 'major_id', 'fees', 'intake', 'duration']);        
        if ($valid) {
            $transaction = \Yii::$app->db->beginTransaction();            
            try {
                if (!empty($deletedIDs)) {
                    UniversityCourseList::deleteAll(['id' => $deletedIDs]);
                }
                foreach ($courses as $course) {                    
                    $course->university_id = $university->id;
                    $course->created_by = Yii::$app->user->identity->id;
                    $course->updated_by = Yii::$app->user->identity->id;
                    $course->created_at = gmdate('Y-m-d H:i:s');
                    $course->updated_at = gmdate('Y-m-d H:i:s');                    
                    if (! ($flag = $course->save())) {
                        $transaction->rollBack();                                                
                        break;
                    }
                }
                if ($flag) {
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $university->id]);
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                return $this->redirect(['view', 'id' => $university->id]);
            }
        }
    }

    private function updateAdmissions($univerityAdmisssions, $university) {
        $oldIDs = ArrayHelper::map($univerityAdmisssions, 'id', 'id');
        $univerityAdmisssions = Model::createMultiple(UniversityAdmission::classname(), $univerityAdmisssions);                
        $result = Model::loadMultiple($univerityAdmisssions, Yii::$app->request->post());        
        $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($univerityAdmisssions, 'id', 'id')));        
        // validate all models
        $valid = Model::validateMultiple($univerityAdmisssions, ['start_date', 'end_date', 'course_id', 'admission_link', 'major_id', 'admission_fees']);        
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
                    return $this->redirect(['view', 'id' => $university->id]);
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                return $this->redirect(['view', 'id' => $university->id]);
            }
        }
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

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {          
            $model->updated_by = Yii::$app->user->identity->id;
            $model->updated_at = gmdate('Y-m-d H:i:s');
            $this->setSpatialPoints($model, Yii::$app->request->post()['University']['location']);
            $result = $model->save();
            if ($result) {
                $this->saveCoverPhoto($upload, $model);
                $this->updateDepartments($departments, $model);
                $this->updateCourses($courses, $model);
                $this->updateAdmissions($univerityAdmisssions, $model);
            } else {                
                $countries = ArrayHelper::map(Country::getAllCountries(), 'id', 'name');                              
                return $this->render('update', [
                    'model' => $model,
                    'countries' => $countries,
                    'upload' => $upload,
                    'degree' => $this->getDegreeList(),
                    'majors' => $this->getMajorsList(),
                    'departments' => (empty($departments)) ? [new UniversityDepartments] : $departments,
                    'courses' => (empty($courses)) ? [new UniversityCourseList] : $courses,
                    'univerityAdmisssions' => (empty($univerityAdmisssions)) ? [new UniversityAdmission] : $univerityAdmisssions,
                ]);    
            }
        } else {
            $countries = ArrayHelper::map(Country::getAllCountries(), 'id', 'name');            
            return $this->render('update', [
                'model' => $model,
                'countries' => $countries,
                'upload' => $upload,
                'degree' => $this->getDegreeList(),
                'majors' => $this->getMajorsList(),
                'departments' => (empty($departments)) ? [new UniversityDepartments] : $departments,
                'courses' => (empty($courses)) ? [new UniversityCourseList] : $courses,                
                'univerityAdmisssions' => (empty($univerityAdmisssions)) ? [new UniversityAdmission] : $univerityAdmisssions,
            ]);
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

    public function actionDependentCourses() {
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
}
