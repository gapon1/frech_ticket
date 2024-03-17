<?php
/**
 * @var $form
 * @var $model
 */
$counter = 0;
$form = \yii\bootstrap4\ActiveForm::begin([
    'id' => 'ticket-form-dynamic',
]); ?>
<div id="sub-forms-container"></div>
<div id="misc_container">
    <?php if (!empty($model)): ?>
        <?php foreach ($model as $mod): ?>
            <div class="form-row sub-form">
                <div class="form-group col-md-2">
                    <?= $form->field($mod, 'description')->textInput(['id' => 'miscellaneous-description_id_' . $counter,]); ?>
                </div>
                <div class="form-group col-md-2">
                    <?= $form->field($mod, 'cost')->textInput(['type' => 'number', 'id' => 'miscellaneous-cost_' . $counter]); ?>
                </div>
                <div class="form-group col-md-2">
                    <?= $form->field($mod, 'price')->textInput(['class' => 'miscellaneous-price form-control']); ?>
                </div>
                <div class="form-group col-md-2">
                    <?= $form->field($mod, 'quantity')->textInput(['class' => 'miscellaneous-quantity form-control']); ?>
                </div>
                <div class="form-group col-md-2">
                    <?= $form->field($mod, 'total')->textInput(['readonly' => true, 'class' => 'miscellaneous-total form-control', 'value' => $mod->quantity + $mod->price]); ?>
                </div>

                <div class="form-group col-md-2 text-right" style="margin-top: 30px">
                    <button type="button" id="<?= $mod->id ?>" class="btn btn-danger remove-sub-form">X</button>
                    <button type="button" class="btn btn-primary add-sub-form">+</button>
                </div>


                <div class="container" style="margin-top: -30px">
                    <div class="form-group row">
                        <label for="inputExample" class="col-sm-8 col-form-label">Sub-Total</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control miscellaneous-sub_total" disabled
                                   value="<?= $mod->quantity + $mod->price ?>">
                        </div>
                    </div>
                </div>
            </div>

            <?php $counter++; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php
\yii\bootstrap4\ActiveForm::end();
?>
