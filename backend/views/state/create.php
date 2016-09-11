<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model common\models\State */

$this->title = 'Create State';
$this->params['breadcrumbs'][] = ['label' => 'States', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="state-create">
    <h1><?= Html::encode($this->title) ?></h1>    

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'add-state-form']); ?>

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
