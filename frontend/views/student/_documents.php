<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\FileHelper;
use kartik\file\FileInput;
?>

<h3>Documents </h3>
<table class="table table-bordered">        
    <tr>
        <td>Passport</td>
        <td>
            <?php
                $passport_path = [];                
                if (is_dir("./../web/uploads/$model->id/documents/passport")) {
                    $passport_path = FileHelper::findFiles("./../web/uploads/$model->id/documents/passport", [
                        'caseSensitive' => false,
                        'recursive' => false,
                        'only' => ['passport.*']
                    ]);
                }
                
                if (count($passport_path) > 0) {
                   echo Html::a('<span class="glyphicon glyphicon-download"></span>', ['student/download-passport', 'id' => $model->id], ['class' => 'btn btn-link']);
                }

                echo FileInput::widget([
                    'name' => 'upload_passport',
                    'pluginOptions' => [
                        'uploadUrl' => Url::to(['/student/upload-passport']),
                        'showPreview'=> true,
                        'showCaption' => false,
                        'uploadExtraData' => [
                            'student_id' => $model->id,
                        ]
                    ]
                ]);
            ?>
        </td>        
    </tr>
    <tr>
        <td>Transcripts</td>
        <td><span class="glyphicon glyphicon-download"></span><span class="glyphicon glyphicon-upload"></span></td>
    </tr>
    <tr>
        <td>ACT/SAT/GRE/GMAT</td>
        <td>
            <?php
                echo Html::a('<span class="glyphicon glyphicon-download"></span>', ['student/download-standard-tests', 'id' => $model->id], ['class' => 'btn btn-link']);
                $standard_tests_path = [];                
                if (is_dir("./../web/uploads/$model->id/documents/standard_tests")) {
                    $resume_path = FileHelper::findFiles("./../web/uploads/$model->id/documents/standard_tests", [
                        'caseSensitive' => false,
                        'recursive' => false,
                        'only' => ['resume.*']
                    ]);
                }
                
                if (count($standard_tests_path) > 0) {
                   echo Html::a('<span class="glyphicon glyphicon-download"></span>', ['student/download-standard-tests', 'id' => $model->id], ['class' => 'btn btn-link']);
                }

                echo FileInput::widget([
                    'name' => 'standard_tests',
                    'pluginOptions' => [
                        'uploadUrl' => Url::to(['/student/upload-standard-tests']),
                        'showPreview'=> true,
                        'showCaption' => false,
                        'uploadExtraData' => [
                            'student_id' => $model->id,
                        ]
                    ]
                ]);
            ?>
        </td>
    </tr>
    <tr>
        <td>Resume</td>
        <td>
            <?php
                $resume_path = [];                
                if (is_dir("./../web/uploads/$model->id/documents/resume")) {
                    $resume_path = FileHelper::findFiles("./../web/uploads/$model->id/documents/resume", [
                        'caseSensitive' => false,
                        'recursive' => false,
                        'only' => ['resume.*']
                    ]);
                }
                
                if (count($resume_path) > 0) {
                   echo Html::a('<span class="glyphicon glyphicon-download"></span>', ['student/download-resume', 'id' => $model->id], ['class' => 'btn btn-link']);
                }

                echo FileInput::widget([
                    'name' => 'resume',
                    'pluginOptions' => [
                        'uploadUrl' => Url::to(['/student/upload-resume']),
                        'showPreview'=> true,
                        'showCaption' => false,
                        'uploadExtraData' => [
                            'student_id' => $model->id,
                        ]
                    ]
                ]);
            ?>
        </td>
    </tr>
    <tr>
        <td>Refrence Letter</td>
        <td>
            <?php
                $reference_letter_path = [];                
                if (is_dir("./../web/uploads/$model->id/documents/reference_letter")) {
                    $reference_letter_path = FileHelper::findFiles("./../web/uploads/$model->id/documents/reference_letter", [
                        'caseSensitive' => false,
                        'recursive' => false,
                        'only' => ['reference_letter.*']
                    ]);
                }
                
                if (count($reference_letter_path) > 0) {
                   echo Html::a('<span class="glyphicon glyphicon-download"></span>', ['student/download-reference-letter', 'id' => $model->id], ['class' => 'btn btn-link']);
                }

                echo FileInput::widget([
                    'name' => 'reference_letter',
                    'pluginOptions' => [
                        'uploadUrl' => Url::to(['/student/upload-reference-letter']),
                        'showPreview'=> true,
                        'showCaption' => false,
                        'uploadExtraData' => [
                            'student_id' => $model->id,
                        ]
                    ]
                ]);
            ?>
        </td>
    </tr>
    <tr>
        <td>Visa Details</td>
        <td>
            <?php
                $visa_details_path = [];                
                if (is_dir("./../web/uploads/$model->id/documents/visa")) {
                    $visa_details_path = FileHelper::findFiles("./../web/uploads/$model->id/documents/visa", [
                        'caseSensitive' => false,
                        'recursive' => false,
                        'only' => ['visa.*']
                    ]);
                }
                
                if (count($visa_details_path) > 0) {
                   echo Html::a('<span class="glyphicon glyphicon-download"></span>', ['student/download-visa-details', 'id' => $model->id], ['class' => 'btn btn-link']);
                }

                echo FileInput::widget([
                    'name' => 'upload_visa',
                    'pluginOptions' => [
                        'uploadUrl' => Url::to(['/student/upload-visa-details']),
                        'showPreview'=> true,
                        'showCaption' => false,
                        'uploadExtraData' => [
                            'student_id' => $model->id,
                        ]
                    ]
                ]);
            ?>
        </td>
    </tr>
    <tr>
        <td>XYZ</td>        
        <td><span class="glyphicon glyphicon-download"></span><span class="glyphicon glyphicon-upload"></span></td>
    </tr>    
</table>
