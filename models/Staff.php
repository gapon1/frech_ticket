<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%staff}}".
 *
 * @property int $id
 * @property string $name
 *
 * @property Labour[] $labours
 * @property Positions[] $positions
 * @property StaffPositions[] $staffPositions
 * @property Tickets[] $tickets
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%staff}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Labours]].
     *
     * @return \yii\db\ActiveQuery|LabourQuery
     */
    public function getLabours()
    {
        return $this->hasMany(Labour::class, ['staff_id' => 'id']);
    }

    /**
     * Gets query for [[Positions]].
     *
     * @return \yii\db\ActiveQuery|PositionsQuery
     */
    public function getPositions()
    {
        return $this->hasMany(Positions::class, ['id' => 'position_id'])
            ->viaTable('staff_position', ['staff_id' => 'id']);
    }

    /**
     * Gets query for [[StaffPositions]].
     *
     * @return \yii\db\ActiveQuery|StaffPositionsQuery
     */
    public function getStaffPositions()
    {
        return $this->hasMany(StaffPositions::class, ['staff_id' => 'id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery|TicketsQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::class, ['staff_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return StaffQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StaffQuery(get_called_class());
    }
}
