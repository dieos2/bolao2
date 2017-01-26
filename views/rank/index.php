
<?php
use app\models\User;
use app\models\Rank;
use app\models\Perfil;
$modelUsers =  User::findByUsername(Yii::$app->user->identity->username);
$perfil = Perfil::find()->where(['=', 'id', $modelUsers->id])->one();
        ?>
<section class="vbox">
                        <header class="header bg-white b-b b-light">
                            <p>Extrato de Pontos <small>(de jogos realizados)</small></p>
                        </header>
                        <section class="scrollable wrapper">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <section class="panel panel-default">
                                                <header class="panel-heading bg-danger lt no-border">
                                                    <div class="clearfix"><a href="#" class="pull-left thumb avatar b-3x m-r">
                                                        <img src='/images/<?php  echo $perfil->foto ?>' class="img-circle">
                                                    </a>
                                                        <div class="clear">
                                                            <div class="h3 m-t-xs m-b-xs text-white"><?php
                                    $perfil->nome?> <i class="fa fa-circle text-white pull-right text-xs m-t-sm"></i></div>
                                                            <small class="text-muted"></small> </div>
                                                    </div>
                                                </header>
                                              <div class="list-group no-radius alt">
<?php foreach($rank as $data){ ?>
   <a class="list-group-item" href="#">
        <span class="badge bg-success"><?php echo $data->idPonto->pontos; ?></span>
        <i class="fa fa-check-square icon-muted"></i>
        <?php echo $data->idAposta->idConfronto->idTimeCasa->nome; ?>
        <?php echo $data->idAposta->idConfronto->placar_casa; ?>
        x 
        <?php echo $data->idAposta->idConfronto->placar_visitante; ?>
        <?php echo $data->idAposta->idConfronto->idTimeVisitante->nome; ?>
        <?php if($data->id_ponto == 1)
            {echo '<i class="fa fa-star icon-muted"></i>';}
            else if($data->id_ponto == 2){'<i class="fa fa-star-half-o"></i>';}?>
      
        <?php echo $data->idAposta->placar_casa; ?>
        x 
        <?php echo $data->idAposta->placar_visitante; ?>
       </a>
<?php } ?>
                                              </div>
                        <div class="list-group no-radius alt"><a class="list-group-item" href="#">
                                <span class="badge bg-success"><?php echo Rank::actionGetTotal($modelUsers->id); ?></span>
        <i class="fa fa-tachometer"></i>
        Total
       </a>

</div>             
                                            </section>
                                         
                                        </div>
                                        <div class="col-sm-6">
                                            <section class="panel panel-default">
                                                <div class="text-center wrapper bg-light lt">
                                                    <div class="sparkline inline" data-type="pie" data-height="165" data-slice-colors="['#77c587','#41586e','#f2f2f2']"><?php echo Rank::GetAcertos($modelUsers->id) ?>,<?php echo Rank::GetResultados($modelUsers->id) ?>,<?php echo Rank::GetErros($modelUsers->id) ?></div>
                                                </div>
                                                <ul class="list-group no-radius">
                                                    <li class="list-group-item"><span class="pull-right"><?php echo Rank::GetAcertos($modelUsers->id) ?></span> <span class="label bg-primary">1</span>Placar Exatos</li>
                                                    <li class="list-group-item"><span class="pull-right"><?php echo Rank::GetResultados($modelUsers->id) ?></span> <span class="label bg-dark">2</span> Acerto de Resultado </li>
                                                    <li class="list-group-item"><span class="pull-right"><?php echo Rank::GetErros($modelUsers->id) ?></span> <span class="label bg-light">3</span> Não Pontuadas </li>
                                                </ul>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <section class="panel panel-default">
                                        <div class="panel-body">
                                            <div class="clearfix text-center m-t">
                                                <div class="inline">
                                                    <div class="easypiechart" data-percent="75" data-line-width="5" data-bar-color="#4cc0c1" data-track-color="#f5f5f5" data-scale-color="false" data-size="130" data-line-cap='butt' data-animate="1000">
                                                        <div class="thumb-lg">
                                                            <img src="/images/<?php echo $perfil->foto ?>" class="img-circle">
                                                        </div>
                                                    </div>
                                                    <div class="h4 m-t m-b-xs"><?php echo $perfil->nome?></div>
                                                    <small class="text-muted m-b">Art director</small> </div>
                                            </div>
                                        </div>
                                        <footer class="panel-footer bg-info text-center">
                                            <div class="row pull-out">
                                                <div class="col-xs-4">
                                                    <div class="padder-v"><span class="m-b-xs h3 block text-white">245</span> <small class="text-muted">Followers</small> </div>
                                                </div>
                                                <div class="col-xs-4 dk">
                                                    <div class="padder-v"><span class="m-b-xs h3 block text-white">55</span> <small class="text-muted">Following</small> </div>
                                                </div>
                                                <div class="col-xs-4">
                                                    <div class="padder-v"><span class="m-b-xs h3 block text-white">2,035</span> <small class="text-muted">Tweets</small> </div>
                                                </div>
                                            </div>
                                        </footer>
                                    </section>
                                </div>
                            </div>
                           
                        </section>
                    </section>
<script>
jQuery(function (){
    jQuery('.summary').hide();
})</script>