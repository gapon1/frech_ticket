<?php

namespace app\controllers;

use app\models\Miscellaneous;
use app\models\Positions;
use app\models\Trucks;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\web\Controller;
use yii\web\Response;
use app\models\Jobs;
use app\models\Locations;
use yii\helpers\ArrayHelper;

class DependentDropdownController extends Controller
{
    public function actionJobDropdown($customer_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $jobs = Jobs::find()
            ->where(['customer_id' => $customer_id])
            ->orderBy('name')
            ->all();


        if (!empty($jobs)) {
            return ArrayHelper::map($jobs, 'id', 'name');
        }

        return [];
    }

    public function actionLocationDropdown($job_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $locations = Locations::find()
            ->where(['job_id' => $job_id])
            ->orderBy('location_lsd')
            ->all();

        if (!empty($locations)) {
            return ArrayHelper::map($locations, 'id', 'location_lsd');
        }

        return [];
    }

    public function actionTruckDropdown($truckLabel)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return Trucks::find()
            ->where(['id' => $truckLabel])
            ->one();

    }

    public function actionPositionDropdown($positionId)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return Positions::find()
            ->where(['id' => $positionId])
            ->one();

    }

    public function actionMiscellaneousAddBlock($index, $counter, $ticketId)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return $this->renderAjax('_subFormMiscellaneous', [
            'model' => new Miscellaneous(),
            'index' => $index,
            'counter' => $counter,
            'ticketId' => $ticketId,
        ]);
    }

    public function actionCreateMiscellaneous()
    {
        $model = new Miscellaneous();
        $ticketId = Yii::$app->request->get('id');

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                return $this->renderAjax('../../widgets/views/miscellaneous', [
                    'model' => Miscellaneous::find()->all(),
                    'ticketId' => $ticketId
                ]);
            }
        } else {
            $model->loadDefaultValues();
        }

    }

    public function actionDeleteMiscellaneous($id)
    {
        $model = Miscellaneous::findOne(['id' => $id]);
        $model->delete();
        var_dump('Delete success');
        die();
    }

}
