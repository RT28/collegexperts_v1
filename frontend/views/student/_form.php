<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">

    <?php $form = ActiveForm::begin(['id' => 'school-active-form']); ?>

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
