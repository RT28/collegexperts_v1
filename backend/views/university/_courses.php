<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use wbraganca\dynamicform\DynamicFormWidget;

?>

<div class="panel panel-default">
    <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Courses</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_courses', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.course-items', // required: css class selector
                'widgetItem' => '.course-item', // required: css class                
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-course', // css class
                'deleteButton' => '.remove-course', // css class
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
            
            <table class="course-items table table-bordered"><!-- widgetContainer -->
                <?php foreach ($courses as $i => $courses): ?>                                        
                    <tr class="course-item"><!-- widgetBody -->                    
                        <td>
                            <button type="button" class="add-course btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-course btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </td>
                        <?php
                            // necessary for update action.
                            if (! $courses->isNewRecord) {
                                echo Html::activeHiddenInput($courses, "[{$department}][{$i}]id");
                            }
                        ?>                        
                        <td>
                            <?= $form->field($courses, "[{$department}][{$i}]degree_id")->dropDownList($degree, ['id' => "degree_id[{$i}]"]) ?>
                        </td>
                        <td>
                            <?= $form->field($courses, "[{$department}][{$i}]major_id")->dropDownList($majors, ['id' => "major_id[{$i}]"]) ?>
                        </td>
                        <td>
                            <?= $form->field($courses, "[{$department}][{$i}]intake")->textInput(['rows' => 6]) ?>
                        </td>
                        <td>
                            <?= $form->field($courses, "[{$department}][{$i}]fees")->textInput(['rows' => 6]) ?>
                        </td>
                        <td>
                            <?= $form->field($courses, "[{$department}][{$i}]duration")->textInput(['rows' => 6]) ?>
                        </td>
                        <td>
                            <?= $form->field($courses, "[{$department}][{$i}]type")->dropDownList($courseType, ['id' => "course_type[{$i}]"]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php DynamicFormWidget::end(); ?>
    </div>
</div>