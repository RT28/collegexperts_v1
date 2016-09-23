<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/**
 * var @englishProficiency array of english proficiency exams taken by student
 * var @form is active form.
*/
?>

<div class="panel panel-default">
    <div class="panel-heading"><h4>School Details</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_student_proficiency', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.proficiency-container-items', // required: css class selector
                'widgetItem' => '.proficiency-item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $englishProficiency[0],
                'formId' => 'school-active-form',
                'formFields' => [
                    'test_name',
                    'reading_score',
                    'writing_score',
                    'listening_score',
                    'speaking_score',
                ],
            ]); ?>

            <div class="proficiency-container-items"><!-- widgetContainer -->
            <?php foreach ($englishProficiency as $i => $englishProficiency): ?>
                <div class="proficiency-item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Subject Details</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $englishProficiency->isNewRecord) {
                                echo Html::activeHiddenInput($englishProficiency, "[{$i}]id");
                            }
                        ?>
                        <?= $form->field($englishProficiency, "[{$i}]test_name")->textInput(['maxlength' => true]) ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($englishProficiency, "[{$i}]reading_score")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($englishProficiency, "[{$i}]writing_score")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($englishProficiency, "[{$i}]listening_score")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($englishProficiency, "[{$i}]speaking_score")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                    </div>
                <?php endforeach; ?>
           </div>
        <?php DynamicFormWidget::end(); ?>
    </div>
</div>
</div>
</div>
