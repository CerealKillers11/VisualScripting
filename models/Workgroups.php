<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "workgroups".
 *
 * @property string $workGroup
 * @property string $description
 *
 * @property Users[] $users
 */
class Workgroups extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'workgroups';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['workGroup', 'description'], 'required'],
            [['description'], 'string'],
            [['workGroup'], 'string', 'max' => 50],
            [['workGroup'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'workGroup' => 'Work Group',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Users::className(), ['workgroup' => 'workgroup']);
    }
}
