<?php

namespace app\controllers;

use Yii;
use app\models\Rank;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Perfil;

/**
 * RankController implements the CRUD actions for Rank model.
 */
class RankController extends Controller
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
     * Lists all Rank models.
     * @return mixed
     */
    public function actionIndex($id= 0)
    {
          if ($id == 0) {
          $rank = Rank::find()->all();
        } else {
            $rank = Rank::find()->where(['=', 'id_user', $id])->all();
        }
       
      

        return $this->render('index', [
            'rank' => $rank,
        ]);
    }
public function actionGetrank() {
        $rankLista = array();
        $rankUser = array();
      
       

        $modelAposta = User::find()->orderby('id')->all();
        $total = 0;
        $id_user = 0;
        foreach ($modelAposta as $item) {
            $perfil = Perfil::find()->where(['=', 'id', $item->id])->one();
            if($perfil != null){
            $rankUser = array("acertos" => Rank::GetAcertos($item->id)
                , "nome" => $perfil->nome, "pontos" => Rank::actionGetTotal($item->id)
                    ,"foto" => $perfil->foto
                , "resultados" => Rank::GetResultados($item->id));
            array_push($rankLista, $rankUser);
            }
        }

        $rankLista = Rank::ordenarRank($rankLista, 'pontos', 'acertos');
       
         return $this->render('getrank', [
            'dataProvider' => $rankLista,
            
        ]);
    }
    /**
     * Displays a single Rank model.
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
     * Creates a new Rank model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Rank();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Rank model.
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
     * Deletes an existing Rank model.
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
     * Finds the Rank model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rank the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rank::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
