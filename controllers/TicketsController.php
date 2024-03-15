<?php

namespace app\controllers;

use app\models\Customers;
use app\models\Jobs;
use app\models\Labour;
use app\models\Locations;
use app\models\Miscellaneous;
use app\models\Positions;
use app\models\Staff;
use app\models\Tickets;
use app\models\TicketsSearch;
use app\models\TicketTrucks;
use app\models\Trucks;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TicketsController implements the CRUD actions for Tickets model.
 */
class TicketsController extends Controller
{
    /**
     * Lists all Tickets models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TicketsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tickets model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tickets model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tickets();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tickets model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $ticket = $this->findModel($id);
        $labour = $this->findModelLabour($id);
        $miscellaneous = $this->findModelMiscellaneous($id);
        $truck = $this->findModelTrucks($id);
        $trucksModel = $truck->truck;
        $customers = Customers::find()->all();
        $jobs = Jobs::find()->all();
        $locations = Locations::find()->all();
        $staff = Staff::find()->all();
        $positions = Positions::find()->all();
        $trucks = Trucks::find()->all();

        if ($ticket->load(\Yii::$app->request->post())
            && $labour->load(\Yii::$app->request->post())
            && $miscellaneous->load(\Yii::$app->request->post())
            && $trucksModel->load(\Yii::$app->request->post())
        ) {
            $isValid = $ticket->validate();
            $isValid = $labour->validate() && $isValid;
            $isValid = $miscellaneous->validate() && $isValid;
            $isValid = $trucksModel->validate() && $isValid;
            if ($isValid) {
                $ticket->save(false);
                $labour->save(false);
                $miscellaneous->save(false);
                $trucksModel->save(false);

                return $this->redirect(['view', 'id' => $ticket->id]);
            }
        }

        return $this->render('update', [
            'ticket' => $ticket,
            'jobs' => $jobs,
            'locations' => $locations,
            'trucks' => $trucks,
            'customers' => $customers,
            'staff' => $staff,
            'positions' => $positions,
        ]);
    }

    /**
     * Deletes an existing Tickets model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tickets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tickets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tickets::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param int $id ID
     * @return Labour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelLabour($id)
    {
        if (($model = Labour::findOne(['ticket_id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param int $id ID
     * @return Miscellaneous the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelMiscellaneous($id)
    {
        if (($model = Miscellaneous::findOne(['ticket_id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param int $id ID
     * @return TicketTrucks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelTrucks($id)
    {
        if (($model = TicketTrucks::findOne(['ticket_id' => $id])) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
