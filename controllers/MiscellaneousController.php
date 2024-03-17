<?php

namespace app\controllers;

use app\models\Miscellaneous;
use yii\bootstrap4\ActiveForm;
use yii\web\Controller;
use yii\web\Response;
use Yii;

class MiscellaneousController extends Controller
{

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

    public function actionCreateMiscellaneous($ticketId)
    {
        $model = new Miscellaneous();
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
        return 'Create success';
    }

    public function actionUpdateMiscellaneous($ticketId)
    {
        // Load the related Miscellaneous models
        $miscellaneousModels = Miscellaneous::findAll(['ticket_id' => $ticketId]);

        if (Yii::$app->request->isPost) {
            $miscellaneousPostData = Yii::$app->request->post('Miscellaneous', []);
            foreach ($miscellaneousModels as $index => $miscModel) {
                // Load the submitted data and validate it
                if (isset($miscellaneousPostData[$index])) {
                    $miscModel->load($miscellaneousPostData[$index], '');
                }
            }
            $valid = ActiveForm::validateMultiple($miscellaneousModels);
            if (empty($valid)) {
                // All models are valid, so save them
                foreach ($miscellaneousModels as $miscModel) {
                    $miscModel->save(false); // Saving without further validation
                }
                // Redirect or do something after saving
            } else {
                // Validation failed
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $valid;
            }
        }
        return 'Miscellaneous Updated Success!';
    }

    public function actionDeleteMiscellaneous($id)
    {
        $model = Miscellaneous::findOne(['id' => $id]);
        $model->delete();
        var_dump('Delete success');
        die();
    }

}