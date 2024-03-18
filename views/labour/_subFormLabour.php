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
            <?= $form->field($model, 'uom')->dropDownList(\app\models\Tickets::getUomOptions(), ['class' => 'uom-labour form-control']); ?>
        </div>
        <div class="form-group col-md-1">
            <?= $form->field($model, 'regular_rate')->textInput(['readonly' => true, 'value' => 22, 'class' => 'reg-rate-labour form-control'])->label('Reg rate'); ?>
        </div>
        <div class="form-group col-md-1">
            <?= $form->field($model, 'reg_hours')->textInput(['class' => 'reg-hours-labour form-control']); ?>
        </div>
        <div class="form-group col-md-2">
            <?= $form->field($model, 'overtime_rate')->textInput(['readonly' => true, 'value' => 33, 'class' => 'overtime-rate-labour form-control']); ?>
        </div>
        <div class="form-group col-md-1">
            <?= $form->field($model, 'overtime')->textInput(['class' => 'overtime-labour form-control']); ?>
        </div>
        <?= $form->field($model, 'total')->hiddenInput(['class' => 'sub-total-labour form-control'])->label(false); ?>
        <div class="form-group col-md-2" style="margin-top: 35px; text-align: center">
            <button class="btn btn-danger remove-sub-form-labour">X</button>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success', 'id' => 'save_dynamic-labour']); ?>
        </div>
    </div>
</div>
<?php
\yii\bootstrap4\ActiveForm::end();
?>
