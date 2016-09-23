<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
?>

<h3>Subject Details </h3>
<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Marks Obtained</th>
        <th>Maximum Marks</th>        
    </tr>
    <?php foreach ($model as $subject): ?>
        <tr>
            <td><?= $subject->name ?></td>
            <td><?= $subject->marks_obtained ?></td>            
            <td><?= $subject->maximum_marks ?></td>
        </tr>
    <?php endforeach; ?>
</table>