<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "perfil".
 *
 * @property integer $id
 * @property string $nome
 * @property string $sobrenome
 * @property string $foto
 * @property integer $sexo
 * @property string $data
 *
 * @property User $id0
 */
class Perfil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'perfil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nome', 'data'], 'required'],
            [['id', 'sexo'], 'integer'],
            [['data'], 'safe'],
            [['nome', 'sobrenome'], 'string', 'max' => 50],
            [['foto'], 'string', 'max' => 40],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'sobrenome' => 'Sobrenome',
            'foto' => 'Foto',
            'sexo' => 'Sexo',
            'data' => 'Data',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }
}
