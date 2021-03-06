<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Json;
use common\models\UniversityCourseList;
use yii\db\Query;

/* @var $this yii\web\View */
/* @var $model backend\models\UniversityDepartments */
/* @var $form ActiveForm */
?>
<div class="panel panel-default">
    <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Departments</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.department-items', // required: css class selector
                'widgetItem' => '.department-item', // required: css class                
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-department', // css class
                'deleteButton' => '.remove-department', // css class
                'model' => $departments[0],
                'formId' => 'university-active-form',
                'formFields' => [
                    'name',
                    'email',
                    'no_of_faculty',
                    'website_link',
                    'description',
                ],
            ]); ?>            
            <table class="department-items table table-bordered"><!-- widgetContainer -->
                <?php foreach ($departments as $i => $departments): ?>
                    <?= Html::activeHiddenInput($model, 'id'); ?>
                    <table class="department-item table table-bordered">
                        <tr ><!-- widgetBody -->
                            <td>
                                <button type="button" class="add-department btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-department btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </td>
                            <?php
                                // necessary for update action.
                                if (! $departments->isNewRecord) {
                                    echo Html::activeHiddenInput($departments, "[{$i}]id");
                                }
                            ?>
                            <td>
                                <?= $form->field($departments, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                            </td>
                            <td>
                                <?= $form->field($departments, "[{$i}]email")->textInput(['maxlength' => true]) ?>
                            </td>                    
                            <td>
                                <?= $form->field($departments, "[{$i}]no_of_faculty")->textInput(['maxlength' => true]) ?>
                            </td>
                            <td>
                                <?= $form->field($departments, "[{$i}]website_link")->textInput(['maxlength' => true]) ?>
                            </td>
                            <td>
                                <?= $form->field($departments, "[{$i}]description")->textarea(['rows' => 6]) ?>
                            </td>                          
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="5">
                                <?php                                    
                                    $courses = $departments->universityCourseLists;                                    
                                    if(empty($courses)) {
                                        $courses = [new UniversityCourseList];
                                    }
                                ?>
                                <?=
                                    $this->render('_courses', [
                                        'model' => $model,
                                        'courses' => $courses,
                                        'degree' => $degree,
                                        'form' => $form,
                                        'majors' => $majors,
                                        'department' => $i,
                                        'departmentModel' => $departments,
                                        'courseType' => $courseType
                                    ]);
                                ?>
                            </td>
                        </tr>
                    </table>                   
                <?php endforeach; ?>
            </table>
        <?php DynamicFormWidget::end(); ?>
    </div>
</div>