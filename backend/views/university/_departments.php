<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Json;
use common\models\UniversityCourseList;

/* @var $this yii\web\View */
/* @var $model backend\models\UniversityDepartments */
/* @var $form ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'university-departments-form']); ?>
<div class="panel panel-default">
    <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Departments</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class                
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $departments[0],
                'formId' => 'university-departments-form',
                'formFields' => [
                    'name',
                    'email',
                    'no_of_faculty',
                    'website_link',
                    'description',
                ],
            ]); ?>            
            <table class="container-items table table-bordered"><!-- widgetContainer -->
                <?php foreach ($departments as $i => $departments): ?>
                    <?= Html::activeHiddenInput($model, 'id'); ?>
                    <tr class="item"><!-- widgetBody -->
                        <td>
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
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
                                    'department' => $departments
                                ]);
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php DynamicFormWidget::end(); ?>
    </div>
</div>
<div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>    

    <?php ActiveForm::end(); ?>