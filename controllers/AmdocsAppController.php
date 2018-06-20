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
        /** We want to transfer the full script to be approved by user before is is executed. */
        //TO-DO: Add logic when there is no commands at all
        $request = Yii::$app->request;

        $prefixes = $request->post('prefixes'); //Per command, like sudo, etc.
        $names = $request->post('names');    //Actual commands
        $flags = $request->post('flags');       //Flags per command, like -l or --default
        $params = $request->post('params');     //Params per command, like input files, etc.

        $full_command = '';

        for($i=0;$i<count($prefixes);$i++){
            $prefix = $prefixes[$i];
            $name= $names[$i];
            $params_not_parsed = $params[$i];
            $flags_not_parsed = $flags[$i];


            //Parsing params
            $delimiter = array("$");
            $space = array(" ");

            $params = str_replace($delimiter,$space,$params_not_parsed);
            $flags = str_replace($delimiter,$space,$flags_not_parsed);

            $command = $prefix . $name . $flags . $params . "\n"; // Like "sudo rm -rf ProjectFolder"

            $full_command .= $command;
        }
        return $this->render('build',array('script' => $full_command));
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
