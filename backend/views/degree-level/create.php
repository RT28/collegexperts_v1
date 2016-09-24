<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DegreeLevel */

$this->title = 'Create Degree Level';
$this->params['breadcrumbs'][] = ['label' => 'Degree Levels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="degree-level-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
