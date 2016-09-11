<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\University */
/* @var $form ActiveForm */
?>

<div class="addUniversity">
	<?php
		echo GridView::widget([
			'dataProvider' => $provider,
			'columns' => [
				'id',
				'name',
				[
					'class' => 'yii\grid\ActionColumn',
					'template' => '{view}',
					'buttons' => [
						'view' => function($url, $model, $key) {
							return Html::a('View', '?r=site/add-university&id=' . $model->id);
						}
					]
				],
			],
		]);
	?>
</div><!-- addUniversity -->
