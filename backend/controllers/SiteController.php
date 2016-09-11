<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\EmployeeForm;
use backend\models\EmployeeLoginForm;
use backend\models\University;
use yii\web\Response;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
/**
 * Site controller
 */
class SiteController extends Controller
{

    const ROLE_ADMIN = 1;

    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'add-university', 'list-universities', 'delete-university'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['employee-form'],
                        'allow' => true,                        
                        'denyCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->id != 1;
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new EmployeeLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionEmployeeForm()
    {
        $model = new EmployeeForm();

        if ($model->load(Yii::$app->request->post())) {            
            if ($model->validate()) {                
                // form inputs are valid, do something here
                $result = $model->addEmployee();                                              
                var_dump($result);
            }
        }

        return $this->render('employeeForm', [
            'model' => $model,
        ]);
    }

    public function actionAddUniversity($id = null)
    {
        $model = new University();
        //For view action from university list
        if (isset($id)) {
            $model = University::findOne(['id' => $id]);
        }
        
        elseif (Yii::$app->request->post('chosen') === 'Update') {
            $model = University::findOne(['id' => $id]);
        }
        else {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->validate()) {                
                    $model->status = 0;
                    $result = $model->save() ? true : false;
                    return $result ? 'Success' : 'Failure';
                }
            }  
        }
        return $this->render('addUniversity', [
            'model' => $model
        ]);
    }

    public function actionListUniversities() {
        $query = University::find();
        $provider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $this->render('listUniversities', [
            'provider' => $provider
        ]);
    }

    public function actionDeleteUniversity($id = null) {
        if(isset($id)) {
            $university = University::findOne($id);
            $result = $university->delete();    

            return $result === 1 ? $this->redirect('?r=site/list-universities') : NULL;
        }        
    }

    public function actionUpdateUniversity($id = null) {
        if (isset($id)) {
            $university = University::findOne($id);
            if(isset($university)) {
                $result = $university->delete();
                return $result === 1 ? $this->redirect('?r=site/list-universities') : NULL;
            }            
        }
    }
}
