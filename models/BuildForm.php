<?php

namespace app\models;

use Yii;
use yii\base\Model;
use InvalidArgumentException;

/**
 * This is the model class for encoded script to be transferred to build and run.
 *
 * @property string $prefixes
 * @property string $names
 * @property string $flags
 * @property string $params
 */
class BuildForm extends Model
{
    public $prefixes;   //Per command, like sudo, etc.
    public $names;      //Actual commands
    public $flags;      //Flags per command, like -l or --default
    public $params;     //Params per command, like input files, etc.

}
