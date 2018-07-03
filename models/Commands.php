<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commands".
 *
 * @property string $ID
 * @property string $username
 * @property string $Name
 * @property string $ABR
 * @property string $Parameters
 * @property string $Flags
 * @property string $Code
 * @property string $Description
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
            [['ID', 'username', 'Name', 'ABR', 'Code'], 'required'],
            [['Name', 'Parameters', 'Flags', 'Code', 'Description'], 'string'],
            [['ID'], 'string', 'max' => 12],
            [['username'], 'string', 'max' => 50],
            [['ABR'], 'string', 'max' => 5],
            [['ID'], 'unique'],
            [['username'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['username' => 'username']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'username' => 'Username',
            'Name' => 'Name',
            'ABR' => 'Abr',
            'Parameters' => 'Parameters',
            'Flags' => 'Flags',
            'Code' => 'Code',
            'Description' => 'Description',
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
