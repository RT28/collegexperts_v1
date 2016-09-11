<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\UniversityCourseList */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="university-course-list-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>    

    <?= $form->field($model, 'degree_id')->widget(Select2::classname(),[
            'data' => $degree,
            'options' => ['placeholder' => 'Degree']
        ]);
    ?>

    <?= $form->field($model, 'major_id')->widget(Select2::classname(),[
            'data' => $major,
            'options' => ['placeholder' => 'Major']
        ]);
    ?>

    <?= $form->field($model, 'intake')->textInput() ?>

    <?= $form->field($model, 'fees')->textInput() ?>

    <?= $form->field($model, 'duration')->textInput() ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
