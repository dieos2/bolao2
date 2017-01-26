<?php

namespace app\controllers;

use Yii;
use app\models\Time;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Uploadform;
use yii\web\UploadedFile;

/**
 * TimeController implements the CRUD actions for Time model.
 */
class TimeController extends Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Time models.
     * @return mixed
     */
    public function actionIndex() {
        $dataProvider = new ActiveDataProvider([
            'query' => Time::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Time model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Time model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Time();
        $modelUP = new UploadForm();

        if ($model->load(Yii::$app->request->post())) {
            $modelUP->imageFile = UploadedFile::getInstance($model, 'escudo');
            if ($model->upload()) {
                // file is uploaded successfully
                return;
            }
            if ($model->save()) {
                
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Time model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $modelUP = new UploadForm();
        if ($model->load(Yii::$app->request->post())) {

            $modelUP->imageFile = UploadedFile::getInstance($model, 'escudo');
             $nome = md5(uniqid(""));
                $modelUP->upload($model->id, $nome);
                $model->escudo = $nome.'.'.$modelUP->imageFile->extension;
            
            
             $modelUP->imageFile = UploadedFile::getInstance($model, 'icon_mascote');
              $nome = md5(uniqid(""));
            $modelUP->upload($model->id, $nome);
                $model->icon_mascote = $nome.'.'.$modelUP->imageFile->extension;
           
            
              $modelUP->imageFile = UploadedFile::getInstance($model, 'mascote');
              $nome = md5(uniqid(""));
          $modelUP->upload($model->id, $nome);
                $model->mascote = $nome.'.'.$modelUP->imageFile->extension;
            
              $modelUP->imageFile = UploadedFile::getInstance($model, 'icon_mascote_i');
                $nome = md5(uniqid(""));
           $modelUP->upload($model->id, $nome);
                $model->icon_mascote_i = $nome.'.'.$modelUP->imageFile->extension;
           
            
            if ($model->save()) {
                
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Time model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Time model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Time the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Time::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
