<?php
/**
 * Created by PhpStorm.
 * User: Max
 */

namespace app\models;

use yii\base\Model;

/**
 * This is the model class for encoded script to be transferred to build and run.
 *
 * @property string $flow
 */
class InputFlowForm extends Model
{
    public $flow;   //All the input which taken from index view regarding commands. Must be parsed and aligned to db.

    //TO-DO: Validation!
}

