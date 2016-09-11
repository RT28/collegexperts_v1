<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;

$dept = ArrayHelper::map($departments, 'id', 'name');
?>

<div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Courses</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_courses', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.course-items', // required: css class selector
                'widgetItem' => '.course-item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $courses[0],
                'formId' => 'university-active-form',
                'formFields' => [
                    'name',
                    'degree_id',
                    'major_id',
                    'intake',
                    'fees',
                    'duration',
                    'type',
                    'department_id',
                ],
            ]); ?>

            <div class="course-items"><!-- widgetContainer -->
            <?php foreach ($courses as $i => $courses): ?>
                <div class="course-item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Courses</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $courses->isNewRecord) {
                                echo Html::activeHiddenInput($courses, "[{$i}]id");
                            }
                        ?>
                        <?= $form->field($courses, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($courses, "[{$i}]department_id")->dropDownList($dept, ['id' => 'department_id']) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($courses, "[{$i}]degree_id")->dropDownList($degree, ['id' => 'degree_id']) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($courses, "[{$i}]major_id")->dropDownList($majors, ['id' => 'major_id']) ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">                            
                            <div class="col-sm-3">
                                <?= $form->field($courses, "[{$i}]intake")->textInput(['rows' => 6]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($courses, "[{$i}]fees")->textInput(['rows' => 6]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($courses, "[{$i}]duration")->textInput(['rows' => 6]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($courses, "[{$i}]type")->textInput(['rows' => 6]) ?>
                            </div>                            
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
