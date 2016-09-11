<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<h3>Standard Test Details </h3>
<?php foreach ($model as $test): ?>
	<?= DetailView::widget([
        'model' => $test,
        'attributes' => [
        'test_name',
        'verbal_score',
        'quantitative_score',
        'integrated_reasoning_score',
        'data_interpretation_score',
    ],
	]); ?>
<?php endforeach; ?>
