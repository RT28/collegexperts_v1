<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Majors */

$this->title = 'Create Majors';
$this->params['breadcrumbs'][] = ['label' => 'Majors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="majors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
