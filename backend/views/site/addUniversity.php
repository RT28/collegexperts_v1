<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

define('ROLE_ADMIN', 1);
/* @var $this yii\web\View */
/* @var $model backend\models\University */
/* @var $form ActiveForm */
?>
<div class="addUniversity">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
    
        <div class="form-group">
            <?= Html::submitInput($label = 'Submit', $options = ['name' => 'chosen', 'class' => 'btn btn-primary']) ?>
            <?= Html::a('Reset', ['site/add-university'], ['class' => 'btn btn-default']) ?>
            <?php            	
            	if(Yii::$app->user->identity->role_id === ROLE_ADMIN && isset($_GET['id'])) {            	
	            	echo Html::a('Delete', ['site/delete-university', 'id' => $_GET['id']], ['class' => 'btn btn-danger']);
	            	echo Html::submitInput($label = 'Update', $options = ['name' => 'chosen', 'class' => 'btn btn-info']);
            	}
        	?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- addUniversity -->
