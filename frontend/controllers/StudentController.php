<?php

namespace frontend\controllers;

use Yii;
use common\models\Student;
use backend\models\StudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use common\models\StudentSchoolDetail;
use common\models\StudentCollegeDetail;
use common\models\StudentSubjectDetail;
use common\models\StudentEnglishLanguageProficienceyDetails;
use common\models\StudentStandardTestDetail;
use common\components\Model;

use yii\helpers\FileHelper;
/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('view', [
            'model' => Yii::$app->user->identity->student,
        ]);            
    }

    /**
     * Displays a single Student model.
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
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();
        $schools = [new StudentSchoolDetails];
        $colleges = [new StudentCollegeDetails];
        $subjects = [new StudentSubjectDetails];
        $englishProficiency = [new StudentEnglishLanguageProficienceyDetails];
        $standardTests = [new StudentStandardTestDetails];

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->save()) {
                $this->saveSchoolDetails($schools, $model);
                $this->saveCollegeDetails($colleges, $model);
                $this->saveSubjectDetails($subjects, $model);
                $this->saveEnglishProficiencyDetails($englishProficiency, $model);
                $this->saveStandardDetails($standardTests, $model);
                return $this->redirect(['view', 'id' => $model->id]);    
            }
            else {
                return $this->render('create', [
                    'model' => $model,
                    'schools' => empty($schools) ? [new StudentSchoolDetail] : $schools,
                    'colleges' => empty($colleges) ? [new StudentCollegeDetail] : $colleges,
                    'subjects' => empty($subjects) ? [new StudentSubjectDetail] : $subjects,
                    'englishProficiency' => empty($englishProficiency) ? [new StudentEnglishLanguageProficienceyDetails] : $englishProficiency,
                    'standardTests' => empty($standardTests) ? [new StudentStandardTestDetail] : $standardTests,
                ]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'schools' => empty($schools) ? [new StudentSchoolDetail] : $schools,
                'colleges' => empty($colleges) ? [new StudentCollegeDetail] : $colleges,
                'subjects' => empty($subjects) ? [new StudentSubjectDetail] : $subjects,
                'englishProficiency' => empty($englishProficiency) ? [new StudentEnglishLanguageProficienceyDetails] : $englishProficiency,
                'standardTests' => empty($standardTests) ? [new StudentStandardTestDetail] : $standardTests,
            ]);
        }
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $schools = $model->studentSchoolDetails;
        $colleges = $model->studentCollegeDetails;
        $subjects = $model->studentSubjectDetails;
        $englishProficiency = $model->studentEnglishLanguageProficienceyDetails;
        $standardTests = $model->studentStandardTestDetails;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->save()) {
                $this->saveSchoolDetails($schools, $model);
                $this->saveCollegeDetails($colleges, $model);
                $this->saveSubjectDetails($subjects, $model);
                $this->saveEnglishProficiencyDetails($englishProficiency, $model);
                $this->saveStandardDetails($standardTests, $model);
                return $this->redirect(['view', 'id' => $model->id]);    
            }
            else {
                return $this->render('update', [
                    'model' => $model,
                    'schools' => empty($schools) ? [new StudentSchoolDetail] : $schools,
                    'colleges' => empty($colleges) ? [new StudentCollegeDetail] : $colleges,
                    'subjects' => empty($subjects) ? [new StudentSubjectDetail] : $subjects,
                    'englishProficiency' => empty($englishProficiency) ? [new StudentEnglishLanguageProficienceyDetails] : $englishProficiency,
                    'standardTests' => empty($standardTests) ? [new StudentStandardTestDetail] : $standardTests,
                ]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'schools' => empty($schools) ? [new StudentSchoolDetail] : $schools,
                'colleges' => empty($colleges) ? [new StudentCollegeDetail] : $colleges,
                'subjects' => empty($subjects) ? [new StudentSubjectDetail] : $subjects,
                'englishProficiency' => empty($englishProficiency) ? [new StudentEnglishLanguageProficienceyDetails] : $englishProficiency,
                'standardTests' => empty($standardTests) ? [new StudentStandardTestDetail] : $standardTests,
            ]);
        }
    }

    /**
     * Deletes an existing Student model.
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
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function saveSchoolDetails($schools, $student) {
        $oldIDs = ArrayHelper::map($schools, 'id', 'id');

        $schools = Model::createMultiple(StudentSchoolDetail::classname(), $schools);
        $result = Model::loadMultiple($schools, Yii::$app->request->post());
        $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($schools, 'id', 'id')));
        $valid = Model::validateMultiple($schools, ['name', 'from_date', 'to_date', 'curriculum']);
        if ($valid) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if (!empty($deletedIDs)) {
                    StudentSchoolDetail::deleteAll(['id' => $deletedIDs]);
                }
                foreach ($schools as $school) {
                    $school->student_id = $student->id;
                    $school->created_by = Yii::$app->user->identity->id;
                    $school->updated_by = Yii::$app->user->identity->id;
                    $school->created_at = gmdate('Y-m-d H:i:s');
                    $school->updated_at = gmdate('Y-m-d H:i:s');
                    if (! ($flag = $school->save())) {
                        $transaction->rollBack();
                        break;
                    }
                }
                if ($flag) {
                    $transaction->commit();
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                echo 'Failure';
                die();
            }
        }
    }

    private function saveCollegeDetails($colleges, $student) {
        $oldIDs = ArrayHelper::map($colleges, 'id', 'id');

        $colleges = Model::createMultiple(StudentCollegeDetail::classname(), $colleges);
        $result = Model::loadMultiple($colleges, Yii::$app->request->post());
        $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($colleges, 'id', 'id')));
        $valid = Model::validateMultiple($colleges, ['name', 'from_date', 'to_date', 'curriculum']);
        if ($valid) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if (!empty($deletedIDs)) {
                    StudentCollegeDetail::deleteAll(['id' => $deletedIDs]);
                }
                foreach ($colleges as $college) {
                    $college->student_id = $student->id;
                    $college->created_by = Yii::$app->user->identity->id;
                    $college->updated_by = Yii::$app->user->identity->id;
                    $college->created_at = gmdate('Y-m-d H:i:s');
                    $college->updated_at = gmdate('Y-m-d H:i:s');
                    if (! ($flag = $college->save())) {
                        $transaction->rollBack();
                        break;
                    }
                }
                if ($flag) {
                    $transaction->commit();
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                echo 'Failure';
                die();
            }
        }
    }

    private function saveSubjectDetails($subjects, $student) {
        $oldIDs = ArrayHelper::map($subjects, 'id', 'id');

        $subjects = Model::createMultiple(StudentSubjectDetail::classname(), $subjects);
        $result = Model::loadMultiple($subjects, Yii::$app->request->post());
        $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($subjects, 'id', 'id')));
        $valid = Model::validateMultiple($subjects, ['name', 'maximum_marks', 'marks_obtained']);
        if ($valid) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if (!empty($deletedIDs)) {
                    StudentSubjectDetail::deleteAll(['id' => $deletedIDs]);
                }
                foreach ($subjects as $subject) {
                    $subject->student_id = $student->id;
                    $subject->created_by = Yii::$app->user->identity->id;
                    $subject->updated_by = Yii::$app->user->identity->id;
                    $subject->created_at = gmdate('Y-m-d H:i:s');
                    $subject->updated_at = gmdate('Y-m-d H:i:s');
                    if (! ($flag = $subject->save())) {
                        $transaction->rollBack();
                        break;
                    }
                }
                if ($flag) {
                    $transaction->commit();
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                echo 'Failure';
                die();
            }
        }
    }

    private function saveEnglishProficiencyDetails($proficiency, $student) {        
        $oldIDs = ArrayHelper::map($proficiency, 'id', 'id');
        $proficiency = Model::createMultiple(StudentEnglishLanguageProficienceyDetails::classname(), $proficiency);
        $result = Model::loadMultiple($proficiency, Yii::$app->request->post());
        $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($proficiency, 'id', 'id')));
        $valid = Model::validateMultiple($proficiency, ['test_name', 'reading_score', 'writing_score', 'listening_score', 'speaking_score']);        
        if ($valid) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if (!empty($deletedIDs)) {
                    StudentEnglishLanguageProficienceyDetails::deleteAll(['id' => $deletedIDs]);
                }
                foreach ($proficiency as $prof) {                    
                    $prof->student_id = $student->id;
                    $prof->created_by = Yii::$app->user->identity->id;
                    $prof->updated_by = Yii::$app->user->identity->id;
                    $prof->created_at = gmdate('Y-m-d H:i:s');
                    $prof->updated_at = gmdate('Y-m-d H:i:s');
                    if (! ($flag = $prof->save(false))) {                        
                        $transaction->rollBack();
                        var_dump($flag);
                        die();
                        break;                        
                    }
                }                
                if ($flag) {
                    $transaction->commit();
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                echo 'Failure';
                die();
            }
        }
    }

    private function saveStandardDetails($tests, $student) {        
        $oldIDs = ArrayHelper::map($tests, 'id', 'id');
        $tests = Model::createMultiple(StudentStandardTestDetail::classname(), $tests);
        $result = Model::loadMultiple($tests, Yii::$app->request->post());
        $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($tests, 'id', 'id')));
        $valid = Model::validateMultiple($tests, ['test_name', 'verbal_score', 'quantitative_score', 'integrated_reasoning_score', 'data_interpretation_score']);        
        if ($valid) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                if (!empty($deletedIDs)) {
                    StudentStandardTestDetail::deleteAll(['id' => $deletedIDs]);
                }
                foreach ($tests as $test) {                    
                    $test->student_id = $student->id;
                    $test->created_by = Yii::$app->user->identity->id;
                    $test->updated_by = Yii::$app->user->identity->id;
                    $test->created_at = gmdate('Y-m-d H:i:s');
                    $test->updated_at = gmdate('Y-m-d H:i:s');
                    if (! ($flag = $test->save(false))) {                        
                        $transaction->rollBack();
                        var_dump($flag);
                        die();
                        break;                        
                    }
                }                
                if ($flag) {
                    $transaction->commit();
                }
            } catch (Exception $e) {
                $transaction->rollBack();
                echo 'Failure';
                die();
            }
        }
    }

    public function actionUploadProfilePhoto() {
        $student = Yii::$app->request->post('student_id');
        $result = is_dir("./../web/uploads/$student/profile_photo");		
		if (!$result) {			
			$result = FileHelper::createDirectory("./../web/uploads/$student/profile_photo");			
		}
        $sourcePath = $_FILES['profile_photo']['tmp_name'];
        $ext = pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION);
        $targetPath = "./../web/uploads/$student/profile_photo/" . date_timestamp_get(date_create()) . '.' . $ext; // Target path where file is to be stored
        if (move_uploaded_file($sourcePath,$targetPath)) {
            echo json_encode([]);
        }
        else {
            echo json_encode(['error' => 'Processing request']);
        }
    }

    public function actionDeletePhoto() {
        $student = Yii::$app->request->post('student_id');
        $key = Yii::$app->request->post('key');
        if (unlink("./../web/uploads/$student/profile_photo/$key")) {
            echo json_encode([]);
        } else {
            echo json_encode(['error' => 'Processing request ']);
        }        
    }

    public function actionDownloadPassport() {
        $id = Yii::$app->request->get('id');
        if (is_dir("./../web/uploads/$id/documents/passport")) {
            $passport_path = FileHelper::findFiles("./../web/uploads/$id/documents/passport", [
                'caseSensitive' => false,
                'recursive' => false,
                'only' => ['passport.*']
            ]);
            if (count($passport_path) > 0) {
                Yii::$app->response->sendFile($passport_path[0]);
            }                        
        } else {
            echo json_encode(['error']);
            return;
        }        
    }

    public function actionUploadPassport() {
        $student = Yii::$app->request->post('student_id');
        $result = is_dir("./../web/uploads/$student/documents/passport");		
		if (!$result) {			
			FileHelper::createDirectory("./../web/uploads/$student/documents/passport");			
		} else {
            FileHelper::removeDirectory("./../web/uploads/$student/documents/passport");
            FileHelper::createDirectory("./../web/uploads/$student/documents/passport");
        }
        $sourcePath = $_FILES['upload_passport']['tmp_name'];
        $ext = pathinfo($_FILES['upload_passport']['name'], PATHINFO_EXTENSION);
        $targetPath = "./../web/uploads/$student/documents/passport/passport." . $ext; // Target path where file is to be stored
        if (move_uploaded_file($sourcePath,$targetPath)) {
            echo json_encode([]);            
        }
        else {
            echo json_encode(['error' => 'Processing request ' . $sourcePath]);
        }
        return;
    }

    public function actionDownloadVisaDetails() {
        $id = Yii::$app->request->get('id');
        if (is_dir("./../web/uploads/$id/documents/visa")) {
            $passport_path = FileHelper::findFiles("./../web/uploads/$id/document/visa", [
                'caseSensitive' => false,
                'recursive' => false,
                'only' => ['visa.*']
            ]);
            if (count($passport_path) > 0) {
                Yii::$app->response->sendFile($passport_path[0]);
            }                        
        } else {
            echo json_encode(['error']);
            return;
        }        
    }

    public function actionUploadVisaDetails() {
        $student = Yii::$app->request->post('student_id');
        $result = is_dir("./../web/uploads/$student/documents/visa");		
		if (!$result) {			
			FileHelper::createDirectory("./../web/uploads/$student/documents/visa");			
		} else {
            FileHelper::removeDirectory("./../web/uploads/$student/documents/visa");
            FileHelper::createDirectory("./../web/uploads/$student/documents/visa");
        }
        $sourcePath = $_FILES['upload_visa']['tmp_name'];
        $ext = pathinfo($_FILES['upload_visa']['name'], PATHINFO_EXTENSION);
        $targetPath = "./../web/uploads/$student/documents/visa/visa." . $ext; // Target path where file is to be stored
        if (move_uploaded_file($sourcePath,$targetPath)) {
            echo json_encode([]);            
        }
        else {
            echo json_encode(['error' => 'Processing request ' . $sourcePath]);
        }
        return;
    }

    public function actionDownloadReferenceLetter() {
        $id = Yii::$app->request->get('id');
        if (is_dir("./../web/uploads/$id/documents/reference_letter")) {
            $passport_path = FileHelper::findFiles("./../web/uploads/$id/documents/reference_letter", [
                'caseSensitive' => false,
                'recursive' => false,
                'only' => ['reference_letter.*']
            ]);
            if (count($passport_path) > 0) {
                Yii::$app->response->sendFile($passport_path[0]);
            }                        
        } else {
            echo json_encode(['error']);
            return;
        }        
    }

    public function actionUploadReferenceLetter() {
        $student = Yii::$app->request->post('student_id');
        $result = is_dir("./../web/uploads/$student/documents/reference_letter");		
		if (!$result) {			
			FileHelper::createDirectory("./../web/uploads/$student/documents/reference_letter");			
		} else {
            FileHelper::removeDirectory("./../web/uploads/$student/documents/reference_letter");
            FileHelper::createDirectory("./../web/uploads/$student/documents/reference_letter");
        }
        $sourcePath = $_FILES['reference_letter']['tmp_name'];
        $ext = pathinfo($_FILES['reference_letter']['name'], PATHINFO_EXTENSION);
        $targetPath = "./../web/uploads/$student/documents/reference_letter/reference_letter." . $ext; // Target path where file is to be stored
        if (move_uploaded_file($sourcePath,$targetPath)) {
            echo json_encode([]);            
        }
        else {
            echo json_encode(['error' => 'Processing request ' . $sourcePath]);
        }
        return;
    }

    public function actionDownloadResume() {
        $id = Yii::$app->request->get('id');
        if (is_dir("./../web/uploads/$id/documents")) {
            $passport_path = FileHelper::findFiles("./../web/uploads/$id/documents/resume", [
                'caseSensitive' => false,
                'recursive' => false,
                'only' => ['reference_letter.*']
            ]);
            if (count($passport_path) > 0) {
                Yii::$app->response->sendFile($passport_path[0]);
            }                        
        } else {
            echo json_encode(['error']);
            return;
        }        
    }

    public function actionUploadResume() {
        $student = Yii::$app->request->post('student_id');
        $result = is_dir("./../web/uploads/$student/documents/resume");		
		if (!$result) {			
			FileHelper::createDirectory("./../web/uploads/$student/documents/resume");			
		} else {
            FileHelper::removeDirectory("./../web/uploads/$student/documents/resume");
            FileHelper::createDirectory("./../web/uploads/$student/documents/resume");
        }
        $sourcePath = $_FILES['resume']['tmp_name'];
        $ext = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
        $targetPath = "./../web/uploads/$student/documents/resume/resume." . $ext; // Target path where file is to be stored
        if (move_uploaded_file($sourcePath,$targetPath)) {
            echo json_encode([]);            
        }
        else {
            echo json_encode(['error' => 'Processing request ' . $sourcePath]);
        }
        return;
    }
}
