<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Trucks]].
 *
 * @see Trucks
 */
class TrucksQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Trucks[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Trucks|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
