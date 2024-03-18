<?php

namespace app\controllers;

use app\models\TicketTrucks;
use app\models\Trucks;
use yii\bootstrap4\ActiveForm;
use yii\web\Controller;
use yii\web\Response;
use Yii;

class TruckController extends Controller
{
    public function actionTruckAddBlock($index, $counter, $ticketId)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $truck = Trucks::find()->all();
        return $this->renderAjax('_subFormTruck', [
            'model' => new Trucks(),
            'index' => $index,
            'counter' => $counter,
            'ticketId' => $ticketId,
            'trucks' => $truck,
        ]);
    }

    public function actionCreateTruck($ticketId)
    {
        $model = new Trucks();
        $truck = Trucks::find()->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // Set TicketTruck
                $modelTicket = new TicketTrucks();
                $modelTicket->ticket_id = $ticketId;
                $modelTicket->truck_id = $model->attributes['label'];
                // Correct set truck name
                $arrayMap = \yii\helpers\ArrayHelper::map($truck, 'id', 'label');
                $model->label = $arrayMap[$model->attributes['label']];

                $model->save();
                $modelTicket->save();

                $ticketTrucks = TicketTrucks::find()->where(['ticket_id' => $ticketId])->all();
                $trucksArray = [];
                foreach ($ticketTrucks as $ticketTruck) {
                    $trucksArray[] = $ticketTruck->truck;
                }
                return $this->renderAjax('../../widgets/views/truck', [
                    'model' => $trucksArray,
                    'ticketId' => $ticketId,
                ]);
            }
        } else {
            $model->loadDefaultValues();
        }
        return 'Truck Create success';
    }

    public function actionUpdateTruck($ticketId)
    {
        // Load the related Miscellaneous models
        $truckModels = Trucks::find()->all();

        if (Yii::$app->request->isPost) {
            $truckPostData = Yii::$app->request->post('Trucks', []);

            foreach ($truckModels as $index => $miscModel) {
                // Load the submitted data and validate it
                if (isset($truckPostData[$index])) {
                    $miscModel->load($truckPostData[$index], '');
                }
            }

            $valid = ActiveForm::validateMultiple($truckModels);
            if (empty($valid)) {
                // All models are valid, so save them
                foreach ($truckModels as $truckModel) {
                    $truckModel->save(false); // Saving without further validation
                }
                // Redirect or do something after saving
            } else {
                // Validation failed
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $valid;
            }
        }
        return 'Truck Updated Success!';
    }

    public function actionDeleteTruck($id)
    {
        $modelTicket = TicketTrucks::findOne(['truck_id' => $id]);
        $model = Trucks::findOne(['id' => $id]);
        $modelTicket->delete();
        $model->delete();
        return '<div class="form-group col-md-12 text-right" style="margin-top: 30px">
            <button type="button" class="btn btn-primary add-sub-form-truck">+</button>
        </div>';
    }

}