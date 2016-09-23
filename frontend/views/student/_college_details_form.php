<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\date\DatePicker;

/**
 * var @schools array of students school details
 * var @form is active form.
*/
?>

<div class="panel panel-default">
    <div class="panel-heading"><h4>College Details</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_student_college', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.college-container-items', // required: css class selector
                'widgetItem' => '.college-item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $colleges[0],
                'formId' => 'school-active-form',
                'formFields' => [
                    'name',
                    'from_date',
                    'to_date',
                    'curriculum',
                ],
            ]); ?>

            <div class="college-container-items"><!-- widgetContainer -->
            <?php foreach ($colleges as $i => $colleges): ?>
                <div class="college-item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">College Details</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $colleges->isNewRecord) {
                                echo Html::activeHiddenInput($colleges, "[{$i}]id");
                            }
                        ?>
                        <?= $form->field($colleges, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($colleges, "[{$i}]from_date")->widget(DatePicker::classname(),[
                                        'name' => 'from_date_picker',
                                        'type' => DatePicker::TYPE_INPUT,
                                        'pluginOptions' => [
                                            'autoClose' => true,
                                            'format' => 'yyyy'
                                        ]
                                    ]);
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($colleges, "[{$i}]to_date")->widget(DatePicker::classname(),[
                                        'name' => 'from_date_picker',
                                        'type' => DatePicker::TYPE_INPUT,
                                        'pluginOptions' => [
                                            'autoClose' => true,
                                            'format' => 'yyyy'
                                        ]
                                    ]);
                                ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($colleges, "[{$i}]curriculum")->textInput(['maxlength' => true]) ?>
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