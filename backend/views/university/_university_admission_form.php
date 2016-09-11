<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

$dept = ArrayHelper::map($departments, 'id', 'name');
$course = ArrayHelper::map($courses, 'id', 'name');

/**
 * var @univerityAdmisssions array of students school details
 * var @form is active form.
*/
?>

<div class="panel panel-default">
    <div class="panel-heading"><h4>Admissions</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_university_admissions', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.university_admission-container-items', // required: css class selector
                'widgetItem' => '.admission-item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $univerityAdmisssions[0],
                'formId' => 'school-active-form',
                'formFields' => [
                    'start_date',
                    'end_date',
                    'course_id',
                    'department_id',
                    'major_id',
                    'admission_link',
                    'eligibility_criteria',
                    'admission_fees',
                ],
            ]); ?>

            <div class="university_admission-container-items"><!-- widgetContainer -->
            <?php foreach ($univerityAdmisssions as $i => $univerityAdmisssions): ?>
                <div class="admission-item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Admissions</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $univerityAdmisssions->isNewRecord) {
                                echo Html::activeHiddenInput($univerityAdmisssions, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($univerityAdmisssions, "[{$i}]department_id")->dropDownList($dept, ['id' => 'department_id']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($univerityAdmisssions, "[{$i}]start_date")->widget(DatePicker::classname(),[
                                        'name' => 'date_picker_2',
                                        'type' => DatePicker::TYPE_INPUT,
                                        'pluginOptions' => [
                                            'autoClose' => true,
                                            'format' => 'yyyy-mm-dd'
                                        ]
                                    ]);
                                ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($univerityAdmisssions, "[{$i}]end_date")->widget(DatePicker::classname(),[
                                        'name' => 'date_picker_2',
                                        'type' => DatePicker::TYPE_INPUT,
                                        'pluginOptions' => [
                                            'autoClose' => true,
                                            'format' => 'yyyy-mm-dd'
                                        ]
                                    ]);
                                ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($univerityAdmisssions, "[{$i}]course_id")->dropDownList($course, ['id' => 'course_id']) ?>
                            </div>                            
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($univerityAdmisssions, "[{$i}]major_id")->dropDownList($majors, ['id' => 'major_id']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($univerityAdmisssions, "[{$i}]admission_link")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($univerityAdmisssions, "[{$i}]eligibility_criteria")->textArea(['rows' => 6]) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($univerityAdmisssions, "[{$i}]admission_fees")->textInput(['maxlength' => true]) ?>
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
