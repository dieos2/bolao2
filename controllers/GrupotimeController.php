<?php

namespace app\controllers;

use Yii;
use app\models\GrupoTime;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Grupo;
use app\models\Setup;

/**
 * GrupoTimeController implements the CRUD actions for GrupoTime model.
 */
class GrupotimeController extends Controller
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
     * Lists all GrupoTime models.
     * @return mixed
     */
    public function actionIndex($id=0)
    {  
        $model = new GrupoTime;
        $classificacao = array();
        if ($id != 0) {
           $grupo = Grupo::find($id)->one();
            
            $model = GrupoTime::find()->where(['=', 'id_grupo', $id])->all();
            foreach ($model as $item) {
                $itemArray = array("id" => $item->id
                        ,"id_grupo" => $item->id_grupo
                        ,"id_time" => $item->getIdTime()->one()->nome
                        ,"escudo" => $item->getIdTime()->one()->escudo
                        ,"pontos" => GrupoTime::GetPontosDoTime($item->id_time)
                        , "vitoria" => GrupoTime::GetNVitoriaDoTime($item->id_time)
                        , "empate" => GrupoTime::GetNEmpateDoTime($item->id_time)
                        , "derrota" => GrupoTime::GetNDerrotaDoTime($item->id_time));
                array_push($classificacao, $itemArray);
            }

             return $this->render('index', [
            'model' => Setup::aasort($classificacao,'pontos'),
                'grupo' => $grupo
        ]);
        } 
    }

    /**
     * Displays a single GrupoTime model.
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
     * Creates a new GrupoTime model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GrupoTime();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GrupoTime model.
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
     * Deletes an existing GrupoTime model.
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
     * Finds the GrupoTime model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GrupoTime the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GrupoTime::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
