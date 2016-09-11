<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student_college_detail".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $name
 * @property string $from_date
 * @property string $to_date
 * @property string $curriculum
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Student $student
 */
class StudentCollegeDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_college_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'name', 'from_date', 'to_date', 'curriculum', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
            [['student_id', 'created_by', 'updated_by'], 'integer'],
            [['from_date', 'to_date', 'created_at', 'updated_at'], 'safe'],
            [['name', 'curriculum'], 'string', 'max' => 255],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'name' => 'Name',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'curriculum' => 'Curriculum',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }
}
