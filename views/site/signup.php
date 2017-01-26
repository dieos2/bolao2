<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\HeadAsset;
use app\assets\BottomAsset;
use app\widgets\Alert;
use app\models\Setup;
use yii\widgets\ActiveForm;

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $model app\models\Sala */

HeadAsset::register($this);
?>
<?php BottomAsset::register($this); ?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en" class="bg-dark">
 <head>
        <meta charset="utf-8" />
        <title>Bolão | Parazão</title>
        <meta name="description" content="app, web app, responsive, admin dashboard, admin, flat, flat ui, ui kit, off screen nav" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="stylesheet" href="/css/app.v2.css" type="text/css" />
        <link rel="stylesheet" href="/css/font.css" type="text/css" cache="false" />
        <link href="/css/bootstrap-social.css" rel="stylesheet" type="text/css"/>
     <!--[if lt IE 9]> <script src="js/ie/html5shiv.js" cache="false"></script> <script src="js/ie/respond.min.js" cache="false"></script> <script src="js/ie/excanvas.js" cache="false"></script> <![endif]-->
    </head>
<?php $this->beginBody() ?>
                    <?= Html::csrfMetaTags() ?>
  <section id="content" class="m-t-lg wrapper-md animated fadeInDown">
    <div class="container aside-xxl">
      <a class="navbar-brand block" href="index.html">Bolão Parazão</a>
      <section class="panel panel-default m-t-lg bg-white">
        <header class="panel-heading text-center">
          <strong>Cadastrar</strong>
        </header>
           <?php $form = ActiveForm::begin(['id' => 'form-signup', 'action' => '/site/signup','options' => [
                                    'class' => 'panel-body wrapper-lg']]); ?>
      
         
              
          <div class="form-group">
            <label class="control-label">Name</label>
             
               <?= $form->field($model, 'username')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'ex: meuNomeDeUsuario'])->label(false) ?>
         
          </div>
          <div class="form-group">
            <label class="control-label">Email</label>
            <?= $form->field($model, 'email')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'ex: meuNomeDeUsuario'])->label(false) ?>
          </div>
          <div class="form-group">
            <label class="control-label">Senha</label>
              <?= $form->field($model, 'password')->passwordInput()->passwordInput(['class' => 'form-control input-lg', 'placeholder' => 'ex: senhaSecreta'])->label(false) ?>
            
          </div>
          <div class="checkbox">
            <label>
              <input type="checkbox"> Eu aceito os <a href="#">termos e politica</a>
            </label>
          </div>
          <button type="submit" class="btn btn-primary">Cadastrar</button>
            <div class="line line-dashed"></div>
            <a href="http://bolaoparazao.casadogui.com.br/site/auth?authclient=facebook" class="btn btn-block btn-social btn-facebook">
                        <span class="fa fa-facebook"></span>
                        Entrar com Facebook
                    </a>
          <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Você já tem uma conta?</small></p>
          <a href="/site/login" class="btn btn-default btn-block">Logar</a>
          <?php ActiveForm::end(); ?>
      </section>
    </div>
  </section>
  <!-- footer -->
  <footer id="footer">
    <div class="text-center padder clearfix">
      <p>
        <small>Web app framework base on Bootstrap<br>&copy; 2013</small>
      </p>
    </div>
  </footer>
  <!-- / footer -->
  <script src="/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="/js/bootstrap.js"></script>
  <!-- App -->
  <script src="/js/app.js"></script>
  <script src="/js/app.plugin.js"></script>
  <script src="/js/slimscroll/jquery.slimscroll.min.js"></script>
  
<?php $this->endBody() ?>


</body>
</html>
<?php $this->endPage() ?>
