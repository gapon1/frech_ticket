<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tickets}}".
 *
 * @property int $id
 * @property int $customer_id
 * @property int $job_id
 * @property int $location_id
 * @property int|null $staff_id
 * @property string $date
 * @property string $status
 * @property string|null $description
 * @property int|null $ordered_by
 * @property string|null $area_field
 *
 * @property Customers $customer
 * @property Jobs $job
 * @property Labour[] $labours
 * @property Locations $location
 * @property Miscellaneous[] $miscellaneouses
 * @property Staff $staff
 * @property TicketTrucks[] $ticketTrucks
 */
class Tickets extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tickets}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id', 'job_id', 'location_id'], 'required'],
            [['customer_id', 'job_id', 'location_id', 'staff_id', 'ordered_by'], 'integer'],
            [['date'], 'safe'],
            [['status', 'description'], 'string'],
            [['area_field'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::class, 'targetAttribute' => ['customer_id' => 'id']],
            [['job_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jobs::class, 'targetAttribute' => ['job_id' => 'id']],
            [['location_id'], 'exist', 'skipOnError' => true, 'targetClass' => Locations::class, 'targetAttribute' => ['location_id' => 'id']],
            [['staff_id'], 'exist', 'skipOnError' => true, 'targetClass' => Staff::class, 'targetAttribute' => ['staff_id' => 'id']],
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
            'job_id' => 'Job ID',
            'location_id' => 'Location ID',
            'staff_id' => 'Staff ID',
            'date' => 'Date',
            'status' => 'Status',
            'description' => 'Description',
            'ordered_by' => 'Ordered By',
            'area_field' => 'Area/Field',
        ];
    }

    /**
     * @return array the status options
     */
    public static function getStatusOptions()
    {
        return [
            'Active' => 'Active',
            'Pending' => 'Pending',
            'Closed' => 'Closed',
        ];
    }

    /**
     * @return array the status options
     */
    public static function getUomOptions()
    {
        return [
            'Hourly' => 'Hourly',
            'Fixed' => 'Fixed',
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
     * Gets query for [[Job]].
     *
     * @return \yii\db\ActiveQuery|JobsQuery
     */
    public function getJob()
    {
        return $this->hasOne(Jobs::class, ['id' => 'job_id']);
    }

    /**
     * Gets query for [[Labours]].
     *
     * @return \yii\db\ActiveQuery|LabourQuery
     */
    public function getLabours()
    {
        return $this->hasMany(Labour::class, ['ticket_id' => 'id']);
    }

    /**
     * Gets query for [[Location]].
     *
     * @return \yii\db\ActiveQuery|LocationsQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Locations::class, ['id' => 'location_id']);
    }

    /**
     * Gets query for [[Miscellaneouses]].
     *
     * @return \yii\db\ActiveQuery|MiscellaneousQuery
     */
    public function getMiscellaneouses()
    {
        return $this->hasMany(Miscellaneous::class, ['ticket_id' => 'id']);
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
     * Gets query for [[TicketTrucks]].
     *
     * @return \yii\db\ActiveQuery|TicketTrucksQuery
     */
    public function getTicketTrucks()
    {
        return $this->hasMany(TicketTrucks::class, ['ticket_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TicketsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketsQuery(get_called_class());
    }
}
