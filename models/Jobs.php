<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%jobs}}".
 *
 * @property int $id
 * @property int $customer_id
 * @property string $name
 *
 * @property Customers $customer
 * @property Locations[] $locations
 * @property Tickets[] $tickets
 */
class Jobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%jobs}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'name'], 'required'],
            [['customer_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::class, 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customer_id' => 'Customer ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery|CustomersQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customers::class, ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Locations]].
     *
     * @return \yii\db\ActiveQuery|LocationsQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Locations::class, ['job_id' => 'id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery|TicketsQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::class, ['job_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return JobsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new JobsQuery(get_called_class());
    }
}
