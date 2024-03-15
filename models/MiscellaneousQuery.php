<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Miscellaneous]].
 *
 * @see Miscellaneous
 */
class MiscellaneousQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Miscellaneous[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Miscellaneous|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
