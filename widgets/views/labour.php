<?php
/**
 * @var $staff
 * @var $positions
 * @var $form
 * @var $model
 */
?>

<div class="form-row">
    <div class="form-group col-md-2">
        <?= $form->field($model, "staff_id")->dropDownList(\yii\helpers\ArrayHelper::map($staff, 'id', 'name')); ?>
    </div>
    <div class="form-group col-md-2">
        <?= $form->field($model, "position_id")->dropDownList(\yii\helpers\ArrayHelper::map($positions, 'id', 'title')); ?>
    </div>
    <div class="form-group col-md-2">
        <?= $form->field($model->position, 'uom')->dropDownList(\app\models\Tickets::getUomOptions()); ?>
    </div>
    <div class="form-group col-md-1">
        <?= $form->field($model->position, 'regular_rate')->textInput(['disabled' => true])->label('Reg rate'); ?>
    </div>
    <div class="form-group col-md-1">
        <?= $form->field($model, 'reg_hours'); ?>
    </div>
    <div class="form-group col-md-2">
        <?= $form->field($model->position, 'overtime_rate')->textInput(['readonly' => true]); ?>
    </div>
    <div class="form-group col-md-1">
        <?= $form->field($model, 'overtime'); ?>
    </div>
    <?= $form->field($model, 'total')->hiddenInput()->label(false); ?>

    <div class="container" style="margin-top: -30px">
        <div class="form-group row">
            <label for="inputExample" class="col-sm-8 col-form-label">Sub-Total</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" disabled id="labour_sub-total" value="0">
            </div>
        </div>
        <!-- Add additional form groups as needed -->
    </div>
</div>
