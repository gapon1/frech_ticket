<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%trucks}}".
 *
 * @property int $id
 * @property int $ticket_id
 * @property string $label
 * @property string $uom
 * @property float $rate
 *
 * @property Tickets $ticket
 */
class Trucks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%trucks}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ticket_id', 'label', 'uom', 'rate'], 'required'],
            [['ticket_id'], 'integer'],
            [['uom'], 'string'],
            [['rate','quantity', 'total'], 'number'],
            [['label'], 'string', 'max' => 255],
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
            'label' => 'Label',
            'uom' => 'Uom',
            'rate' => 'Rate',
            'quantity' => 'Qty',
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
     * @return TrucksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TrucksQuery(get_called_class());
    }
}
