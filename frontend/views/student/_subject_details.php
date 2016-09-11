<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<h3>Subject Details </h3>
<?php foreach ($model as $subject): ?>
	<?= DetailView::widget([
        'model' => $subject,
        'attributes' => [
        'name',
        'marks_obtained',
        'maximum_marks',
    ],
	]); ?>
<?php endforeach; ?>
