<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%locations}}".
 *
 * @property int $id
 * @property int $job_id
 * @property string $location_lsd
 *
 * @property Jobs $job
 * @property Tickets[] $tickets
 */
class Locations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%locations}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'location_lsd'], 'required'],
            [['job_id'], 'integer'],
            [['location_lsd'], 'string', 'max' => 255],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jobs::class, 'targetAttribute' => ['job_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'job_id' => 'Job ID',
            'location_lsd' => 'Location Lsd',
        ];
    }

    /**
     * Gets query for [[Job]].
     *
     * @return \yii\db\ActiveQuery|JobsQuery
     */
    public function getJob()
    {
        return $this->hasOne(Jobs::class, ['id' => 'job_id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery|TicketsQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::class, ['location_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return LocationsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LocationsQuery(get_called_class());
    }
}
