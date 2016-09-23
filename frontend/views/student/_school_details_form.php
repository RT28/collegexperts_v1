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
    <div class="panel-heading"><h4>School Details</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_student_school', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.school-container-items', // required: css class selector
                'widgetItem' => '.school-item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $schools[0],
                'formId' => 'school-active-form',
                'formFields' => [
                    'name',
                    'from_date',
                    'to_date',
                    'curriculum',
                ],
            ]); ?>

            <div class="school-container-items"><!-- widgetContainer -->
            <?php foreach ($schools as $i => $schools): ?>
                <div class="school-item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">School Details</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $schools->isNewRecord) {
                                echo Html::activeHiddenInput($schools, "[{$i}]id");
                            }
                        ?>
                        <?= $form->field($schools, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($schools, "[{$i}]from_date")->widget(DatePicker::classname(),[
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
                                <?= $form->field($schools, "[{$i}]to_date")->widget(DatePicker::classname(),[
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
                                <?= $form->field($schools, "[{$i}]curriculum")->textInput(['maxlength' => true]) ?>
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
