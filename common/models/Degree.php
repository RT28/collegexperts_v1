<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "degree".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $duration
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 */
class Degree extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'degree';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type', 'duration', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['type', 'duration', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['name', 'type'], 'unique', 'targetAttribute' => ['name', 'type'], 'message' => 'The combination of Name and Type has already been taken.'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'type' => 'Type',
            'duration' => 'Duration',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }
}
