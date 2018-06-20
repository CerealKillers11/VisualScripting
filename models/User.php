<?php

namespace app\models;
use app\models\Users as dbUsers;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        $dbUser = dbUsers::find()
            ->where([
                "id" => $id
            ])
            ->one();
        if (!$dbUser) {
            return null;
        }
        return new static($dbUser);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $dbUser = dbUsers::find()
            ->where([
                "accessToken" => $token
            ])
            ->one();
        if (!$dbUser) {
            return null;
        }
        return new static($dbUser);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $dbUser = dbUsers::find()
            ->where([
                "username" => $username
            ])
            ->one();
        if (!$dbUser) {
            return null;
        }
        return new static($dbUser);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
