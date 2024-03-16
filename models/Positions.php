<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%positions}}".
 *
 * @property int $id
 * @property string $title
 * @property string $uom
 * @property float $regular_rate
 * @property float $overtime_rate
 *
 * @property Labour[] $labours
 * @property Staff[] $staff
 */
class Positions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%positions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'uom', 'regular_rate', 'overtime_rate'], 'required'],
            [['uom'], 'string'],
            [['regular_rate', 'overtime_rate'], 'number'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'uom' => 'Uom',
            'regular_rate' => 'Regular Rate',
            'overtime_rate' => 'Overtime Rate',
        ];
    }

    /**
     * Gets query for [[Labours]].
     *
     * @return \yii\db\ActiveQuery|LabourQuery
     */
    public function getLabours()
    {
        return $this->hasMany(Labour::class, ['position_id' => 'id']);
    }

    /**
     * Gets query for [[Staff]].
     *
     * @return \yii\db\ActiveQuery|StaffQuery
     */
    public function getStaff()
    {
        return $this->hasMany(Staff::class, ['id' => 'staff_id'])->viaTable('{{%staff_positions}}', ['position_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PositionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PositionsQuery(get_called_class());
    }
}
