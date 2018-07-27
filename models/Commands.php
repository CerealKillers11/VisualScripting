<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commands".
 *
 * @property string $id
 * @property string $username
 * @property string $name
 * @property string $parameters
 * @property string $flags
 * @property string $code
 * @property string $description
 * @property int $private
 *
 * @property Users $username0
 */
class Commands extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commands';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username', 'name', 'code', 'private'], 'required'],
            [['name', 'parameters', 'flags', 'code', 'description'], 'string'],
            [['id'], 'string', 'max' => 12],
            [['username'], 'string', 'max' => 50],
            [['private'], 'string', 'max' => 1],
            [['id'], 'unique'],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['username' => 'username']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'name' => 'Name',
            'parameters' => 'Parameters',
            'flags' => 'Flags',
            'code' => 'Code',
            'description' => 'Description',
            'private' => 'Private',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsername0()
    {
        return $this->hasOne(Users::className(), ['username' => 'username']);
    }
}
