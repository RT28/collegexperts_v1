<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\DegreeTypes;

/* @var $this yii\web\View */
/* @var $model common\models\Degree */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Degrees', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="degree-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [            
            'name',
            [
                'label' => 'Type',
                'value' => DegreeTypes::$degreeTypes[$model->type]
            ],
            [
                'label' => 'Duration',
                'value' => $model->duration . ' years'
            ],
        ],
    ]) ?>

</div>
