<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\FileHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js');
$this->registerJsFile('@web/js/student.js');
?>
<div class="student-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="row">
        <div class="col-xs-12 col-sm-4">
            <?php
                $cover_photo_path = [];
                if(is_dir("./../web/uploads/$model->id/profile_photo")) {
                    $cover_photo_path = FileHelper::findFiles("./../web/uploads/$model->id/profile_photo", [
                        'caseSensitive' => true,
                        'recursive' => false,
                    ]);
                }
                if (count($cover_photo_path) > 0) {
                    echo Html::img($cover_photo_path[0], ['alt' => $model->first_name , 'class' => 'cover-photo']);
                }
                else {
                    echo Html::img("./../web/noprofile.gif", ['alt' => $model->first_name , 'class' => 'cover-photo']);
                }
            ?>
        </div>
        <div class="col-xs-12 col-sm-8">
            <div class="row">
                <div class="row border">
                    <h2><?= $model->first_name . ' ' , $model->last_name ?></h2>
                    <p>Nationality: <?= $model->nationality ?></p>
                </div>
                <div class="row border">
                    <span>Wants to study:</span>
                    <span>Mechanical Engineering</span>
                </div>
                <div class="row border">
                    <span>In:</span>
                    <span>USA, UK, Canada</span>
                </div>                
            </div>
        </div>
    </div>   

    <div class="row">
        <div class="col-xs-12 col-sm-6 border">
            <label>Email:</label>
            <span><?=  $model->email ?> </span> 
        </div>

        <div class="col-xs-12 col-sm-6 border">
            <label>Parent Email:</label>
            <span><?=  $model->parent_email ?> </span> 
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-6 border">
            <label>Phone:</label>
            <span><?=  $model->phone ?> </span> 
        </div>

        <div class="col-xs-12 col-sm-6 border">
            <label>Parent Phone:</label>
            <span><?=  $model->parent_phone ?> </span> 
        </div>
    </div>

    <div class="row border">
        <h3>Residential Address</h3>
        <div class="col-xs-12">
            <label>Address:</label>
            <span><?=  $model->address ?> </span> 
        </div>
        <div class="col-xs-12">
            <label>Street:</label>
            <span><?=  $model->street ?> </span> 
        </div>
        <div class="col-xs-12">
            <label>City:</label>
            <span><?=  $model->city ?> </span> 
        </div>
        <div class="col-xs-12">
            <label>State:</label>
            <span><?=  $model->state ?> </span> 
        </div>

        <div class="col-xs-12">
            <label>Country:</label>
            <span><?=  $model->country ?> </span> 
        </div>
    </div>

    <div class="row border">
        <h3>Permanent Address</h3>
        <div class="col-xs-12">
            <label>Address:</label>
            <span><?=  $model->address ?> </span> 
        </div>
        <div class="col-xs-12">
            <label>Street:</label>
            <span><?=  $model->street ?> </span> 
        </div>
        <div class="col-xs-12">
            <label>City:</label>
            <span><?=  $model->city ?> </span> 
        </div>
        <div class="col-xs-12">
            <label>State:</label>
            <span><?=  $model->state ?> </span> 
        </div>

        <div class="col-xs-12">
            <label>Country:</label>
            <span><?=  $model->country ?> </span> 
        </div>
    </div>

    <?= $this->render('_school_details', [
            'model' => $model->studentSchoolDetails
        ]);
    ?>

    <?= $this->render('_college_details', [
            'model' => $model->studentCollegeDetails
        ]);
    ?>

    <?= $this->render('_subject_details', [
            'model' => $model->studentSubjectDetails
        ]);
    ?>

    <?= $this->render('_english_language_proficiencey_details', [
            'model' => $model->studentEnglishLanguageProficienceyDetails
        ]);
    ?>

    <?= $this->render('_standard_test_details', [
            'model' => $model->studentStandardTestDetails
        ]);
    ?>

    <?= $this->render('_documents', [
            'model' => $model
        ]);
    ?>

</div>
