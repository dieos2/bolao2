<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\AccessRule;
use app\models\UserCadastro;
use yii\filters\AccessControl;
use yii\rest\ActiveController;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
   
// public function behaviors()
//{
//    $behaviors = parent::behaviors();
//    $behaviors['authenticator'] = [
//        'class' => CompositeAuth::className(),
//        'authMethods' => [
//            HttpBasicAuth::className(),
//            HttpBearerAuth::className(),
//            QueryParamAuth::className(),
//        ],
//    ];
//    return $behaviors;
//}
    
   public function behaviors() {
		return[ 
            
            'access' => [
    'class' => AccessControl::className(),
    // We will override the default rule config with the new AccessRule class
    'ruleConfig' => [
        'class' => AccessRule::className(),
    ],
   
    'rules' => [
        [
            
            'allow' => true,
            // Allow users, moderators and admins to create
            'roles' => [
                UserCadastro::ROLE_ADMIN
            ],
        ],
       
    ],
], ];
            
            
//            [ 'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['index', 'view'],
//                'rules' => [
//                    [
//                        'actions' => ['index','view'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                   
//                ],
//            ],
//				'verbs' => [ 
//						'class' => VerbFilter::className (),
//						'actions' => [ 
//								'delete' => [ 
//										'post' 
//								] 
//						] 
//				] 
//		];
	}

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
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
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
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
