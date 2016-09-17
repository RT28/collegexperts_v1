<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\University */

$this->title = 'Create University';
$this->params['breadcrumbs'][] = ['label' => 'Universities', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="university-create">

    <h1 class="screen-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'countries' => $countries,
        'upload' => $upload,
        'departments' => $departments,
        'courses' => $courses,
        'degree' => $degree,
        'currentTab' => $currentTab,
        'tabs' => $tabs,
        'majors' => $majors,        
        'univerityAdmisssions' => $univerityAdmisssions,
    ]) ?>

</div>
