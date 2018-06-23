<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commands".
 *
 * @property string $ID
 * @property string $Name
 * @property string $ABR
 * @property string $Parameters
 * @property string $Flags
 * @property string $Code
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
            [['ID', 'Name', 'ABR', 'Parameters', 'Flags', 'Code'], 'required'],
            [['Name', 'Parameters', 'Flags', 'Code'], 'string'],
            [['ID'], 'string', 'max' => 12],
            [['ABR'], 'string', 'max' => 5],
            [['ID'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Name' => 'Name',
            'ABR' => 'Abr',
            'Parameters' => 'Parameters',
            'Flags' => 'Flags',
            'Code' => 'Code',
        ];
    }
}
