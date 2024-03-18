<?php

namespace app\controllers;

use app\models\Labour;
use app\models\Positions;
use app\models\Staff;
use yii\bootstrap4\ActiveForm;
use yii\web\Controller;
use yii\web\Response;
use Yii;

class LabourController extends Controller
{

    public function actionLabourAddBlock($index, $counter, $ticketId)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $staff = Staff::find()->all();
        $positions = Positions::find()->all();
        return $this->renderAjax('_subFormLabour', [
            'model' => new Labour(),
            'index' => $index,
            'counter' => $counter,
            'ticketId' => $ticketId,
            'staff' => $staff,
            'positions' => $positions,
        ]);
    }

    public function actionCreateLabour($ticketId)
    {
        $model = new Labour();

        $staff = Staff::find()->all();
        $positions = Positions::find()->all();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->regular_rate = 22;
                $model->overtime_rate = 33;

                $model->save();
                $labour = Labour::find()->all();
                return $this->renderAjax('../../widgets/views/labour', [
                    'model' => $labour,
                    'ticketId' => $ticketId,
                    'staff' => $staff,
                    'positions' => $positions,
                ]);
            }
        } else {
            $model->loadDefaultValues();
        }
        return 'Labour Create success';
    }

    public function actionUpdateLabour($ticketId)
    {
        // Load the related Miscellaneous models
        $labourModels = Labour::findAll(['ticket_id' => $ticketId]);

        if (Yii::$app->request->isPost) {
            $miscellaneousPostData = Yii::$app->request->post('Labour', []);
            foreach ($labourModels as $index => $miscModel) {
                // Load the submitted data and validate it
                if (isset($miscellaneousPostData[$index])) {
                    $miscModel->load($miscellaneousPostData[$index], '');
                }
            }
            $valid = ActiveForm::validateMultiple($labourModels);
            if (empty($valid)) {
                // All models are valid, so save them
                foreach ($labourModels as $miscModel) {
                    $miscModel->save(false); // Saving without further validation
                }
                // Redirect or do something after saving
            } else {
                // Validation failed
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $valid;
            }
        }
        return 'Labour Updated Success!';
    }

    public function actionDeleteLabour($id)
    {
        $model = Labour::findOne(['id' => $id]);
        $model->delete();
        return '<div class="form-group col-md-12 text-right" style="margin-top: 30px">
            <button type="button" class="btn btn-primary add-sub-form-labour">+</button>
        </div>';
    }

}