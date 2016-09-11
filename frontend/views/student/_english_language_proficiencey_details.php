<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<h3>English Language Proficiency</h3>
<?php foreach ($model as $test): ?>
	<?= DetailView::widget([
        'model' => $test,
        'attributes' => [
        'test_name',
        'reading_score',
        'writing_score',
        'listening_score',
        'speaking_score',
    ],
	]); ?>
<?php endforeach; ?>
