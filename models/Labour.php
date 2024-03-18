<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%labour}}".
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $staff_id
 * @property int $position_id
 * @property float|null $total
 *
 * @property Positions $position
 * @property Staff $staff
 * @property Tickets $ticket
 */
class Labour extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%labour}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ticket_id', 'staff_id', 'position_id'], 'required'],
            [['ticket_id', 'staff_id', 'position_id'], 'integer'],
            [['reg_hours', 'overtime', 'total', 'regular_rate', 'overtime_rate'], 'number'],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tickets::class, 'targetAttribute' => ['ticket_id' => 'id']],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::class, 'targetAttribute' => ['staff_id' => 'id']],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Positions::class, 'targetAttribute' => ['position_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ticket_id' => 'Ticket',
            'staff_id' => 'Staff',
            'position_id' => 'Position',
            'reg_hours' => 'Reg Hours',
            'regular_rate' => 'Reg Rate',
            'overtime_rate' => 'Overtime Rate',
            'overtime' => 'Overtime',
            'total' => 'Total',
        ];
    }

    /**
     * Gets query for [[Position]].
     *
     * @return \yii\db\ActiveQuery|PositionsQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Positions::class, ['id' => 'position_id']);
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery|StaffQuery
     */
    public function getStaff()
    {
        return $this->hasOne(Staff::class, ['id' => 'staff_id']);
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
     * @return LabourQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LabourQuery(get_called_class());
    }
}
