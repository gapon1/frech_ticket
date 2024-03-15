<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%trucks}}".
 *
 * @property int $id
 * @property string $label
 * @property string $uom
 * @property float $rate
 * @property int $quantity
 * @property int $total
 *
 * @property TicketTrucks[] $ticketTrucks
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
            [['label', 'uom', 'rate', 'quantity', 'total'], 'required'],
            [['uom'], 'string'],
            [['rate','total'], 'number'],
            [['quantity'], 'integer'],
            [['label'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'uom' => 'Uom',
            'rate' => 'Rate',
            'quantity' => 'Quantity',
            'total' => 'Total',
        ];
    }

    /**
     * Gets query for [[TicketTrucks]].
     *
     * @return \yii\db\ActiveQuery|TicketTrucksQuery
     */
    public function getTicketTrucks()
    {
        return $this->hasMany(TicketTrucks::class, ['truck_id' => 'id']);
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
