<?php

use yii\helpers\Html;

/* @var $model app\models\Miscellaneous */
/* @var $index integer */
/* @var $counter integer */
/* @var $ticketId integer */

$form = \yii\bootstrap4\ActiveForm::begin([
    'id' => 'ticket-form-dynamic',
]); ?>

<div class="sub-form">
    <div class="form-row">
        <?= $form->field($model, 'ticket_id')->hiddenInput(['value' => $ticketId, 'id' => 'ticket_id_'])->label(false); ?>
        <div class="form-group col-md-2">
            <?= $form->field($model, "description")->textInput(['id' => "miscellaneous-description_"]); ?>
        </div>
        <div class="form-group col-md-2">
            <?= $form->field($model, "cost")->textInput(['id' => "miscellaneous-cost_"]); ?>
        </div>
        <div class="form-group col-md-2">
            <?= $form->field($model, 'price')->textInput(['class' => 'miscellaneous-price form-control']); ?>
        </div>
        <div class="form-group col-md-2">
            <?= $form->field($model, "quantity")->textInput(['class' => 'miscellaneous-quantity form-control']); ?>
        </div>
        <div class="form-group col-md-2">
            <?= $form->field($model, "total")->textInput(['class' => 'miscellaneous-total form-control', 'readonly' => true, 'value' => '0']); ?>
        </div>
        <div class="form-group col-md-2" style="margin-top: 35px">
            <button class="btn btn-danger remove-sub-form">X</button>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'id' => 'save_dynamic']); ?>
        </div>
        <div class="form-group col-md-1">
        </div>
    </div>
</div>
<?php
\yii\bootstrap4\ActiveForm::end();
?>
