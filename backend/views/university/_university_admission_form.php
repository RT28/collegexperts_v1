<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\web\JsExpression;

$dept = ArrayHelper::map($departments, 'id', 'name');

if (count($departments) > 0) {
    $course = $departments[0]->universityCourseLists;
    $course = ArrayHelper::map($course, 'id', 'name');
}

/**
 * var @univerityAdmisssions array of students school details
 * var @form is active form.
*/
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Admissions</h4>
        </div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_university_admissions', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.university_admission-container-items', // required: css class selector
                'widgetItem' => '.admission-item', // required: css class            
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $univerityAdmisssions[0],
                'formId' => 'university-active-form',
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

            <table class="university_admission-container-items table table-bordered"><!-- widgetContainer -->
                <?php foreach ($univerityAdmisssions as $i => $univerityAdmisssions): ?>
                    <tr class="admission-item"><!-- widgetBody -->                       
                        <td>
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </td>
                        <?php
                            // necessary for update action.
                            if (! $univerityAdmisssions->isNewRecord) {
                                echo Html::activeHiddenInput($univerityAdmisssions, "[{$i}]id");
                            }
                        ?>
                        <td>                        
                            <?= $form->field($univerityAdmisssions, "[{$i}]department_id")->dropDownList($dept, ['id' => "admission_department_id{$i}"]) ?>
                        </td>
                        <td>
                            <?= $form->field($univerityAdmisssions, "[{$i}]start_date")->widget(DatePicker::classname(),[
                                'name' => "date_picker_2[{$i}]",
                                'type' => DatePicker::TYPE_INPUT,
                                'pluginOptions' => [
                                    'autoClose' => true,
                                    'format' => 'yyyy-mm-dd'
                            ]]); ?>
                        </td>
                        <td>
                            <?= $form->field($univerityAdmisssions, "[{$i}]end_date")->widget(DatePicker::classname(),[
                                'name' => "date_picker_3[{$i}]",
                                'type' => DatePicker::TYPE_INPUT,
                                'pluginOptions' => [
                                    'autoClose' => true,
                                    'format' => 'yyyy-mm-dd'
                                    ]
                            ]);?>
                        </td>
                        <td>
                            <?= $form->field($univerityAdmisssions, "[{$i}]course_id")->widget(DepDrop::classname(), [
                                'options' => ['id' => "admission_course_id{$i}"],
                                'data' => $course,                                
                                'type' => DepDrop::TYPE_SELECT2,
                                'pluginOptions' => [
                                    'depends' => ["admission_department_id{$i}"],
                                    'placeholder' => 'Select Course',
                                    'url' => Url::to(['/university/dependent-courses'])
                                ]
                            ]); ?>                                                        
                        </td>                        
                        <td>
                            <?= $form->field($univerityAdmisssions, "[{$i}]admission_link")->textInput(['maxlength' => true]) ?>
                        </td>
                        <td>
                            <?= $form->field($univerityAdmisssions, "[{$i}]eligibility_criteria")->textArea(['rows' => 6]) ?>
                        </td>
                        <td>
                            <?= $form->field($univerityAdmisssions, "[{$i}]admission_fees")->textInput(['maxlength' => true]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php DynamicFormWidget::end(); ?>
    </div>
</div>