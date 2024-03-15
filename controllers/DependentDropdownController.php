<?php

namespace app\controllers;

use app\models\Trucks;
use Yii;
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
}
