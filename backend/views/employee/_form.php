<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Employee */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    $state_data = []; 
    if (isset($model->state)) {
        $state_data = [$model->state => $model->state0->name];
    }
?>
<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="panel panel-default">
                <div class="panel-heading">Employee</div>
                <div class="panel-body">
                    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'date_of_birth')->widget(DatePicker::classname(),[
                        'name' => 'date_of_birth',
                         'type' => DatePicker::TYPE_INPUT,
                         'pluginOptions' => [
                         'autoClose' => true,
                         'format' => 'yyyy-mm-dd'
                     ]
                    ]);?>                  

                    <?= $form->field($model, 'gender')->dropDownList(['M' => 'M', 'F' => 'F'], ['id' => 'institution_type']); ?>                    

                    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'city')->textInput() ?>

                    <?= $form->field($model, 'country')->dropDownList($countries, ['id' => 'country']); ?>                   

                    <?= $form->field($model, 'state')->widget(DepDrop::classname(), [
                        'options' => ['id' => 'state'],
                        'data' => $state_data,
                        'type' => DepDrop::TYPE_SELECT2,
                        'pluginOptions' => [
                            'depends' => ['country'],
                            'placeholder' => 'Select State',
                            'url' => Url::to(['/employee/dependent-states'])
                        ]
                        ]);
                    ?>           

                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
