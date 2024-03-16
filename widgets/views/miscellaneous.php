<?php
/**
 * @var $form
 * @var $model
 */
?>
<hr class="hr"/>
<h6>Miscellaneous</h6>
<div class="form-row">
    <div class="form-group col-md-2">
        <?= $form->field($model, 'description'); ?>
    </div>
    <div class="form-group col-md-2">
        <?= $form->field($model, 'cost')->textInput(['type' => 'number']); ?>
    </div>
    <div class="form-group col-md-2">
        <?= $form->field($model, 'price'); ?>
    </div>
    <div class="form-group col-md-2">
        <?= $form->field($model, 'quantity'); ?>
    </div>
    <div class="form-group col-md-2">
        <?= $form->field($model, 'total')->textInput(['readonly' => true]); ?>
    </div>

    <div class="form-group col-md-2 text-right" style="margin-top: 30px">
        <span id="add-sub-form" style="cursor: pointer"><img src="/image/blue.svg" alt="add" width="40" height="40"></span>
    </div>

    <div id="sub-forms-container" style="margin-bottom: 20px; margin-top: -20px"></div>

    <div class="container" style="margin-top: -30px">
        <div class="form-group row">
            <label for="inputExample" class="col-sm-8 col-form-label">Sub-Total</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" disabled id="miscellaneous-sub_total" value="0">
            </div>
        </div>
    </div>
</div>