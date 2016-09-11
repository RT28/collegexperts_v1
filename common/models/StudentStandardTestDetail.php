<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student_standard_test_detail".
 *
 * @property integer $id
 * @property integer $student_id
 * @property string $test_name
 * @property integer $verbal_score
 * @property integer $quantitative_score
 * @property integer $integrated_reasoning_score
 * @property integer $data_interpretation_score
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Student $student
 */
class StudentStandardTestDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_standard_test_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'test_name', 'verbal_score', 'quantitative_score', 'integrated_reasoning_score', 'data_interpretation_score', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'required'],
            [['student_id', 'verbal_score', 'quantitative_score', 'integrated_reasoning_score', 'data_interpretation_score', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['test_name'], 'string', 'max' => 255],
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
            'test_name' => 'Test Name',
            'verbal_score' => 'Verbal Score',
            'quantitative_score' => 'Quantitative Score',
            'integrated_reasoning_score' => 'Integrated Reasoning Score',
            'data_interpretation_score' => 'Data Interpretation Score',
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
