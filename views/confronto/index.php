<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use app\models\Confronto;
use app\models\Aposta;
use app\models\UserCadastro;
use app\models\Rank;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Confrontos';
$this->params['breadcrumbs'][] = $this->title;
$modelUsers = User::findByUsername(Yii::$app->user->identity->username)
?>
<section class="vbox">
    <section class="scrollable padder">
        <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
            <li><a href="/confronto/index/0">Todos</a></li>
            <?php foreach (\app\models\Grupo::find()->all() as $grupo) { ?>
                <li><a href="/confronto/index/<?php echo $grupo->id ?>"><?php echo $grupo->nome ?></a></li>

            <?php } ?>
        </ul>


        <section class="panel panel-default">
            <div class="row m-l-none m-r-none bg-light lter">
                <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                        <i class="fa fa-circle fa-stack-2x text-info"></i>
                        <i class="fa fa-flag-checkered fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="#">
                        <span class="h3 block m-t-xs"><strong><?php echo Rank::actionGetTotal($modelUsers->id) ?></strong></span>
                        <small class="text-muted text-uc">Pontos</small>
                    </a>
                </div>
                <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                        <i class="fa fa-circle fa-stack-2x text-warning"></i>
                        <i class="fa fa-trophy fa-stack-1x text-white"></i>

                    </span>
                    <a class="clear" href="#">
                        <span class="h3 block m-t-xs"><strong id="bugs"><?php echo Rank::GetPosicao($modelUsers->id) ?>ª</strong></span>
                        <small class="text-muted text-uc">Posição</small>
                    </a>
                </div>
                <div class="col-sm-6 col-md-3 padder-v b-r b-light">                     
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                        <i class="fa fa-circle fa-stack-2x text-danger"></i>
                        <i class="fa fa-fire-extinguisher fa-stack-1x text-white"></i>
                        <span class="easypiechart pos-abt" data-percent="100" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update="5000"></span>
                    </span>
                    <a class="clear" href="#">
                        <span class="h3 block m-t-xs"><strong id="firers">359</strong></span>
                        <small class="text-muted text-uc">Extinguishers ready</small>
                    </a>
                </div>
                <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                        <i class="fa fa-circle fa-stack-2x icon-muted"></i>
                        <i class="fa fa-clock-o fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="#">
                        <span class="h3 block m-t-xs"><strong>31:50</strong></span>
                        <small class="text-muted text-uc">Left to exit</small>
                    </a>
                </div>
            </div>
        </section>
        <div class="row">
            <div class="col-md-8">                         
                <div class="m-b-md"> <h3 class="m-b-none">Confrontos</h3> </div>
                <?php
                foreach ($confrontos as $data) { /* @var $this ConfrontoController */
                    /* @var $data Confronto */
                    date_default_timezone_set('America/Belem');
                    $date = date_create($data->data);
                    $modelUsers = User::findByUsername(Yii::$app->user->identity->username)
                    ?>

                    <div id="fb-root"></div>
            
                    <section class="panel panel-default">
                        <header class="panel-heading font-bold"><?php echo date_format($date, 'd-m-Y H:i'); ?> - <a id="verAposta-<?php echo $data->id ?>" data-id="<?php echo $data->id ?>" class="btn verAposta btn-info">Ver Apostas</a> </header>
                        <div class="panel-body" style="padding-left: 18%; padding-bottom: 10px;">
                            <form id="<?php echo $data->id ?>" class="form-inline" role="form" data-validate="parsley">
                                <div class="divContainerMarcote">
                                    <div class='divMascoteIcon' style="background-image: url('');    background-repeat: no-repeat;">
                                        <img style="width: 100%" src="/images/<?= $data->idTimeCasa->id?>/<?= $data->idTimeCasa->icon_mascote?>" />
                                    </div> 
                                     <div class="divEscudo casa">
                                        
                                  
                                     </div>
                                </div>

                                <div class="form-group" style="width: 26px; float: left;margin-top: 15px">
                                    <div class="input-group spinner">
                                        <div class="input-group-btn-vertical">
                                            <button class="btn btn-default btnSoma"  type="button"><i class="fa fa-caret-up"></i></button>
                                            <input disabled class="c<?php echo $data->id ?> placar" type="text" data-notblank="true" data-maxlength="2" id="placar_casa" name="placar_casa" value="0">
                                            <button class="btn btn-default btnDiminui"  type="button"><i class="fa fa-caret-down"></i></button>
                                        </div>   


                                    </div>

                                </div> 
                                <div style="float: left;
    width: 12%;
    text-align: center; margin-right: 10px; margin-left: 10px">  <?php
                                if (date("Y-m-d H:i:s") > date_format($date, 'Y-m-d 15:00')) {
                                    echo '<a style="float: left;margin: 31px 0 0 0; id="btn-' . $data->id . '" data-idConfronto="' . $data->id . '" data-idGrupo="' . $data->id_grupo . '" class="btn btn-success" disabled="disabled" >Palpite</a>';
                                } else {
                                    echo '<a style="margin: 40px 0 5px 0;"  id="btn-' . $data->id . '" data-idConfronto="' . $data->id . '" data-idGrupo="' . $data->id_grupo . '" class="btn btn-success">Apostar</a>';
                                }
                                ?>  <?php
                                if ($modelUsers->role == 30) {
                                  //  echo '  <a style="" href="/confronto/update/' . $data->id . '" class="btn btn-success" >Editar</a>';
                                }
                                ?> 
                                    </div>
                                <div class="form-group" style="width: 26px; float:left; margin-top: 15px">
                                    <div class="input-group spinner">


                                        <div class="input-group-btn-vertical">
                                            <button class="btn btn-default btnSoma" type="button"><i class="fa fa-caret-up"></i></button>
                                            <input disabled  class="v<?php echo $data->id ?> placar" type="text" data-notblank="true" data-maxlength="2" id="placar_visitante" name="placar_visitante" style="" value="0">
                                            <button class="btn btn-default btnDiminui" type="button"><i class="fa fa-caret-down"></i></button>
                                        </div>
                                    </div>
                                </div> 
                                <div class="divContainerMarcote">
                                    <div class='divMascoteIcon visitor' style="background-image: url('');     background-repeat: no-repeat;">
                                        <img style="width: 100%" src="/images/<?= $data->idTimeVisitante->id?>/<?= $data->idTimeVisitante->icon_mascote_i?>" />
                                    </div>
                                    <div class="divEscudo visitante">
                                   
                                        
                                   
                                    </div>
                                   
                                </div>

                               

                                <input type="hidden" id="id_confronto" name="id_confronto" value="<?php echo $data->id ?>" />
                                <input type="hidden" id="id_user" name="id_user" value="<?php echo $modelUsers->id; ?>" />
                                <input type="hidden" id="data" name="data" value="<?php echo date("Y-m-d H:i:s") ?>" />

                            </form>
                           
                        </div> 
                        <div id="verApostaDiv-<?php echo $data->id ?>" class="panel-body verApostaDiv">
                            <?php
                            $apostas = Aposta::find()->where(['=', 'id_confronto', $data->id])->orderBy(['data' => SORT_DESC])->all();
                            ?>
                            <?php foreach ($apostas as $aposta) { ?>

                                <div class="divApostas_<?php echo $aposta->id ?>" style="padding: 0 0px 0px 2.5%;;
                                     margin: -30px 0 12px  0; text-align: right;width: 162px;">

                                    <div class="" style="width: 30%;display: initial;">
                                        <label>
                                            <?php echo ucfirst($aposta->idUser->username); ?></label>
                                    </div> <div class="form-group" style="width: 26px; display: inline-block;">

                                        <input class="c<?php echo $aposta->id ?>" type="text" data-notblank="true" data-maxlength="2" id="placar_casa" name="placar_casa" style="width: 100%;text-align: center; border: none" value="<?php echo $aposta->placar_casa ?>" readonly="readonly">
                                    </div> x
                                    <div class="form-group" style="width: 26px; display: inline-block;">

                                        <input  class="v<?php echo $aposta->id ?>" type="text" data-notblank="true" data-maxlength="2" id="placar_visitante" name="placar_visitante" style="width: 100%;text-align: center; border: none " value="<?php echo $aposta->placar_visitante ?>" readonly="readonly">

                                    </div> <div class="" style="width: 30%;display: initial;">
                                        <label>

                                    </div>
                                </div>
                            <?php } ?>

                        </div>  <div id='barraTorcida' style="    margin-top: -20px;">  
                     <div style="
    position: absolute;
"><img src="/images/barraTorcida.png" alt=""></div>
                        <div class="progress m-t-sm">
                          
                            <div class="progress-bar progress-bar-success" data-toggle="tooltip" data-original-title="<?php echo $data->GetNumeroApostaCasa($data->id) ?>" style="width: <?php echo $data::GetPorcentagemApostaCasa($data->id) ?>%; background-color: <?= $data->idTimeCasa->cor_primaria?>"></div>
                            <div class="progress-bar progress-bar-primary" data-toggle="tooltip" data-original-title="<?php echo $data->GetNumeroApostaVisitante($data->id) ?>" style="width: <?php echo $data::GetPorcentagemApostaVisitante($data->id) ?>%; background-color: <?= $data->idTimeVisitante->cor_primaria?>"></div> 
                            </div> </div> 
                    </section>





                <?php } ?>
            </div>
            <div class="col-md-4">
                <section class="panel panel-default">
                    <header class="panel-heading font-bold">Data graph</header>
                    <div class="bg-light dk wrapper">
                        <span class="pull-right">Friday</span>
                        <span class="h4">$540<br>
                            <small class="text-muted">+1.05(2.15%)</small>
                        </span>
                        <div class="text-center m-b-n m-t-sm">
                            <div class="sparkline" data-type="line" data-height="65" data-width="100%" data-line-width="2" data-line-color="#dddddd" data-spot-color="#bbbbbb" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="3" data-resize="true" values="280,320,220,385,450,320,345,250,250,250,400,380"></div>
                            <div class="sparkline inline" data-type="bar" data-height="45" data-bar-width="6" data-bar-spacing="6" data-bar-color="#65bd77">10,9,11,10,11,10,12,10,9,10,11,9,8</div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div>
                            <span class="text-muted">Total:</span>
                            <span class="h3 block">$2500.00</span>
                        </div>
                        <div class="line pull-in"></div>
                        <div class="row m-t-sm">
                            <div class="col-xs-4">
                                <small class="text-muted block">Market</small>
                                <span>$1500.00</span>
                            </div>
                            <div class="col-xs-4">
                                <small class="text-muted block">Referal</small>
                                <span>$600.00</span>
                            </div>
                            <div class="col-xs-4">
                                <small class="text-muted block">Affiliate</small>
                                <span>$400.00</span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-md-4">
                <section class="panel b-light">
                    <header class="panel-heading bg-primary dker no-border"><strong>Calendar</strong></header>
                    <div id="calendar" class="bg-primary m-l-n-xxs m-r-n-xxs"></div>
                    <div class="list-group">
                        <a href="#" class="list-group-item text-ellipsis">
                            <span class="badge bg-danger">7:30</span> 
                            Meet a friend
                        </a>
                        <a href="#" class="list-group-item text-ellipsis"> 
                            <span class="badge bg-success">9:30</span> 
                            Have a kick off meeting with .inc company
                        </a>
                        <a href="#" class="list-group-item text-ellipsis">
                            <span class="badge bg-light">19:30</span>
                            Milestone release
                        </a>
                    </div>
                </section>                  
            </div>
        </div>

    </section>
    <script>
        jQuery(function () {
            $(".summary").hide();
            $(".verApostaDiv").hide();
            PreencheApostas();




        });
        (function ($) {
            $('.spinner .btnSoma').on('click', function () {
                $(this).next("input").val(parseInt($(this).next("input").val(), 10) + 1);
            });
            $('.spinner .btnDiminui').on('click', function () {
                if( $(this).prev("input").val() > 0){
                 $(this).prev("input").val(parseInt($(this).prev("input").val(), 10) - 1);
                 }            });
        })(jQuery);
        function PreencheApostas() {
            $.ajax({
                type: "get",
                url: "/aposta/getapostas/<?= User::findByUsername(Yii::$app->user->identity->username)->id ?>",
                dataType: "json",
                success: function (response, status) {
                  


                    for (var i = 0; response.length > i; i++) {

                        jQuery('#' + response[i][1]).find('input[id=placar_casa]').val(response[i][4]);
                        jQuery('#' + response[i][1]).find('input[id=placar_visitante]').val(response[i][5]);

                    }

                },
                error: function (response, status) {

                },
            });
        }
        function AtualizeApostas() {
            $.ajax({
                type: "get",
                url: "index.php?r=aposta/GetApostas/",
                data: "id=0",
                dataType: "json",
                success: function (response, status) {
                   

                    for (var i = 0; response.length > i; i++) {
                       
                        var divAposta = jQuery('.divApostas_' + response[i][0]);
                        if (divAposta.length > 0) {
                            jQuery('.divApostas_' + response[i][0]).find('input[id=placar_casa]').val(response[i][4]);
                            jQuery('.divApostas_' + response[i][0]).find('input[id=placar_visitante]').val(response[i][5]);
                        } else
                        {
                            jQuery('#verApostaDiv-' + response[i][1]).find('div[class=items]').append('<div class="divApostas_' + response[i][0] + '" style="padding: 0 0px 0px 2.5%;margin: -30px 0 12px  0; text-align: right;width: 162px;">'
                                    + '<div class="" style="width: 30%;display: initial;">'
                                    + ' <label>' + response[i][6] + '</label>'
                                    + ' </div> <div class="form-group" style="width: 26px; display: inline-block;">'

                                    + '<input class="c26" type="text" data-notblank="true" data-maxlength="2" id="placar_casa" name="placar_casa" style="width: 100%;text-align: center; border: none" value="' + response[i][4] + '" readonly="readonly">'
                                    + '</div> x'
                                    + '<div class="form-group" style="width: 26px; display: inline-block;">'

                                    + '<input class="v26" type="text" data-notblank="true" data-maxlength="2" id="placar_visitante" name="placar_visitante" style="width: 100%;text-align: center; border: none " value="' + response[i][5] + '" readonly="readonly">'

                                    + ' </div> <div class="" style="width: 30%;display: initial;">'
                                    + '<label>'

                                    + ' </label></div>'
                                    + '</div>');

                        }
                    }

                },
                error: function (response, status) {

                },
            });
        }
        jQuery('.verAposta').click(function () {
          
            AtualizeApostas();
            var id = jQuery(this).attr('data-id');
            var teste = jQuery('#verApostaDiv-' + id).attr('style');
            if (jQuery('#verApostaDiv-' + id).attr('style') == 'display: block;') {
                jQuery('#verApostaDiv-' + id).slideUp();
            } else
            {
                jQuery('#verApostaDiv-' + id).slideDown();
            }

        });
        jQuery('.btn-success').click(function () {

          
            var id = jQuery(this).attr('data-idConfronto');
            var id_confronto = jQuery('#' + id).find('input[id=id_confronto]').val();
            var placar_casa = jQuery('#' + id).find('input[id=placar_casa]').val();
            var placar_visitante = jQuery('#' + id).find('input[id=placar_visitante]').val();
            var id_user = jQuery('#' + id).find('input[id=id_user]').val();
            var data = jQuery('#' + id).find('input[id=data]').val();
            if (jQuery('.c' + id).val() !== '' && jQuery('.v' + id).val() !== '' && checkNumber(jQuery('.v' + id).val()) && checkNumber(jQuery('.c' + id).val())) {
                $.ajax({
                    type: "get",
                    url: "/aposta/create",
                    data: "id_confronto=" + id_confronto + "&placar_casa=" + placar_casa + "&placar_visitante=" + placar_visitante + "&id_user=" + id_user + "&data=" + data,
                    dataType: "json",
                    success: function (response, status) {
                       
                        jQuery('#btn-' + id).html('ok');
                        AtualizeApostas();
                    }
                });
            } else
            {
                alert('dados Invalidos');
                jQuery('#btn-' + id_confronto).html('Apostar');
                jQuery('#btn-' + id_confronto).removeAttr('disabled');
            }

        });
        function checkNumber(valor) {
            var regra = /^[0-9]+$/;
            if (valor.match(regra)) {
                return true;
            } else {
                return false;
            }
        }
        ;
    </script>
