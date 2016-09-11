<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UniversitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Universities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="university-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create University', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            //'establishment_date',
            'address',
            'city.name',
            'state.name',
            'country.name',
            // 'pincode',
            'email:email',
            'website',
            // 'description:ntext',
            // 'fax',
            'phone_1',
            //'phone_2',
            'contact_person',
            //'contact_person_designation',
            //'contact_mobile',
            //'contact_email:email',
            //'location',
            //'institution_type',
            // 'establishment',
            // 'no_of_students',
            // 'no_of_internation_students',
            // 'no_faculties',
            // 'cost_of_living',
            // 'accomodation_available:boolean',
            // 'hostel_strength',            
            // 'institution_ranking',
            // 'ranking_sources:ntext',
            // 'vide:ntext',
            // 'virual_tour:ntext',
            // 'avg_rating',
            // 'comments:ntext',
            // 'status',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',
            // 'reviewed_by',
            // 'reviewed_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
