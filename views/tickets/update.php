<?php

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $ticket app\models\Tickets */
/* @var $jobs app\models\Jobs[] */
/* @var $locations app\models\Locations[] */
/* @var $trucks app\models\Trucks[] */
/* @var $customers app\models\Customers[] */
/* @var $form yii\widgets\ActiveForm */
/* @var $script */

$this->title = 'Edit Ticket';
$this->params['breadcrumbs'][] = ['label' => 'Tickets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $ticket->id, 'url' => ['view', 'id' => $ticket->id]];
$this->params['breadcrumbs'][] = 'Edit';

$form = ActiveForm::begin(['id' => 'ticket-form']); ?>

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

                //Status
                echo $form->field($ticket, 'status')->dropDownList(\app\models\Tickets::getStatusOptions());

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
                    'value' => date('Y-m-d'), // Set the default date to today
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

    <!-- LabourWidget section -->
<?= \app\widgets\Labour::widget([
    'ticket_id' => $ticket->id,
    'form' => $form,
]) ?>

    <!-- TruckWidget section -->
<?= \app\widgets\Truck::widget([
    'ticket_id' => $ticket->id,
    'form' => $form,
]) ?>
    <hr class="hr"/>
    <h6>Miscellaneous</h6>
    <!-- MiscellaneousWidget section -->
<?= \app\widgets\Miscellaneous::widget([
    'ticket_id' => $ticket->id,
    'form' => $form,
]) ?>

    <hr class="hr"/>
    <div class="col-md-12 text-right">
        <?= Html::submitButton('FINISH', ['class' => 'btn btn-secondary text-right', 'id'=>'save-dynamic-form']); ?>
    </div>

<?php
ActiveForm::end();
?>