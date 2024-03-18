<?php
/**
 * @var $form
 * @var $model
 * @var $staff
 * @var $positions
 */
$form = \yii\bootstrap4\ActiveForm::begin([
    'id' => 'ticket-form-dynamic-labour'
]); ?>
    <div id="misc_container-labour" style="text-align: left">
        <h5 style="text-align: left">Labour</h5>
        <div id="sub-forms-container_main-labour"></div>
        <?php if (!empty($model)): ?>
            <?php foreach ($model as $index => $mod): ?>
                <div class="form-row sub-form-labour">
                    <div class="form-group col-md-2">
                        <?= $form->field($mod, "[$index]staff_id")->dropDownList(\yii\helpers\ArrayHelper::map($staff, 'id', 'name')); ?>
                    </div>
                    <div class="form-group col-md-2">
                        <?= $form->field($mod, "[$index]position_id")->dropDownList(\yii\helpers\ArrayHelper::map($positions, 'id', 'title')); ?>
                    </div>
                    <div class="form-group col-md-1">
                        <?= $form->field($mod, "[$index]uom")->dropDownList(\app\models\Tickets::getUomOptions(), ['class' => 'uom-labour form-control']); ?>
                    </div>
                    <div class="form-group col-md-1">
                        <?= $form->field($mod, "[$index]regular_rate")->textInput(['readonly' => true, 'class' => 'reg-rate-labour form-control']); ?>
                    </div>
                    <div class="form-group col-md-1">
                        <?= $form->field($mod, "[$index]reg_hours")->textInput(['class' => 'reg-hours-labour form-control']); ?>
                    </div>
                    <div class="form-group col-md-2">
                        <?= $form->field($mod, "[$index]overtime_rate")->textInput(['readonly' => true, 'class' => 'overtime-rate-labour form-control']); ?>
                    </div>
                    <div class="form-group col-md-1">
                        <?= $form->field($mod, "[$index]overtime")->textInput(['class' => 'overtime-labour form-control']); ?>
                    </div>
                    <?= $form->field($mod, "[$index]total")->hiddenInput(['class' => 'sub-total-labour form-control'])->label(false); ?>
                    <div class="form-group col-md-2 text-center" style="margin-top: 30px">
                        <button type="button" id="<?= $mod->id ?>" class="btn btn-danger remove-sub-form-labour">X
                        </button>
                        <button type="button" class="btn btn-primary add-sub-form-labour">+</button>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="container" style="margin-top: -20px">
                <div class="form-group row">
                    <label for="inputExample" class="col-sm-8 col-form-label"><b>Sub-Total</b></label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" disabled id="grand-sub-total" value="0">
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?= \yii\bootstrap4\Html::submitButton('Save', ['id' => 'save-dynamic-form-misc-labour', 'style' => 'display: none']); ?>
    </div>
<?php \yii\bootstrap4\ActiveForm::end(); ?>