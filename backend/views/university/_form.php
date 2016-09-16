<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\models\University */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="university-form">    
    <?php $form = ActiveForm::begin(['id' => 'university-active-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= Tabs::widget([
        'items' => [
                [
                    'label' => 'Profile',
                    'content' => $this->render('_profile', [
                        'model' => $model,
                        'form' => $form,
                        'upload' => $upload,
                        'countries' => $countries
                    ]),
                    'active' => true,
                    'options' => ['id' => 'profile'],                     
                ],
                [
                    'label' => 'Departments',
                    'content' => $this->render('_departments', [
                        'model' => $model,
                        'form' => $form,
                        'departments' => $departments
                    ]),
                    'options' => ['id' => 'university-departments'],
                ],
                [
                    'label' => 'Courses',
                    'content' => $this->render('_courses', [
                        'model'=>$model,
                        'courses' => $courses,
                        'form' => $form,        
                        'degree' => $degree,
                        'majors' => $majors,
                        'departments' => $departments
                    ]),
                    'options' => ['id' => 'courses'],
                ],
                [
                    'label' => 'Admissions',
                    'content' => $this->render('_university_admission_form', [
                        'model'=>$model,
                        'univerityAdmisssions' => $univerityAdmisssions,
                        'form' => $form,        
                        'degree' => $degree,
                        'majors' => $majors,
                        'departments' => $departments,
                        'courses' => $courses,
                    ]),                
                    'options' => ['id' => 'admissions'],
                ]
            ]
        ]);
    ?>               

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>    

    <?php ActiveForm::end(); ?>

</div>
