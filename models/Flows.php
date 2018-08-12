<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "flows".
 *
 * @property int $id
 * @property string $user_id
 * @property string $name
 * @property string $description
 * @property string $flow
 * @property int $private
 *
 * @property Users $user
 */
class Flows extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'flows';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'name', 'description', 'flow', 'private'], 'required'],
            [['id', 'private'], 'integer'],
            [['description', 'flow'], 'string'],
            [['user_id'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 100],
            [['id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'description' => 'Description',
            'flow' => 'Flow',
            'private' => 'Private',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
