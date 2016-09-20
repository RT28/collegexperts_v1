<?php
    use yii\helpers\Html;
    use kartik\select2\Select2;   
?>

<?php
    $location = $model->location;
    $location = str_replace([' ', ',,'], ',', $location);
    $location = str_replace(['POINT', 'GeomFromText(\'', '\')'], '', $location);
?>

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">Standard Tests & Requirements</div>
            <div class="panel-body">
                <?= $form->field($model, 'standard_tests_required')->checkbox() ?>
                <?= $form->field($model, 'standard_test_list')->widget(Select2::classname(), [
                    'name' => 'color_2',                    
                    'data' => [
                        '0' => 'TOEFL',
                        '1' => 'IELTS',
                        '2' => 'SAT',
                        '3' => 'GRE',
                        '4' => 'GMAT'
                    ],
                    'maintainOrder' => true,
                    'options' => ['placeholder' => 'Select a test ...', 'multiple' => true],
                    'pluginOptions' => [
                        'tags' => true,                        
                    ]
                ]) ?>
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