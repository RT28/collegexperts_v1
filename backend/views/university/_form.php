<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\models\University */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js');
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyAv4wp5sZdpP31AWEAZuyLMyRKDhhOtWLw');
$this->registerJsFile('@web/js/google_map.js');
$this->registerJsFile('@web/js/university.js');
?>
<?php $form = ActiveForm::begin(['id' => 'university-active-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= Html::hiddenInput('currentTab' , $currentTab); ?>
    <?= Html::hiddenInput('tabs' ,implode(',', $tabs)); ?>
    <?= Html::hiddenInput('id' ,$id); ?>
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
                    ],
                    [
                        'label' => 'About',
                        'content' => array_search('About', $tabs) ? $this->render('_about', [
                            'model' => $model,                        
                            'upload' => $upload,
                            'countries' => $countries,
                            'form' => $form
                        ]) : null,
                        'headerOptions' => [                        
                            'class' => array_search('About', $tabs) ? 'enabled-tab' : 'disabled-tab' 
                        ],
                        'active' => $currentTab === 'About' ? true : false,
                        'options' => ['id' => 'about'],                     
                    ],
                    [
                        'label' => 'Misc.',
                        'content' => array_search('Misc', $tabs) ? $this->render('_misc', [
                            'model' => $model,                        
                            'upload' => $upload,
                            'countries' => $countries,
                            'form' => $form
                        ]) : null,
                        'headerOptions' => [                        
                            'class' => array_search('Misc', $tabs) ? 'enabled-tab' : 'disabled-tab',
                            'onclick'=>'initGoogleMap()'  
                        ],
                        'active' => $currentTab === 'Misc' ? true : false,
                        'options' => ['id' => 'misc'],                                           
                    ],
                    [
                        'label' => 'Departments',
                        'content' => array_search('Department', $tabs) ? $this->render('_departments', [
                            'model' => $model,                              
                            'degree' => $degree,
                            'majors' => $majors,
                            'departments' => $departments,
                            'form' => $form,
                            'courseType' => $courseType
                        ]) : null,
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
                        'content' => array_search('Gallery', $tabs) ? $this->render('_gallery', [
                            'model'=>$model,                        
                            'upload' => $upload,
                            'form' => $form
                        ]) : null,
                        'headerOptions' => [                        
                            'class' => array_search('Gallery', $tabs) ? 'enabled-tab' : 'disabled-tab'
                        ],
                        'options' => ['id' => 'gallery'],
                    ],
                    [
                        'label' => 'Admissions',
                        'content' => array_search('Admissions', $tabs) ? $this->render('_university_admission_form', [
                            'model'=>$model,
                            'univerityAdmisssions' => $univerityAdmisssions,                                
                            'degree' => $degree,
                            'majors' => $majors,
                            'departments' => $departments,
                            'courses' => $courses,
                            'form' => $form,
                            'degreeLevels' => $degreeLevels
                        ]) : null,
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
