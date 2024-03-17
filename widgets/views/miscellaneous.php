<?php
/**
 * @var $form
 * @var $model
 */
$form = \yii\bootstrap4\ActiveForm::begin([
    'id' => 'ticket-form-dynamic'
]); ?>
<h6 style="text-align: left">Miscellaneous</h6>
<div id="sub-forms-container"></div>
<div id="misc_container" style="text-align: left">
    <?php if (!empty($model)): ?>
        <?php foreach ($model as $index => $mod): ?>
            <div class="form-row sub-form">
                <div class="form-group col-md-2">
                    <?= $form->field($mod, "[$index]description")->textInput(); ?>
                </div>
                <div class="form-group col-md-2">
                    <?= $form->field($mod, "[$index]cost")->textInput(); ?>
                </div>
                <div class="form-group col-md-2">
                    <?= $form->field($mod, "[$index]price")->textInput(['class' => 'miscellaneous-price form-control']); ?>
                </div>
                <div class="form-group col-md-2">
                    <?= $form->field($mod, "[$index]quantity")->textInput(['class' => 'miscellaneous-quantity form-control']); ?>
                </div>
                <div class="form-group col-md-2">
                    <?= $form->field($mod, "[$index]total")->textInput(['readonly' => true, 'class' => 'miscellaneous-total form-control']); ?>
                </div>

                <div class="form-group col-md-2 text-center" style="margin-top: 30px">
                    <button type="button" id="<?= $mod->id ?>" class="btn btn-danger remove-sub-form">X</button>
                    <button type="button" class="btn btn-primary add-sub-form">+</button>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="container" style="margin-top: -20px">
            <div class="form-group row">
                <label for="inputExample" class="col-sm-8 col-form-label"><b>Sub-Total</b></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control miscellaneous-sub_total" disabled>
                </div>
            </div>
        </div>
    <?php endif; ?>
        <?= \yii\bootstrap4\Html::submitButton('Save', ['id' => 'save-dynamic-form-misc', 'style' => 'display: none']); ?>
</div>
<?php
\yii\bootstrap4\ActiveForm::end();
?>
