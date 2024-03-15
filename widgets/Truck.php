<?php

namespace app\widgets;

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
        $truck = $this->findModel($this->ticket_id);
        $this->model = $truck->truck;

    }

    public function run()
    {
        return $this->render('truck', [
            'form' => $this->form,
            'model' => $this->model,
            'trucks' => $this->trucks,
        ]);
    }

    /**
     * @param int $id ID
     * @return \app\models\TicketTrucks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = \app\models\TicketTrucks::findOne(['ticket_id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}