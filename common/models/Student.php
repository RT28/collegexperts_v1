<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $date_of_birth
 * @property string $nationality
 * @property string $gender
 * @property string $address
 * @property string $street
 * @property integer $city
 * @property integer $state
 * @property integer $country
 * @property string $pincode
 * @property string $email
 * @property string $parent_email
 * @property string $phone
 * @property string $parent_phone
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property StudentCollegeDetail[] $studentCollegeDetails
 * @property StudentEnglishLanguageProficienceyDetails[] $studentEnglishLanguageProficienceyDetails
 * @property StudentSchoolDetail[] $studentSchoolDetails
 * @property StudentStandardTestDetail[] $studentStandardTestDetails
 * @property StudentSubjectDetail[] $studentSubjectDetails
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'nationality', 'last_name', 'date_of_birth', 'gender', 'address', 'street', 'city', 'state', 'country', 'pincode', 'email', 'parent_email', 'phone', 'parent_phone', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
            [['date_of_birth', 'created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['first_name', 'last_name', 'address', 'street'], 'string', 'max' => 255],
            [['gender', 'email', 'parent_email'], 'string', 'max' => 50],
            [['pincode'], 'string', 'max' => 10],
            [['city', 'state', 'country', 'phone', 'parent_phone'], 'string', 'max' => 20],
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
            'pincode' => 'Pincode',
            'email' => 'Email',
            'parent_email' => 'Parent Email',
            'phone' => 'Phone',
            'parent_phone' => 'Parent Phone',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentCollegeDetails()
    {
        return $this->hasMany(StudentCollegeDetail::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentEnglishLanguageProficienceyDetails()
    {
        return $this->hasMany(StudentEnglishLanguageProficienceyDetails::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentSchoolDetails()
    {
        return $this->hasMany(StudentSchoolDetail::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentStandardTestDetails()
    {
        return $this->hasMany(StudentStandardTestDetail::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentSubjectDetails()
    {
        return $this->hasMany(StudentSubjectDetail::className(), ['student_id' => 'id']);
    }
}
