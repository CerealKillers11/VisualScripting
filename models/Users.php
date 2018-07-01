<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 * Helpful when we check login and password.
 * Represents our user db
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
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
            [['id', 'username', 'password', 'authKey', 'accessToken'], 'required'],
            [['id', 'username', 'password', 'authKey', 'accessToken'], 'string', 'max' => 50],
            [['username'], 'unique'],
            [['id'], 'unique'],
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
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
        ];
    }

    public function getUsername() { return $this->username; }
}
