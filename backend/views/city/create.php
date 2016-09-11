<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\City */

$this->title = 'Create City';
$this->params['breadcrumbs'][] = ['label' => 'Cities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-create">
    <h1><?= Html::encode($this->title) ?></h1>    
    
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'add-city-form']); ?>

            	<?= $form->field($model, 'country_id')->dropDownList($countries, ['id' => 'country_id']); ?>
            	<?= $form->field($model, 'state_id')->widget(DepDrop::classname(), [
            		'options' => ['id' => 'state_id'],
            		'pluginOptions' => [
            			'depends' => ['country_id'],
            			'placeholder' => 'Select State',
            			'url' => Url::to(['/city/dependent-states'])
            		]
            	]); ?>            	
                <?= $form->field($model, 'name')->textInput() ?>               

                <div class="form-group">
                    <?= Html::submitButton('Create', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>        

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
