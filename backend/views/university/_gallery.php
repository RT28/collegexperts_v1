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
<?php $form = ActiveForm::begin(['id' => 'university-admission-form']); ?>
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
<div class="form-group text-center">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>    

    <?php ActiveForm::end(); ?>