<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Welcome! <span style="color: #00bcd4;"><?= Yii::$app->user->identity->username ?></span></h1>
    </div>
    <div class="chat_wrapper">
        <div class="message_box" id="message_box"></div>
        <div class="panel">
            <input type="text" name="name" id="name" placeholder="Your Name" maxlength="10" style="width:20%"  />
            <input type="text" name="message" id="message" placeholder="Message" maxlength="80" style="width:60%" />
            <input type="hidden" name="from_id" id="from_id" value="<?= Yii::$app->user->identity->id?>"/> 
            <input type="hidden" name="to_id" id="to_id" value="1"/> 
            <input type="hidden" name="role" id="role" value="4"/>
            <button type="button" id="send-btn">Send</button>
        </div>
    </div>
</div>
