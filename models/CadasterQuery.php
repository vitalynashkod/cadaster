<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Cadaster]].
 *
 * @see Cadaster
 */
class CadasterQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Cadaster[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Cadaster|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
