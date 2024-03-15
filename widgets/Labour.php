<?php

namespace app\widgets;

use yii\base\Widget;
use yii\web\NotFoundHttpException;

class Labour extends Widget
{
    public $form;
    public $staff;
    public $positions;
    public $model;
    public $ticket_id;

    public function init()
    {
        $this->model = $this->findModel($this->ticket_id);
    }

    public function run()
    {
        return $this->render('labour', [
            'form' => $this->form,
            'staff' => $this->staff,
            'positions' => $this->positions,
            'model' => $this->model,
        ]);
    }

    /**
     * @param int $id ID
     * @return \app\models\Labour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = \app\models\Labour::findOne(['ticket_id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}