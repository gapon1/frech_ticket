<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%ticket_trucks}}".
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $truck_id
 * @property float|null $quantity
 * @property float|null $total
 *
 * @property Tickets $ticket
 * @property Trucks $truck
 */
class TicketTrucks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ticket_trucks}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ticket_id', 'truck_id'], 'required'],
            [['ticket_id', 'truck_id'], 'integer'],
            [['quantity', 'total'], 'number'],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tickets::class, 'targetAttribute' => ['ticket_id' => 'id']],
            [['truck_id'], 'exist', 'skipOnError' => true, 'targetClass' => Trucks::class, 'targetAttribute' => ['truck_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket_id' => 'Ticket ID',
            'truck_id' => 'Truck ID',
            'quantity' => 'Quantity',
            'total' => 'Total',
        ];
    }

    /**
     * Gets query for [[Ticket]].
     *
     * @return \yii\db\ActiveQuery|TicketsQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Tickets::class, ['id' => 'ticket_id']);
    }

    /**
     * Gets query for [[Truck]].
     *
     * @return \yii\db\ActiveQuery|TrucksQuery
     */
    public function getTruck()
    {
        return $this->hasOne(Trucks::class, ['id' => 'truck_id']);
    }

    /**
     * {@inheritdoc}
     * @return TicketTrucksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketTrucksQuery(get_called_class());
    }
}
