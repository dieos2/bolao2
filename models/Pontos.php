<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pontos".
 *
 * @property integer $id
 * @property string $tipo
 * @property integer $pontos
 *
 * @property Rank[] $ranks
 */
class Pontos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pontos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo', 'pontos'], 'required'],
            [['pontos'], 'integer'],
            [['tipo'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
            'pontos' => 'Pontos',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRanks()
    {
        return $this->hasMany(Rank::className(), ['id_ponto' => 'id']);
    }
}
