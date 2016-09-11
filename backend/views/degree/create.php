<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Degree */

$this->title = 'Create Degree';
$this->params['breadcrumbs'][] = ['label' => 'Degrees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="degree-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'degreeTypes' => $degreeTypes
    ]) ?>

</div>
