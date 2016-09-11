<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UniversityCourseList */

$this->title = 'Create University Course List';
$this->params['breadcrumbs'][] = ['label' => 'University Course Lists', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="university-course-list-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?= $this->render('_form', [
        'model' => $model,
        'degree' => $degree,
        'major' => $major,
    ]) ?>

</div>
