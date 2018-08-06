<?php
/**
 * Created by PhpStorm.
 * User: Adam
 * Date: 23/04/2018
 * Time: 17:27
 */
namespace app\models;

use Yii;
use yii\base\Model;

class BaseForm extends Model
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            ['email', 'email'],
        ];
    }
}