<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/**
 * var @standardTests array of students school details
 * var @form is active form.
*/
?>

<div class="panel panel-default">
    <div class="panel-heading"><h4>College Details</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_student_tests', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.tests-container-items', // required: css class selector
                'widgetItem' => '.test-item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $standardTests[0],
                'formId' => 'school-active-form',
                'formFields' => [
                    'name',
                    'from_date',
                    'to_date',
                    'curriculum',
                ],
            ]); ?>

            <div class="tests-container-items"><!-- widgetContainer -->
            <?php foreach ($standardTests as $i => $standardTests): ?>
                <div class="test-item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Standard Tests</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $standardTests->isNewRecord) {
                                echo Html::activeHiddenInput($standardTests, "[{$i}]id");
                            }
                        ?>
                        <?= $form->field($standardTests, "[{$i}]test_name")->textInput(['maxlength' => true]) ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($standardTests, "[{$i}]verbal_score")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($standardTests, "[{$i}]quantitative_score")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($standardTests, "[{$i}]integrated_reasoning_score")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($standardTests, "[{$i}]data_interpretation_score")->textInput(['maxlength' => true]) ?>
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
