<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $workGroup
 * @property string $authKey
 * @property string $accessToken
 *
 * @property Commands[] $commands
 * @property Workgroups $workgroup
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'username', 'password', 'workGroup', 'authKey', 'accessToken'], 'required'],
            [['id', 'username', 'password', 'workGroup', 'authKey', 'accessToken'], 'string', 'max' => 50],
            [['username'], 'unique'],
            [['accessToken'], 'unique'],
            [['id'], 'unique'],
            [['workgroup'], 'exist', 'skipOnError' => true, 'targetClass' => Workgroups::className(), 'targetAttribute' => ['workgroup' => 'workgroup']],
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
            'password' => 'Password',
            'workGroup' => 'Work Group',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommands()
    {
        return $this->hasMany(Commands::className(), ['username' => 'username']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkgroup()
    {
        return $this->hasOne(Workgroups::className(), ['workGroup' => 'workGroup']);
    }
}
