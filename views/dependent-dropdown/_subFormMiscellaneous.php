<?php

use yii\helpers\Html;

/* @var $model app\models\Miscellaneous */
/* @var $index integer */
?>
<div class="sub-form">
    <div class="form-row">
        <?= Html::activeHiddenInput($model, "[$index]ticket_id"); ?>
        <div class="form-group col-md-2">
            <?= Html::activeLabel($model, "[$index]description") ?>
            <?= Html::activeTextInput($model, "[$index]description", ['class' => 'form-control']); ?>
        </div>
        <div class="form-group col-md-2">
            <?= Html::activeLabel($model, "[$index]cost") ?>
            <?= Html::activeTextInput($model, "[$index]cost", ['class' => 'form-control']); ?>
        </div>
        <div class="form-group col-md-2">
            <?= Html::activeLabel($model, "[$index]price") ?>
            <?= Html::activeTextInput($model, "[$index]price", ['class' => 'form-control']); ?>
        </div>
        <div class="form-group col-md-2">
            <?= Html::activeLabel($model, "[$index]quantity") ?>
            <?= Html::activeTextInput($model, "[$index]quantity", ['class' => 'form-control']); ?>
        </div>
        <div class="form-group col-md-2">
            <?= Html::activeLabel($model, "[$index]total") ?>
            <?= Html::activeTextInput($model, "[$index]total", ['class' => 'form-control']); ?>
        </div>
        <div class="form-group col-md-1" style="margin-top: 35px">
            <span class="remove-sub-form" style="cursor: pointer"><img src="/image/test.svg" alt="remove" width="30" height="30"></span>
        </div>
    </div>
</div>

