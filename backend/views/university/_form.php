<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use yii\helpers\FileHelper;
use kartik\file\FileInput;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\University */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
    $location = $model->location;
    $location = str_replace([' ', ',,'], ',', $location);
    $location = str_replace(['POINT', 'GeomFromText(\'', '\')'], '', $location);
    $city_data = [];
    $state_data = [];
    if (isset($model->city_id)) {
        $city_data = [$model->city_id => $model->city->name];
    }

    if (isset($model->state_id)) {
        $state_data = [$model->state_id => $model->state->name];
    }

    $initialPreview = [];
    if (is_dir("./../web/uploads/$model->id/cover_photo")) {
        $cover_photo_path = FileHelper::findFiles("./../web/uploads/$model->id/cover_photo", [
            'caseSensitive' => true,
            'recursive' => false,
            'only' => ['cover.*']
        ]);       
    
        if (count($cover_photo_path) > 0) {
            $initialPreview = [Html::img($cover_photo_path[0], ['title' => $model->name, 'class' => 'cover-photo'])];
        }
    }    
    
?>
<div class="university-form">    
    <?php $form = ActiveForm::begin(['id' => 'university-active-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
    <?= Html::a('Courses', ['university-course-list/view', 'id' => $model->id], ['class' => 'profile-link']) ?>
    <?= $form->field($upload, 'imageFile')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showUpload' => false,
                'showPreview' => true,
                'intialPreviewAsData' => true,                
                'resizeImages' => true,
                'minImageWidth' => 1350,
                'initialPreview' => $initialPreview,
                'minImageHeight' => 650,
            ]
        ]); 
    ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'id' => 'university-name']) ?>

    <?= $form->field($model, 'establishment_date')->widget(DatePicker::classname(),[
            'name' => 'date_picker_1',
            'type' => DatePicker::TYPE_INPUT,
            'pluginOptions' => [
                'autoClose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
    ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true, 'id' => 'univesity-address']) ?>

    <?= $form->field($model, 'country_id')->dropDownList($countries, ['id' => 'country_id']); ?>
    <?= $form->field($model, 'state_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'state_id'],
        'data' => $state_data,
        'type' => DepDrop::TYPE_SELECT2,
        'pluginOptions' => [
            'depends' => ['country_id'],
            'placeholder' => 'Select State',
            'url' => Url::to(['/university/dependent-states'])
        ]
    ]); ?>
    <?= $form->field($model, 'city_id')->widget(DepDrop::classname(), [
        'options' => ['id' => 'city_id'],
        'data' => $city_data,
        'type' => DepDrop::TYPE_SELECT2,
        'pluginOptions' => [
            'depends' => ['country_id', 'state_id'],
            'placeholder' => 'Select City',
            'url' => Url::to(['/university/dependent-cities'])
        ]
    ]); ?>

    <?= $form->field($model, 'pincode')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_person_designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput([
            'id' => 'university-location',
            'value' => $location
        ]);
    ?>    
    <div id="google-map-container"></div>   

    <?= $form->field($model, 'institution_type')->textInput() ?>

    <?= $form->field($model, 'establishment')->textInput() ?>

    <?= $form->field($model, 'no_of_students')->textInput() ?>

    <?= $form->field($model, 'no_of_internation_students')->textInput() ?>

    <?= $form->field($model, 'no_faculties')->textInput() ?>

    <?= $form->field($model, 'no_of_international_faculty')->textInput() ?>

    <?= $form->field($model, 'cost_of_living')->textInput() ?>

    <?= $form->field($model, 'accomodation_available')->checkbox() ?>

    <?= $form->field($model, 'hostel_strength')->textInput() ?>    

    <?= $form->field($model, 'institution_ranking')->textInput() ?>

    <?= $form->field($model, 'ranking_sources')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'video')->textInput() ?>

    <?= $form->field($model, 'virtual_tour')->textInput() ?>

    <?= $form->field($model, 'avg_rating')->textInput() ?>

    <?= $form->field($model, 'standard_tests_required')->checkbox() ?>

    <?= $form->field($model, 'standard_test_list')->textInput() ?>

    <?= $form->field($model, 'achievements')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'comments')->textarea(['rows' => 6]) ?>   

    <?= $this->render('_departments', [
        'model' => $model,
        'form' => $form,
        'departments' => $departments
    ]) ?>

    <?= $this->render('_courses', [
        'model'=>$model,
        'courses' => $courses,
        'form' => $form,        
        'degree' => $degree,
        'majors' => $majors,
        'departments' => $departments
    ]) ?>

    <?= $this->render('_university_admission_form', [
        'model'=>$model,
        'univerityAdmisssions' => $univerityAdmisssions,
        'form' => $form,        
        'degree' => $degree,
        'majors' => $majors,
        'departments' => $departments,
        'courses' => $courses,
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>    

    <?php ActiveForm::end(); ?>

</div>
