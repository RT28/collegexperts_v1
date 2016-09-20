<?php
use yii\helpers\Html;
use yii\helpers\FileHelper;
use kartik\file\FileInput;
use yii\widgets\ActiveForm;
?>

<?php
    $initialPreview = [];
    if (is_dir("./../web/uploads/$model->id/cover_photo")) {
        $cover_photo_path = FileHelper::findFiles("./../web/uploads/$model->id/cover_photo", [
            'caseSensitive' => true,
            'recursive' => false,
            'only' => ['cover.*']
        ]);       
    
        if (count($cover_photo_path) > 0) {
            $initialPreview = [Html::img($cover_photo_path[0], ['title' => $model->name])];
        }
    }
?>
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
<div class="col-xs-12 col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading">Misc.</div>
        <div class="panel-body">                
            <?= $form->field($model, 'virtual_tour')->textInput() ?>                
            <?= $form->field($model, 'video')->textInput() ?>                
        </div>
    </div>
</div>