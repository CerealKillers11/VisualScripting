<?php

namespace app\controllers;

use app\models\BaseForm;

class BaseController extends \yii\web\Controller
{
    public function actionExecute()
    {
        return $this->render('execute');
    }

    public function actionGenerate()
    {
        return $this->render('generate');
    }

    public function actionIndex()
    {
        $model = new BaseForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // valid data received in $model

            // do something meaningful here about $model ...

            return $this->render('entry-confirm', ['model' => $model]);
        } else {
            // either the page is initially displayed or there is some validation error
            return $this->render('entry', ['model' => $model]);
        }    }

}
