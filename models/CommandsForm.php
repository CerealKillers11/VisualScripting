<?php

namespace app\models;

use Yii;
use yii\base\Model;
use InvalidArgumentException;

/**
 * This is the model class for encoded script to be transferred to build and run.
 *
 * @property array $prefixes
 * @property array $names
 * @property array $flags
 * @property array $params
 */
class CommandsForm extends Model
{
    public $prefixes;   //Per command, like sudo, etc.
    public $names;      //Actual commands
    public $flags;      //Flags per command, like -l or --default
    public $params;     //Params per command, like input files, etc.


    /**
     * @inheritdoc Calls the base class function after we verify the size om commands array.
    * @param string[]|string $attributeNames attribute name or list of attribute names that should be validated.
    * If this parameter is empty, it means any attribute listed in the applicable
    * validation rules should be validated.
    * @param bool $clearErrors whether to call [[clearErrors()]] before performing validation
    * @return bool whether the validation is successful without any error.
    * @throws InvalidArgumentException if the current scenario is unknown.
    */
    public function validate($attributeNames = null, $clearErrors = true){
        //TO-DO: Add a verifier we got from user non-null-non-zero-length commands
        if(count($this->names) != 0){
            return  yii\base\Model::validate();
        }
        return false;
    }

    /**
     * Sends an encoded script from view to be built and executed.
     * @return bool whether the model passes validation
     */
    public function commands()
    {
        if ($this->validate()) {
            Yii::$app->controller->runAction('build', array($this->prefixes,
                                                            $this->names,
                                                            $this->flags,
                                                            $this->params));
            return true;
        }
        return false;
    }
}
