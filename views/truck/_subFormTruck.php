<?php

use yii\helpers\Html;

/* @var $model app\models\TrucksQuery */
/* @var $index integer */
/* @var $counter integer */
/* @var $ticketId integer */
/* @var $trucks \app\models\Trucks */

$form = \yii\bootstrap4\ActiveForm::begin([
    'id' => 'ticket-form-dynamic-sub-truck',
]); ?>

<div class="sub-form-truck">
    <div class="form-row">
        <div class="form-group col-md-2">
            <?= $form->field($model, "label")->dropDownList(\yii\helpers\ArrayHelper::map($trucks, 'id', 'label')); ?>
        </div>
        <div class="form-group col-md-2">
            <?= $form->field($model, 'quantity'); ?>
        </div>
        <div class="form-group col-md-2">
            <?= $form->field($model, 'uom')->dropDownList(\app\models\Tickets::getUomOptions()); ?>
        </div>
        <div class="form-group col-md-2">
            <?= $form->field($model, 'rate')->textInput(['readonly' => true, 'value' => 99])->label('Reg rate'); ?>
        </div>
        <div class="form-group col-md-2">
            <?= $form->field($model, 'total')->textInput(['readonly' => true]); ?>
        </div>
        <div class="form-group col-md-2" style="margin-top: 35px">
            <button class="btn btn-danger remove-sub-form-truck">X</button>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'id' => 'save_dynamic-truck']); ?>
        </div>
    </div>
</div>
<?php
\yii\bootstrap4\ActiveForm::end();
?>
