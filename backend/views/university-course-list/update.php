<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UniversityCourseList */

$this->title = 'Update University Course List: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'University Course Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="university-course-list-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'degree' => $degree,
        'major' => $major,
    ]) ?>

</div>
