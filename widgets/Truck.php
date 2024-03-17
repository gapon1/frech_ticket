<?php

namespace app\widgets;

use app\models\Tickets;
use app\models\TicketTrucks;
use app\models\Trucks;
use yii\base\Widget;
use yii\web\NotFoundHttpException;

class Truck extends Widget
{
    public $form;
    public $model;
    public $ticket_id;
    public $trucks;

    public function init()
    {

        $ticketTrucks = TicketTrucks::find()->where(['ticket_id' => $this->ticket_id])->all();

        $trucksArray = [];
        foreach ($ticketTrucks as $ticketTruck) {
            $trucksArray[] = $ticketTruck->truck;
        }
        $this->model = $trucksArray;

    }

    public function run()
    {
        return $this->render('truck', [
            'form' => $this->form,
            'model' => $this->model,
            'trucks' => Trucks::find()->all(),
        ]);
    }

}