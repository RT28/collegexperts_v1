<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\State */

$this->title = 'Update State: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'States', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="state-create">
    <h1><?= Html::encode($this->title) ?></h1>    

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'update-state-form']); ?>

				<?= $form->field($model, 'country_id')->widget(Select2::classname(),[
                		'data' => $countries,
                		'options' => ['placeholder' => 'Country'],
                		'pluginOptions' => [
                			'allowClear' => true
                		]
                	]);
            	?>
                <?= $form->field($model, 'name')->textInput() ?>               

                <div class="form-group">
                    <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
