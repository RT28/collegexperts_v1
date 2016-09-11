<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome! <span style="color: #00bcd4;"><?= Yii::$app->user->identity->username ?></span></h1>
    </div>
</div>
