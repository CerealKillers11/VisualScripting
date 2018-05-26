<?php

namespace app\controllers;

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
        return $this->render('index');
    }

    public function actionLogin()
    {
        return $this->render('login');
    }

    public function actionLogout()
    {
        return $this->render('logout');
    }

    public function actionSave()
    {
        return $this->render('save');
    }

}
