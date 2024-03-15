<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%miscellaneous}}".
 *
 * @property int $id
 * @property int $ticket_id
 * @property string|null $description
 * @property float|null $cost
 * @property float|null $price
 * @property float|null $quantity
 * @property float|null $total
 *
 * @property Tickets $ticket
 */
class Miscellaneous extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%miscellaneous}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ticket_id'], 'required'],
            [['ticket_id'], 'integer'],
            [['description'], 'string'],
            [['cost', 'price', 'quantity', 'total'], 'number'],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tickets::class, 'targetAttribute' => ['ticket_id' => 'id']],
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
            'description' => 'Description',
            'cost' => 'Cost',
            'price' => 'Price',
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
     * {@inheritdoc}
     * @return MiscellaneousQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MiscellaneousQuery(get_called_class());
    }
}
