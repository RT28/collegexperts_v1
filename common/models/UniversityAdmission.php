<?php

namespace common\models;

use Yii;
use backend\models\UniversityDepartments;

/**
 * This is the model class for table "university_admission".
 *
 * @property integer $id
 * @property integer $university_id
 * @property string $start_date
 * @property string $end_date
 * @property integer $course_id
 * @property integer $department_id
 * @property integer $major_id
 * @property integer $admission_link
 * @property string $eligibility_criteria
 * @property string $admission_fees
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property UniversityCourseList $course
 * @property UniversityDepartments $department
 * @property Majors $major
 * @property University $university
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
            [['university_id', 'start_date', 'end_date', 'course_id', 'department_id', 'major_id', 'admission_link', 'eligibility_criteria', 'admission_fees', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
            [['university_id', 'course_id', 'department_id', 'major_id', 'admission_link', 'created_by', 'updated_by'], 'integer'],
            [['start_date', 'end_date', 'created_at', 'updated_at'], 'safe'],
            [['eligibility_criteria'], 'string'],
            [['admission_fees'], 'number'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => UniversityCourseList::className(), 'targetAttribute' => ['course_id' => 'id']],
            [['department_id'], 'exist', 'skipOnError' => true, 'targetClass' => UniversityDepartments::className(), 'targetAttribute' => ['department_id' => 'id']],
            [['major_id'], 'exist', 'skipOnError' => true, 'targetClass' => Majors::className(), 'targetAttribute' => ['major_id' => 'id']],
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
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'course_id' => 'Course ID',
            'department_id' => 'Department ID',
            'major_id' => 'Major ID',
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
    public function getCourse()
    {
        return $this->hasOne(UniversityCourseList::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartment()
    {
        return $this->hasOne(UniversityDepartments::className(), ['id' => 'department_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMajor()
    {
        return $this->hasOne(Majors::className(), ['id' => 'major_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUniversity()
    {
        return $this->hasOne(University::className(), ['id' => 'university_id']);
    }
}
