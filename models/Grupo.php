<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grupo".
 *
 * @property integer $id
 * @property string $nome
 *
 * @property Confronto[] $confrontos
 * @property GrupoTime[] $grupoTimes
 */
class Grupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'grupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome'], 'required'],
            [['nome'], 'string', 'max' => 10],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfrontos()
    {
        return $this->hasMany(Confronto::className(), ['id_grupo' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrupoTimes()
    {
        return $this->hasMany(GrupoTime::className(), ['id_grupo' => 'id']);
    }
}
