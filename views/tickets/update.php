<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $ticket app\models\Tickets */
/* @var $jobs app\models\Jobs[] */
/* @var $locations app\models\Locations[] */
/* @var $trucks app\models\Trucks[] */
/* @var $positions app\models\Positions[] */
/* @var $customers app\models\Customers[] */
/* @var $staff app\models\Staff[] */
/* @var $form yii\widgets\ActiveForm */
/* @var $script */

$this->title = 'Edit Ticket';
$this->params['breadcrumbs'][] = ['label' => 'Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $ticket->id, 'url' => ['view', 'id' => $ticket->id]];
$this->params['breadcrumbs'][] = 'Edit';

$form = ActiveForm::begin(); ?>
    <h6>Project</h6>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <?php
                // Customer Dropdown
                echo $form->field($ticket, 'customer_id')->dropDownList(ArrayHelper::map($customers, 'id', 'name'), [
                    'prompt' => 'Select Customer',
                    'id' => 'customer-dropdown',
                ]);

                // Job Dropdown
                echo $form->field($ticket, 'job_id')->dropDownList(
                    [$ticket->location_id => ArrayHelper::map($jobs, 'id', 'name')],
                    [
                        'disabled' => 'disabled',
                        'prompt' => 'Select Job',
                        'id' => 'job-dropdown'
                    ]);

                // Location/LSD Dropdown
                echo $form->field($ticket, 'location_id')->dropDownList(
                    [$ticket->location_id => ArrayHelper::map($locations, 'id', 'location_lsd')],
                    [
                        'prompt' => 'Select Job',
                        'disabled' => 'disabled',
                        'id' => 'location-dropdown'
                    ]);
                ?>
            </div>
            <div class="col-md-6 col-sm-12">
                <?= $form->field($ticket, 'ordered_by'); ?>
                <label>Date</label>
                <?= \yii\jui\DatePicker::widget([
                    'model' => $ticket,
                    'attribute' => 'date',
                    'language' => 'en',
                    'dateFormat' => 'yyyy-MM-dd',
                    'clientOptions' => [
                        'defaultDate' => date('Y-m-d'), // Set the default date to today
                    ],
                    'options' => ['class' => 'form-control date_picker', 'style' => 'margin-bottom: 15px'], // Adding custom class
                ]); ?>
                <?= $form->field($ticket, 'area_field'); ?>
            </div>
        </div>
    </div>
    <hr class="hr"/>
    <h6>Description of Work</h6>
<?php
// Description of work
echo $form->field($ticket, 'description')->widget(alexantr\tinymce\TinyMCE::className())
?>
    <hr class="hr"/>

    <!-- LabourWidget section -->
    <h6>Labour</h6>
<?= \app\widgets\Labour::widget([
    'ticket_id' => $ticket->id,
    'form' => $form,
    'staff' => $staff,
    'positions' => $positions
]) ?>
    <hr class="hr"/>
    <!-- TruckWidget section -->
    <h6>Truck</h6>
<?= \app\widgets\Truck::widget([
    'ticket_id' => $ticket->id,
    'form' => $form,
    'trucks' => $trucks,
]) ?>
    <hr class="hr"/>
    <!-- MiscellaneousWidget section -->
    <h6>Miscellaneous</h6>
<?= \app\widgets\Miscellaneous::widget([
    'ticket_id' => $ticket->id,
    'form' => $form,
]) ?>

    <hr class="hr"/>
    <div class="col-md-12 text-right">
        <?= Html::submitButton('FINISH', ['class' => 'btn btn-secondary text-right']); ?>
    </div>


<?php
ActiveForm::end();
?>