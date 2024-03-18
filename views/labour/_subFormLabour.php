<?php

use yii\helpers\Html;

/* @var $model app\models\Labour */
/* @var $index integer */
/* @var $counter integer */
/* @var $ticketId integer */
/* @var $staff */
/* @var $positions */

$form = \yii\bootstrap4\ActiveForm::begin([
    'id' => 'ticket-form-dynamic-sub-labour',
]); ?>
<div class="sub-form-labour">
    <div class="form-row">
        <?= $form->field($model, 'ticket_id')->hiddenInput(['value'=> $ticketId])->label(false); ?>
        <div class="form-group col-md-2">
            <?= $form->field($model, "staff_id")->dropDownList(\yii\helpers\ArrayHelper::map($staff, 'id', 'name')); ?>
        </div>
        <div class="form-group col-md-2">
            <?= $form->field($model, "position_id")->dropDownList(\yii\helpers\ArrayHelper::map($positions, 'id', 'title')); ?>
        </div>
        <div class="form-group col-md-1">
            <?= $form->field($model, 'uom')->dropDownList(\app\models\Tickets::getUomOptions()); ?>
        </div>
        <div class="form-group col-md-1">
            <?= $form->field($model, 'regular_rate')->textInput(['readonly' => true])->label('Reg rate'); ?>
        </div>
        <div class="form-group col-md-1">
            <?= $form->field($model, 'reg_hours'); ?>
        </div>
        <div class="form-group col-md-2">
            <?= $form->field($model, 'overtime_rate')->textInput(['readonly' => true]); ?>
        </div>
        <div class="form-group col-md-1">
            <?= $form->field($model, 'overtime'); ?>
        </div>
        <?= $form->field($model, 'total')->hiddenInput(['value'=> 0])->label(false); ?>
        <div class="form-group col-md-2" style="margin-top: 35px; text-align: center">
            <button class="btn btn-danger remove-sub-form-labour">X</button>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'id' => 'save_dynamic-labour']); ?>
        </div>
    </div>
</div>
<?php
\yii\bootstrap4\ActiveForm::end();
?>
