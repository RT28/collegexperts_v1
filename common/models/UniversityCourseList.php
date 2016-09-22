<?php

namespace common\models;

use Yii;
use backend\models\UniversityDepartments;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "university_course_list".
 *
 * @property integer $id 
 * @property integer $university_id
 * @property integer $degree_id
 * @property integer $major_id
 * @property integer $department_id
 * @property integer $intake
 * @property integer $fees
 * @property string $duration
 * @property integer $type
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 *
 * @property Degree $degree
 * @property UniversityDepartments $department
 * @property Majors $major
 * @property University $university
 */
class UniversityCourseList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'university_course_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['university_id', 'degree_id', 'major_id', 'intake', 'fees', 'duration', 'type', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['university_id', 'degree_id', 'major_id', 'department_id', 'intake', 'fees', 'type', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],            
            [['duration'], 'number'],
            [['degree_id'], 'exist', 'skipOnError' => true, 'targetClass' => Degree::className(), 'targetAttribute' => ['degree_id' => 'id']],
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
            'degree_id' => 'Degree ID',
            'major_id' => 'Major ID',
            'department_id' => 'Department ID',
            'intake' => 'Intake',
            'fees' => 'Fees',
            'duration' => 'Duration',
            'type' => 'Type',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDegree()
    {
        return $this->hasOne(Degree::className(), ['id' => 'degree_id']);
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

    public function getCoursesForUniversityAndDepartment($department_id) {
        if (($model = UniversityCourseList::findBySql("SELECT id, name FROM university_course_list WHERE department_id=$department_id")->all()) !== null) {
            return $model;
        } 
        return [];
    }
}
