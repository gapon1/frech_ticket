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
        $this->model = $this->findModel($this->ticket_id);
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
     * @return \app\models\Trucks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = \app\models\Trucks::findOne(['ticket_id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}