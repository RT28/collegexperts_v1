<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Degree */

$this->title = 'Update Degree: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Degrees', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="degree-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'degreeTypes' => $degreeTypes
    ]) ?>

</div>
