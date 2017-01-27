<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\SignupForm;
use app\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
use app\models\Perfil;
/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [

            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                   
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [ 'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'oAuthSuccess'],
                'successUrl' => Yii::$app->homeUrl,
            ],
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex() {

        return $this->renderPartial('index');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $model = new LoginForm();
         if ($model->load(Yii::$app->request->get()) && $model->login()) {
          return ['access_token' => Yii::$app->user->identity->getAuthKey()];
         }
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->renderPartial('login', [
                        'model' => $model,
                      
            ]);
        }
    }

     public function Autoriza() {
       
        
        $model = new LoginForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return User::getAuthKey();
        }
    }
    
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                  $modelPerfil = new Perfil();
            $modelPerfil->id = $user->id;
            $modelPerfil->data = date('Y-m-d');
            $modelPerfil->nome = $user->username;
            $modelPerfil->save();
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->renderPartial('signup', [
                    'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    /**
     * This function will be triggered when user is successfuly authenticated using some oAuth client.
     *
     * @param yii\authclient\ClientInterface $client
     * @return boolean|yii\web\Response
     */
    public function oAuthSuccess($client) {
        // get user data from client  
        $userAttributes = $client->getUserAttributes();

        //cuida de logar
        
          $user = User::find()->where(['=','email',$userAttributes['email']])->one();
    if($user != null){
        Yii::$app->user->login($user);  
        if($user->id_facebook != 0){
        copy('http://graph.facebook.com/'.$user->id_facebook.'/picture?type=large', 'images/'.$user->username.'.jpeg');
        }else{
            $user->id_facebook = $userAttributes['id'];
            copy('http://graph.facebook.com/'.$user->id_facebook.'/picture?type=large', 'images/'.$user->username.'.jpeg');
            $user->save();
        }
        return $this->goHome();
    }
    else{
           
            $modelCadastro = new SignupForm();
            $modelCadastro->email = $userAttributes['email'];
            $modelCadastro->username = $userAttributes['id'];
            $modelCadastro->password = $userAttributes['id'];
            $modelCadastro->id_facebook = $userAttributes['id'];
            $nome = explode(" ",$userAttributes['name']); 
        if ($user = $modelCadastro->signup()) {
            $modelPerfil = new Perfil();
            $modelPerfil->id = $user->id;
            $modelPerfil->data = date('Y-m-d');
            $modelPerfil->nome = $nome[0];
            $modelPerfil->sobrenome = $nome[1];
            copy('http://graph.facebook.com/'.$modelCadastro->id_facebook.'/picture?type=large', 'images/'.$modelCadastro->username.'.jpeg');
            $modelPerfil->foto = $modelCadastro->username.'.jpeg';
	//$modelPerfil->id_facebook = $modelCadastro->id_facebook;
            $modelPerfil->save();
            
            if (Yii::$app->getUser()->login($user)) {
                return $this->goHome();
            }
        }
        }


        //Cuida do cadastro do usuario na base
        
        // do some thing with user data. for example with $userAttributes['email']
    }

}
