<?php

namespace backend\controllers;

use Yii;
use common\models\UniversityCourseList;
use backend\models\UniversityCourseListSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\Degree;
use common\models\Majors;
use yii\helpers\ArrayHelper;

/**
 * UniversityCourseListController implements the CRUD actions for UniversityCourseList model.
 */
class UniversityCourseListController extends Controller
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
     * Lists all UniversityCourseList models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UniversityCourseListSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UniversityCourseList model.
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
     * Creates a new UniversityCourseList model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UniversityCourseList();

        if ($model->load(Yii::$app->request->post())) {            
            $model->university_id = Yii::$app->session['university_id'];
            $model->created_by = Yii::$app->user->identity->id;
            $model->updated_by = Yii::$app->user->identity->id;            
            $model->created_at = gmdate("m/d/y H:i:s");            
            $model->updated_at = gmdate("m/d/y H:i:s");            
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);    
            }            
        } else {
            $degree = Degree::find()
                            ->indexBy('id')
                            ->all();
            $degree = ArrayHelper::map($degree, 'id', 'name');

            $major = Majors::find()
                            ->indexBy('id')
                            ->all();
            $major = ArrayHelper::map($major, 'id', 'name');
            return $this->render('create', [
                'model' => $model,
                'degree' => $degree,
                'major' => $major,
            ]);
        }
    }

    /**
     * Updates an existing UniversityCourseList model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->updated_by = Yii::$app->user->identity->id;           
            $model->updated_at = gmdate("m/d/y H:i:s");            
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);    
            }
        } else {
            $degree = Degree::find()
                            ->indexBy('id')
                            ->all();
            $degree = ArrayHelper::map($degree, 'id', 'name');

            $major = Majors::find()
                            ->indexBy('id')
                            ->all();
            $major = ArrayHelper::map($major, 'id', 'name');
            return $this->render('create', [
                'model' => $model,
                'degree' => $degree,
                'major' => $major,
            ]);
        }
    }

    /**
     * Deletes an existing UniversityCourseList model.
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
     * Finds the UniversityCourseList model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UniversityCourseList the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UniversityCourseList::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
