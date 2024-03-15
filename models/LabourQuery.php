<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LabourWidget]].
 *
 * @see Labour
 */
class LabourQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Labour[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Labour|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
