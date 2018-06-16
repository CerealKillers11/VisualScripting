<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class AmdocsAppController extends \yii\web\Controller
{
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionAdd()
    {
        return $this->render('add');
    }

    public function actionBuild()
    {
        return $this->render('build');
    }

    public function actionCommand()
    {
        return $this->render('command');
    }

    public function actionFaq()
    {
        return $this->render('faq');
    }

    public function actionHome()
    {
        return $this->render('home');
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->actionLogin();
        }
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSave()
    {
        return $this->render('save');
    }

}
