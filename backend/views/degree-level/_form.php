<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\DegreeLevel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="degree-level-form">

    <?php $form = ActiveForm::begin(); ?>
    <div clas=="row">
        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">Degree Level</div>
                <div class="panel-body">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>                
            </div>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>         
    </div>   

    <?php ActiveForm::end(); ?>

</div>
