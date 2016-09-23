<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\FileHelper;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    $initialPreview = [];
    $initialPreviewConfig =[];    
    if (is_dir("./../web/uploads/$model->id/profile_photo")) {
        $cover_photo_path = FileHelper::findFiles("./../web/uploads/$model->id/profile_photo", [
            'caseSensitive' => true,
            'recursive' => false,
        ]);       
    
        if (count($cover_photo_path) > 0) {
            $initialPreview = [Html::img($cover_photo_path[0], ['title' => $model->first_name . ' ' . $model->last_name, 'class' => 'photo-thumbnail'])];
            $initialPreviewConfig = [['caption' => 'Profle' , 'url' => Url::to(['/student/delete-photo']), 'key'=> basename($cover_photo_path[0])]];
        }
    }
?>
<?php $form = ActiveForm::begin(['id' => 'school-active-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="student-form">
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <?= FileInput::widget([
                    'name' => 'profile_photo',
                    'pluginOptions' => [
                        'uploadUrl' => Url::to(['/student/upload-profile-photo']),
                        'deleteUrl' => Url::to(['/student/delete-photo']),
                        'intialPreviewAsData' => true,
                        'uploadExtraData' => [
                            'student_id' => $model->id
                        ],
                        'deleteExtraData' => [
                            'student_id' => $model->id
                        ],
                        'intialPreviewAsData' => true,
                        'initialPreviewConfig' => $initialPreviewConfig,
                        'initialPreview' => $initialPreview                       
                    ]
                ]);?>
            </div>
        </div>   

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_of_birth')->textInput() ?>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city')->textInput() ?>

    <?= $form->field($model, 'state')->textInput() ?>

    <?= $form->field($model, 'country')->textInput() ?>

    <?= $form->field($model, 'pincode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_phone')->textInput(['maxlength' => true]) ?>

    <?= $this->render('_school_details_form', [
            'schools' => $schools,
            'form' => $form,
            'model' => $model,
        ]);
    ?>

    <?= $this->render('_college_details_form', [
            'colleges' => $colleges,
            'form' => $form,
            'model' => $model,
        ]);
    ?>

    <?= $this->render('_subject_details_form', [
            'subjects' => $subjects,
            'form' => $form,
            'model' => $model,
        ]);
    ?>

    <?= $this->render('_english_language_proficiencey_details_form', [
            'englishProficiency' => $englishProficiency,
            'form' => $form,
            'model' => $model,
        ]);
    ?>

    <?= $this->render('_standard_test_detail_form', [
            'standardTests' => $standardTests,
            'form' => $form,
            'model' => $model,
        ]);
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
