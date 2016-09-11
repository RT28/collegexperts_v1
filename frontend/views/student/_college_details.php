<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<h3>College Details </h3>
<?php foreach ($model as $college): ?>
	<?= DetailView::widget([
        'model' => $college,
        'attributes' => [
        'name',
        'from_date',
        'to_date',
        'curriculum',
    ],
	]); ?>
<?php endforeach; ?>
