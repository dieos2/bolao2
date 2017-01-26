<?php

namespace app\controllers;

use Yii;
use app\models\Confronto;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Aposta;
use app\models\Rank;
use yii\filters\AccessControl;
/**
 * ConfrontoController implements the CRUD actions for Confronto model.
 */
class ConfrontoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                   
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Confronto models.
     * @return mixed
     */
    public function actionIndex($id = 0)
    {
         if ($id != 0) {
        $dataProvider = Confronto::find()->where(['=', 'id_grupo', $id])->all();
        
         } else {
         $dataProvider =Confronto::find()->all();
         }
         return $this->render('index', [
            'confrontos' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Confronto model.
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
     * Creates a new Confronto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Confronto();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Confronto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())){
            
        
           
            if ($model->empate == 1) {
                $model->vencedor = null;
            }
           
            
            $modelAposta = Aposta::find()->where(['=', 'id_confronto', $model->id])->all();

            foreach ($modelAposta as $item) {
                if ($item->placar_casa == $model->placar_casa && $item->placar_visitante == $model->placar_visitante) {
                    $modelRank = new Rank;
                    $modelRank->id_user = $item->id_user;
                    $modelRank->data = date('Y-m-d H:i:s');
                    $modelRank->id_aposta = $item->id;
                    $modelRank->id_ponto = 1;
		    $modelRank->save();
                } else if ($model->vencedor != null) {
                    if ($item->placar_casa > $item->placar_visitante && $model->vencedor == $model->id_time_casa) {
                        $modelRank = new Rank;
                        $modelRank->id_user = $item->id_user;
                        $modelRank->data = date('Y-m-d H:i:s');
                        $modelRank->id_aposta = $item->id;
                        $modelRank->id_ponto = 2;
			
                        $modelRank->save();
                    } else if ($item->placar_casa < $item->placar_visitante && $model->vencedor == $model->id_time_visitante) {
                        $modelRank = new Rank;
                        $modelRank->id_user = $item->id_user;
                        $modelRank->data = date('Y-m-d H:i:s');
                        $modelRank->id_aposta = $item->id;
                        $modelRank->id_ponto = 2;
			
                        $modelRank->save();
                    }
                } else if ($item->placar_casa == $item->placar_visitante && $model->placar_casa == $model->placar_visitante) {
                    $modelRank = new Rank;
                    $modelRank->id_user = $item->id_user;
                    $modelRank->data = date('Y-m-d H:i:s');
                    $modelRank->id_aposta = $item->id;
                    $modelRank->id_ponto = 2;
			
                    $modelRank->save();
                }
            }
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }
    }

    /**
     * Deletes an existing Confronto model.
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
     * Finds the Confronto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Confronto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Confronto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
