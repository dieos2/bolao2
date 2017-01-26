<?php

namespace app\models;

use Yii;
use app\models\User;
use app\models\setup;
/**
 * This is the model class for table "rank".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $data
 * @property integer $id_aposta
 * @property integer $id_ponto
 *
 * @property User $idUser
 * @property Aposta $idAposta
 * @property Pontos $idPonto
 */
class Rank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'data', 'id_aposta', 'id_ponto'], 'required'],
            [['id_user', 'id_aposta', 'id_ponto'], 'integer'],
            [['data'], 'safe'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_aposta'], 'exist', 'skipOnError' => true, 'targetClass' => Aposta::className(), 'targetAttribute' => ['id_aposta' => 'id']],
            [['id_ponto'], 'exist', 'skipOnError' => true, 'targetClass' => Pontos::className(), 'targetAttribute' => ['id_ponto' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'data' => 'Data',
            'id_aposta' => 'Id Aposta',
            'id_ponto' => 'Id Ponto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAposta()
    {
        return $this->hasOne(Aposta::className(), ['id' => 'id_aposta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPonto()
    {
        return $this->hasOne(Pontos::className(), ['id' => 'id_ponto']);
    }
   
      

    public static function ordenarRank(&$array, $key, $desempate) {
        $sorter = array();
         $ret = array();
        foreach ($array as $ii => $row) {
            $pontos[$ii] = $row[$key];
            $acertos[$ii] = $row[$desempate];
        }

// Ordena os dados com volume descendente, edition ascendente
// adiciona $data como o último parãmetro, para ordenar pela chave comum
      array_multisort($pontos, SORT_DESC, $acertos, SORT_DESC,$array);
        foreach ($array as $ii => $va) {
            $ret[$ii] = $array[$ii];
        }
      return $ret;
    }

    public static function actionGetPosicao($id) {
        $nome = User::findByUsername(Yii::$app->user->identity->username)->username;
        $rankLista = array();
        $rankUser = array();
       
      

        $modelAposta = User::find()->orderBy(['id'])->all();
        $total = 0;
        $id_user = 0;
        foreach ($modelAposta as $item) {
            $rankUser = array("acertos" => Rank::GetAcertos($item->id)
                , "nome" => $item->username, "pontos" => Rank::actionGetTotal($item->id)
                , "resultados" => Rank::GetResultados($item->id));
            array_push($rankLista, $rankUser);
        }
        $rankLista = Setup::aasort($rankLista, 'pontos');
        $posicao = 0;
        foreach ($rankLista as $item) {
            $posicao = $posicao + 1;
            if ($item["nome"] == $nome) {

                return $posicao;
            }
        }
    }

    public static function actionGetRank() {
        $rankLista = array();
        $rankUser = array();
      
        $Criteria->order = "id";

        $modelAposta = User::find()->orderby(['id'])->all();
        $total = 0;
        $id_user = 0;
        foreach ($modelAposta as $item) {
            $rankUser = array("acertos" => Rank::GetAcertos($item->id)
                , "nome" => $item->username, "pontos" => Rank::actionGetTotal($item->id)
                , "resultados" => Rank::GetResultados($item->id));
            array_push($rankLista, $rankUser);
        }

        $rankLista = Rank::ordenarRank($rankLista, 'pontos', 'acertos');
        $this->render('GetRank', array(
            'dataProvider' => $rankLista,
        ));
    }

    public static function actionGetTotal($id) {

          
       
        $modelAposta = Rank::find()->where(['=', 'id_user', $id])->all();
        $total = 0;
        foreach ($modelAposta as $item) {
            $total = $total + $item->idPonto->pontos;
        }
        return $total;
    }

    public static function GetErros($id) {

       
       
        $modelAposta = Rank::find()->where(['=', 'id_user', $id])->all();
        $model = Aposta::find()->where(['=', 'id_user', $id])->all();
        $total = 0;
        $totalAposta = 0;
        foreach ($modelAposta as $item) {
            $total = $total + 1;
        }
        foreach ($model as $item) {
            $totalAposta = $totalAposta + 1;
        }
        return $totalAposta - $total;
    }

    public static function GetAcertos($id) {

       
        
        $modelAposta = Rank::find()->where(['=', 'id_user', $id])->andWhere(['=', 'id_ponto', '1'])->all();
        $total = 0;
        foreach ($modelAposta as $item) {
            $total = $total + 1;
        }
        return $total;
    }

    public static function GetResultados($id) {

      
       
        $modelAposta = Rank::find()->where(['=', 'id_user', $id])->andWhere(['=', 'id_ponto', '2'])->all();
        $total = 0;
        foreach ($modelAposta as $item) {
            $total = $total + 1;
        }
        return $total;
    }
    public static function GetPosicao($id){
         $rankLista = array();
        $rankUser = array();
      
       
       
        $modelAposta = User::find()->orderby('id')->all();
        $total = 0;
        $id_user = 0;
        foreach ($modelAposta as $item) {
            $perfil = Perfil::find()->where(['=', 'id', $item->id])->one();
            if($perfil != null){
            $rankUser = array("acertos" => Rank::GetAcertos($item->id)
                , "nome" => $perfil->nome
                    ,"id"=> $item->id
                    , "pontos" => Rank::actionGetTotal($item->id)
                    ,"foto" => $perfil->foto
                , "resultados" => Rank::GetResultados($item->id));
            array_push($rankLista, $rankUser);
            }
        }

        $rankLista = Rank::ordenarRank($rankLista, 'pontos', 'acertos');
        $key = array_search($id, array_column($rankLista, 'id'));
        return $key+1;
    }
            
    
        }
