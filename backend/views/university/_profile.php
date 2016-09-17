<?php
    use yii\helpers\Html;
    use kartik\date\DatePicker;
    use kartik\depdrop\DepDrop;
    use yii\helpers\Url;
    use yii\helpers\FileHelper;
    use kartik\file\FileInput;
    use dosamigos\ckeditor\CKEditor;
    use yii\widgets\ActiveForm;
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
    
?>
<?php $form = ActiveForm::begin(['id' => 'university-admission-form']); ?>
<div class="panel panel-default">
    <div class="panel-heading">Name</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'id' => 'university-name']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-4">
                <?= $form->field($model, 'establishment_date')->widget(DatePicker::classname(),[
                       'name' => 'date_picker_1',
                        'type' => DatePicker::TYPE_INPUT,
                        'pluginOptions' => [
                        'autoClose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]);?>
            </div>
            <div class="col-xs-12 col-sm-4">
                <?= $form->field($model, 'institution_type')->textInput() ?>
            </div>
            <div class="col-xs-12 col-sm-4">
                <?= $form->field($model, 'establishment')->textInput() ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Address</div>
            <div class="panel-body">
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
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Location</div>
            <div class="panel-body">
                <?= $form->field($model, 'location')->textInput([
                        'id' => 'university-location',
                        'value' => $location
                    ]);
                ?>    
                <div id="google-map-container"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Contact</div>
            <div class="panel-body">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <?= $form->field($model, 'phone_1')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <?= $form->field($model, 'phone_2')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
                <?= $form->field($model, 'contact_person')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'contact_person_designation')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'contact_email')->textInput(['maxlength' => true]) ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <?= $form->field($model, 'contact_mobile')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Student & Faculty</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <?= $form->field($model, 'no_of_students')->textInput() ?>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <?= $form->field($model, 'no_of_internation_students')->textInput() ?>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <?= $form->field($model, 'no_faculties')->textInput() ?>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <?= $form->field($model, 'no_of_international_faculty')->textInput() ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Cost of Living & Accomodation</div>
            <div class="panel-body">
                <?= $form->field($model, 'accomodation_available')->checkbox(['options' => ['id' => 'university-accomodation']]) ?>
                <div class="row">                
                    <div class="col-xs-12 col-sm-6">
                        <?= $form->field($model, 'hostel_strength')->textInput() ?>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <?= $form->field($model, 'cost_of_living')->textInput() ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">University Rankings</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">                    
                        <?= $form->field($model, 'institution_ranking')->textInput() ?>                
                    </div>
                    <div class="col-xs-12 col-sm-6">                    
                        <?= $form->field($model, 'ranking_sources')->textInput() ?>                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Misc.</div>
            <div class="panel-body">                
                <?= $form->field($model, 'virtual_tour')->textInput() ?>                
                <?= $form->field($model, 'video')->textInput() ?>                
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Standard Tests & Requirements</div>
            <div class="panel-body">                
                <?= $form->field($model, 'standard_tests_required')->checkbox() ?>                                  
                <?= $form->field($model, 'standard_test_list')->textInput() ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Description</div>
            <div class="panel-body">
                <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                    'options' => ['rows' => 6],
                    'preset' => 'basic'
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Achievements</div>
            <div class="panel-body">
                <?= $form->field($model, 'achievements')->widget(CKEditor::className(), [
                    'options' => ['rows' => 6],
                    'preset' => 'basic'
                ]) ?>
            </div>
        </div>
    </div>
</div>

<div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>    

    <?php ActiveForm::end(); ?>