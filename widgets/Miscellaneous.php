<?php

namespace app\widgets;

use yii\base\Widget;
use yii\web\NotFoundHttpException;

class Miscellaneous extends Widget
{
    public $model;
    public $ticket_id;

    public function init()
    {
        $this->model = $this->findModel($this->ticket_id);
    }

    public function run()
    {
        return $this->render('miscellaneous', [
            'model' => $this->model,
            'ticketId' => $this->ticket_id,
        ]);
    }

    /**
     * @param int $id ID
     * @return \app\models\Miscellaneous the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = \app\models\Miscellaneous::findAll(['ticket_id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}