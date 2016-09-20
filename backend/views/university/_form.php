<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\models\University */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'university-active-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= Html::hiddenInput('currentTab' , $currentTab); ?>
    <?= Html::hiddenInput('tabs' ,implode(',', $tabs)); ?>
    <div class="university-form">   
        <?= Tabs::widget([
            'items' => [
                    [
                        'label' => 'Profile',
                        'content' => $this->render('_profile', [
                            'model' => $model,                        
                            'upload' => $upload,
                            'countries' => $countries,
                            'institutionType'=> $institutionType,
                            'establishment' => $establishment,
                            'form' => $form
                        ]),
                        'active' => $currentTab === 'Profile' ? true : false,
                        'options' => ['id' => 'profile'],                     
                    ]/*,
                    [
                        'label' => 'About',
                        'content' => $this->render('_about', [
                            'model' => $model,                        
                            'upload' => $upload,
                            'countries' => $countries,
                            'form' => $form
                        ]),
                        'headerOptions' => [                        
                            'class' => array_search('About', $tabs) ? 'enabled-tab' : 'disabled-tab' 
                        ],
                        'active' => $currentTab === 'About' ? true : false,
                        'options' => ['id' => 'about'],                     
                    ]*/,
                    [
                        'label' => 'Misc.',
                        'content' => $this->render('_misc', [
                            'model' => $model,                        
                            'upload' => $upload,
                            'countries' => $countries,
                            'form' => $form
                        ]),
                        'headerOptions' => [                        
                            'class' => array_search('Misc', $tabs) ? 'enabled-tab' : 'disabled-tab' 
                        ],
                        'active' => $currentTab === 'Misc' ? true : false,
                        'options' => ['id' => 'misc'],                     
                    ],
                    [
                        'label' => 'Departments',
                        'content' => $this->render('_departments', [
                            'model' => $model,                        
                            'courses' => $courses,                              
                            'degree' => $degree,
                            'majors' => $majors,
                            'departments' => $departments,
                            'form' => $form
                        ]),
                        'active' => $currentTab === 'Department' ? true : false,
                        'headerOptions' => [                        
                            'class' => array_search('Department', $tabs) ? 'enabled-tab' : 'disabled-tab' 
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
                            'form' => $form
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
                            'form' => $form
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


<div class="form-group text-center">
    <?= Html::submitInput('Next', ['class' => 'btn btn-primary', 'value' => 'Profile']) ?>
</div>

<?php ActiveForm::end(); ?>
