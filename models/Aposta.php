<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aposta".
 *
 * @property integer $id
 * @property integer $id_confronto
 * @property integer $id_user
 * @property string $data
 * @property integer $placar_casa
 * @property integer $placar_visitante
 *
 * @property User $idUser
 * @property Confronto $idConfronto
 * @property Rank[] $ranks
 */
class Aposta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'aposta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_confronto', 'id_user', 'data', 'placar_casa', 'placar_visitante'], 'required'],
            [['id_confronto', 'id_user', 'placar_casa', 'placar_visitante'], 'integer'],
            [['data'], 'safe'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_confronto'], 'exist', 'skipOnError' => true, 'targetClass' => Confronto::className(), 'targetAttribute' => ['id_confronto' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_confronto' => 'Id Confronto',
            'id_user' => 'Id User',
            'data' => 'Data',
            'placar_casa' => 'Placar Casa',
            'placar_visitante' => 'Placar Visitante',
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
    public function getIdConfronto()
    {
        return $this->hasOne(Confronto::className(), ['id' => 'id_confronto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRanks()
    {
        return $this->hasMany(Rank::className(), ['id_aposta' => 'id']);
    }
}
