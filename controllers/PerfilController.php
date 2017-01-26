<?php

namespace app\controllers;

use Yii;
use app\models\TituloDespesa;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
/**
 * TitulodespesaController implements the CRUD actions for TituloDespesa model.
 */
class PerfilController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TituloDespesa models.
     * @return mixed
     */
  

    /**
     * Displays a single TituloDespesa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView()
    {
       
        return $this->render('view');
    }
 public function actionSenha() {
      
            $modelUser =  User::model()->findByPk($_POST['id']);
            $modelUser->password = $_POST['passwordNova'];
            $modelUser->senha = 1;
            $modelUser->update();
            $this->redirect(array('site/index'));
                

    }
     public function actionTrocaSenha() {
            $model =  new User;
            $model = User::model()->findByPk(Yii::app()->user->getId());
            if($model->senha == 0){
            $this->renderPartial('trocasenha');
            }else
            {
                   $this->redirect(array('site/index'));
            }

    }
    /**
     * Creates a new TituloDespesa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
  

    /**
     * Updates an existing TituloDespesa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TituloDespesa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    

    /**
     * Finds the TituloDespesa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TituloDespesa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
