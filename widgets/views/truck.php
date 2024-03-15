<?php
/**
 * @var $trucks
 * @var $form
 * @var $model
 */
?>

<div class="form-row">
    <div class="form-group col-md-3">
        <?= $form->field($model, "label")->dropDownList(\yii\helpers\ArrayHelper::map($trucks, 'id', 'label')); ?>
    </div>
    <div class="form-group col-md-2">
        <?= $form->field($model, 'quantity'); ?>
    </div>
    <div class="form-group col-md-2">
        <?= $form->field($model, 'uom')->dropDownList(\app\models\Tickets::getUomOptions()); ?>
    </div>
    <div class="form-group col-md-2">
        <?= $form->field($model, 'rate')->textInput(['disabled' => true])->label('Reg rate'); ?>
    </div>
    <div class="form-group col-md-2">
        <?= $form->field($model, 'total'); ?>
    </div>
    <div class="container" style="margin-top: -30px">
        <div class="form-group row">
            <label for="inputExample" class="col-sm-8 col-form-label">Sub-Total</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" disabled id="inputExample" value="360">
            </div>
        </div>
        <!-- Add additional form groups as needed -->
    </div>
</div>
