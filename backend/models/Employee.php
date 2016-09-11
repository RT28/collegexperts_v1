<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $date_of_birth
 * @property string $gender
 * @property string $address
 * @property string $street
 * @property integer $city
 * @property integer $state
 * @property integer $country
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'date_of_birth', 'gender', 'address', 'street', 'city', 'state', 'country'], 'required'],
            [['date_of_birth'], 'safe'],
            [['city', 'state', 'country'], 'integer'],
            [['first_name', 'last_name', 'address', 'street'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'date_of_birth' => 'Date Of Birth',
            'gender' => 'Gender',
            'address' => 'Address',
            'street' => 'Street',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
        ];
    }

    public function addEmployee($employee) {

    }
}
