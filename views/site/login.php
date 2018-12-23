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
    <body>
        <section id="content" class="m-t-lg wrapper-md animated fadeInUp">
            <div class="container aside-xxl"><a class="navbar-brand block" href="index.html">Bolão Parazão</a>
                <section class="panel panel-default bg-white m-t-lg">
                    <header class="panel-heading text-center"><strong>Entrar</strong> </header>
<?php $this->beginBody() ?>
                    <?= Html::csrfMetaTags() ?>

                    <?php $form = ActiveForm::begin(['id' => 'login-form', 'options' => [
                                    'class' => 'panel-body wrapper-lg']]);
                    ?>

                    <div class="form-group">
                        <label class="control-label">Usuario</label>
                        <?= $form->field($model, 'username')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Usuario'])->label(false) ?>

                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <?= $form->field($model, 'password')->passwordInput()->passwordInput(['class' => 'form-control input-lg', 'placeholder' => 'Senha'])->label(false) ?>

                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">
                            Manter-me logado </label>
                    </div>

                    <button type="submit" class="btn btn-primary">Entrar</button>
                    <div class="line line-dashed"></div>

                    <a href="https://bolaoparazao.casadogui.com.br/site/auth?authclient=facebook" class="btn btn-block btn-social btn-facebook">
                        <span class="fa fa-facebook"></span>
                        Logar com Facebook
                    </a>
                     <div class="line line-dashed"></div>
          <p class="text-muted text-center"><small>Você ainda não tem uma conta?</small></p>
          <a href="/site/signup" class="btn btn-default btn-block">Cadastrar-se</a>


                    <?php ActiveForm::end(); ?>





<?php

/**
 *
 * Copyright MITRE 2012
 *
 * OpenIDConnectClient for PHP5
 * Author: Michael Jett <mjett@mitre.org>
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may
 * not use this file except in compliance with the License. You may obtain
 * a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 *
 */







?>


        Nome? <?php echo $name; ?>
		<br\>
		id? <?php echo $id; ?>


                </section>
            </div>
        </section>
        <!-- footer -->
        <footer id="footer">
            <div class="text-center padder">
                <p><small>Web app framework base on Bootstrap<br>
                        &copy; 2013</small> </p>
            </div>
        </footer>
        <!-- / footer -->
        <script src="/js/app.v2.js"></script>
        <!-- Bootstrap -->
        <!-- App -->
    </body>
</html>

<?php $this->endBody() ?>


</body>
</html>
<?php $this->endPage() ?>































