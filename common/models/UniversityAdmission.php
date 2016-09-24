<?php

namespace common\models;

use Yii;
use backend\models\UniversityDepartments;

/**
 * This is the model class for table "university_admission".
 *
 * @property integer $id
 * @property integer $university_id
 * @property integer $degree_level_id 
 * @property string $start_date
 * @property string $end_date
 * @property integer $course_id
 * @property integer $department_id
 * @property string $admission_link
 * @property string $eligibility_criteria
 * @property integer $admission_fees
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 
 * @property University $university
 * @property DegreeLevel $degreeLevel
 */
class UniversityAdmission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'university_admission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['university_id', 'start_date', 'end_date', 'admission_link', 'eligibility_criteria', 'admission_fees', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
            [['university_id', 'degree_level_id', 'admission_fees', 'created_by', 'updated_by'], 'integer'],
            [['start_date', 'end_date', 'created_at', 'updated_at'], 'safe'],
            [['eligibility_criteria'], 'string'],            
            [['admission_link'], 'string', 'max' => 500],
            [['degree_level_id'], 'exist', 'skipOnError' => true, 'targetClass' => DegreeLevel::className(), 'targetAttribute' => ['degree_level_id' => 'id']],
            [['university_id'], 'exist', 'skipOnError' => true, 'targetClass' => University::className(), 'targetAttribute' => ['university_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'university_id' => 'University ID',
            'degree_level_id' => 'Degree Level ID', 
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'admission_link' => 'Admission Link',
            'eligibility_criteria' => 'Eligibility Criteria',
            'admission_fees' => 'Admission Fees',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDegreeLevel()
    {
        return $this->hasOne(DegreeLevel::className(), ['id' => 'degree_level_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUniversity()
    {
        return $this->hasOne(University::className(), ['id' => 'university_id']);
    }
}
