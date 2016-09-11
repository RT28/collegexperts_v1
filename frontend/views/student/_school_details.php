<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<h3>School Details </h3>
<?php foreach ($model as $school): ?>
	<?= DetailView::widget([
        'model' => $school,
        'attributes' => [
        'name',
        'from_date',
        'to_date',
        'curriculum',
    ],
	]); ?>
<?php endforeach; ?>
