<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\models\University */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="university-form">   
    <?= Tabs::widget([
        'items' => [
                [
                    'label' => 'Profile',
                    'content' => $this->render('_profile', [
                        'model' => $model,                        
                        'upload' => $upload,
                        'countries' => $countries
                    ]),
                    'active' => $currentTab === 'Profile' ? true : false,
                    'options' => ['id' => 'profile'],                     
                ],
                [
                    'label' => 'Departments',
                    'content' => $this->render('_departments', [
                        'model' => $model,                        
                        'courses' => $courses,                              
                        'degree' => $degree,
                        'majors' => $majors,
                        'departments' => $departments
                    ]),
                    'active' => $currentTab === 'Departments' ? true : false,
                    'headerOptions' => [                        
                        'class' => array_search('Departments', $tabs) ? 'enabled-tab' : 'disabled-tab' 
                    ],
                    'options' => [
                        'id' => 'university-departments',
                    ],
                ],                
                [
                    'label' => 'Gallery',
                    'content' => $this->render('_gallery', [
                        'model'=>$model,                        
                        'upload' => $upload,
                    ]),
                    'headerOptions' => [                        
                        'class' => array_search('Gallery', $tabs) ? 'enabled-tab' : 'disabled-tab'
                    ],
                    'options' => ['id' => 'gallery'],
                ],
                [
                    'label' => 'Admissions',
                    'content' => $this->render('_university_admission_form', [
                        'model'=>$model,
                        'univerityAdmisssions' => $univerityAdmisssions,                                
                        'degree' => $degree,
                        'majors' => $majors,
                        'departments' => $departments,
                        'courses' => $courses,
                    ]),
                    'headerOptions' => [                        
                        'class' => array_search('Admissions', $tabs) ? 'enabled-tab' : 'disabled-tab'
                    ],                
                    'options' => ['id' => 'admissions'],
                ]
            ]
        ]);
    ?>
</div>
