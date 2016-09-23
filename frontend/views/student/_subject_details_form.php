<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/**
 * var @subjects array of subjects taken by student
 * var @form is active form.
*/
?>

<div class="panel panel-default">
    <div class="panel-heading"><h4>School Details</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_student_subject', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.subject-container-items', // required: css class selector
                'widgetItem' => '.subject-item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $subjects[0],
                'formId' => 'school-active-form',
                'formFields' => [
                    'name',
                    'from_date',
                    'to_date',
                    'curriculum',
                ],
            ]); ?>

            <div class="subject-container-items"><!-- widgetContainer -->
            <?php foreach ($subjects as $i => $subjects): ?>
                <div class="subject-item panel panel-default"><!-- widgetBody -->
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
                            if (! $subjects->isNewRecord) {
                                echo Html::activeHiddenInput($subjects, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($subjects, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($subjects, "[{$i}]maximum_marks")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($subjects, "[{$i}]marks_obtained")->textInput(['maxlength' => true]) ?>
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
