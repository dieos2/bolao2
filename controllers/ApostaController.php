<?php

namespace app\controllers;

use Yii;
use app\Models\Aposta;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
/**
 * ApostaController implements the CRUD actions for Aposta model.
 */
class ApostaController extends Controller
{
    public function behaviors()
    {
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
     * Lists all Aposta models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Aposta::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Aposta model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Aposta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   
    public function actionCreate($id_confronto,$placar_visitante, $placar_casa,$data) {
        $model = new Aposta;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
         
            $model->id_confronto = $id_confronto;
             $model->placar_visitante = $placar_visitante;
              $model->placar_casa = $placar_casa;
               $model->data = $data;
                 $model->id_user = User::findByUsername(Yii::$app->user->identity->username)->id;
           
           $apostaExiste = Aposta::find()->where(['=', 'id_confronto', $model->id_confronto])->andWhere(['=', 'id_user', $model->id_user])->one();
           if($apostaExiste != null){
            $model = $this->loadModel($apostaExiste->id);
             $model->id_confronto = $id_confronto;
             $model->placar_visitante = $placar_visitante;
              $model->placar_casa = $placar_casa;
               $model->data = $data;
                $model->id_user = $model->id_user;
           } $model->save();
            echo json_encode($model);

         
     
      
    }  public function actionGetapostas($id) {
        $this->layout = false;
        header('Content-type: application/json');
        $arr = array();
      

        $arrAposta = array();
            $id_user = $id;
            if($id_user != 0){
           
             $aposta = Aposta::find()->where(['=', 'id_user', $id_user])->all();
            }  else {
             $aposta = Aposta::find()->all();
            }
           

        foreach ($aposta as $item) {
            $dataHoje = strtotime(date("m/d/Y"));
            $dataExp = $item->data;
            array_push($arr, $item->id, $item->id_confronto, $item->id_user, $item->data, $item->placar_casa, $item->placar_visitante, ucfirst($item->idUser->username));
            array_push($arrAposta, $arr);
            $arr = array();
        }

        echo json_encode($arrAposta);

      
    }
    /**
     * Updates an existing Aposta model.
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
     * Deletes an existing Aposta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Aposta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Aposta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Aposta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
   
}
