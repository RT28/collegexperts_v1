<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Student */

$this->title = 'Profile';
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-view">

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
            'first_name',
            'last_name',
            'date_of_birth',
            'gender',
            'address',
            'street',
            'city',
            'state',
            'country',
            'pincode',
            'email:email',
            'parent_email:email',
            'phone',
            'parent_phone',
        ],
    ]) ?>

    <?= $this->render('_school_details', [
            'model' => $model->studentSchoolDetails
        ]);
    ?>

    <?= $this->render('_college_details', [
            'model' => $model->studentCollegeDetails
        ]);
    ?>

    <?= $this->render('_subject_details', [
            'model' => $model->studentSubjectDetails
        ]);
    ?>

    <?= $this->render('_english_language_proficiencey_details', [
            'model' => $model->studentEnglishLanguageProficienceyDetails
        ]);
    ?>

    <?= $this->render('_standard_test_details', [
            'model' => $model->studentStandardTestDetails
        ]);
    ?>

</div>
