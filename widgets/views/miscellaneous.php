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
        <?= $form->field($model, 'description'); ?>
    </div>
    <div class="form-group col-md-2">
        <?= $form->field($model, 'cost'); ?>
    </div>
    <div class="form-group col-md-2">
        <?= $form->field($model, 'price'); ?>
    </div>
    <div class="form-group col-md-2">
        <?= $form->field($model, 'quantity'); ?>
    </div>
    <div class="form-group col-md-2">
        <?= $form->field($model, 'total')->textInput(['disabled' => true]); ?>
    </div>
    <div class="container" style="margin-top: -30px">
        <div class="form-group row">
            <label for="inputExample" class="col-sm-8 col-form-label">Sub-Total</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" disabled id="inputExample" value="251">
            </div>
        </div>
        <!-- Add additional form groups as needed -->
    </div>
</div>
