<?php

namespace app\models;

use app\components\CadasterInterface;
use Yii;

/**
 * This is the model class for table "cadaster".
 *
 * @property int $id
 * @property string $address
 * @property string $cadastral_number
 */
class Cadaster extends \yii\db\ActiveRecord implements CadasterInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cadaster';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address'], 'required'],
            [['address'], 'string', 'max' => 250],
            [['cadastral_number'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Address',
            'cadastral_number' => 'Cadastral Number',
        ];
    }

    /**
     * @inheritdoc
     * @return CadasterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CadasterQuery(get_called_class());
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $number
     */
    public function setCadastralNumber(string $number)
    {
        $this->cadastral_number = $number;

        $this->is_requested = true;
    }

    /**
     * @param string $area
     */
    public function setArea(string $area)
    {
        $this->area = $area;
    }
}
