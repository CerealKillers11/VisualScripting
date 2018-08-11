<?php

namespace app\controllers;

use app\models\BuildForm;
use app\models\InputFlowForm;
use app\models\Users;
use app\models\Workgroups;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\Commands;
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

        if(Yii::$app->request->isAjax){
            return 'Запрос принят!';
        }
        $form = Yii::$app->request->post('BuildForm');
        $test = Yii::$app->request->post('InputFlowForm');

        $kuku = $test['flow'];

        /** We want to transfer the full script to be approved by user before is is executed. */

        $prefixes_str = $form['prefixes']; //Per command, like sudo, etc.
        $names_str = $form['names'];    //Actual commands
        $flags_str = $form['flags'];       //Flags per command, like -l or --default
        $params_str = $form['params'];     //Params per command, like input files, etc.

        $prefixes = explode(",",$prefixes_str);
        $names = explode(",",$names_str);
        $flags = explode(",",$flags_str);
        $params = explode(",",$params_str);

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

            $command = $prefix . ' ' . $name .  ' ' . $flags .  ' ' . $params . "\n"; // Like "sudo rm -rf ProjectFolder"

            $full_command .= $command;
        }

        $model = new Commands(); //For saving the script

        return $this->render('build',['model'=> $model,'script' => $kuku]);
    }



    public function actionExecute(){
        if(Yii::$app->request->isAjax){
            $data = Yii::$app->request->post();

            $command_script = $data['script'];
            $code = $data['code'];

            if($code == 'if') {

                $replaced_script = str_replace("#","&",$command_script);
                $output = eval($replaced_script);
                if ($output == 1)
                {
                    return "true";
                }
                return "false";
            }
            else {
                file_put_contents('command.sh',$command_script);
                $output = shell_exec($command_script);
                if($output == null) return '';
                return $output;
            }
        }
    }

    public function actionSaveFlow()
    {
        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $graph = $data['graph'];
            $bytes_num = file_put_contents('graph.txt',$graph);
            return ($bytes_num > 0)? "Success" : "Error";
        }
    }

    public function actionLoadFlow()
    {
        if (Yii::$app->request->isAjax) {
            $graph = file_get_contents('graph.txt');
            return ($graph == "FALSE")?  "Error" : $graph;
        }
    }



    public function actionAddCommand()
    {
        $form = Yii::$app->request->post('Commands');
        if($form != null) {
            $model = new Commands();


            $model->name = $form['name'];
            $model->parameters = $form['parameters'];
            $model->flags = $form['flags'];
            $model->code = $form['code'];
            $model->username = $form['username'];
            $model->description = $form['description'];

            $private_arr = Yii::$app->request->post('privateCommandCheckBox');
            $model->private = ($private_arr == null)? '0' : '1';

            /** Assign a proper new ID*/
            $size = count(Commands::find()->all());
            $model->id  = strval($size+1);

            if($model->validate()){
                $model->save();
                Yii::$app->session->setFlash('commandsSubmitted');
            }
            else{
                Yii::$app->session->setFlash('validationFailed');
            }
        }
        $form = new Commands();
        return $this->render('add-command', ['model'=>$form]);
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
        $model = new InputFlowForm();

        $basic_commands = Commands::find()->where(['username' => 'basic'])->orderBy('id')->all();

        //Now we need to find all users of his group and load their non-private commands
        $user = Users::findOne(Yii::$app->user->identity->getId());
        $group = Workgroups::findOne($user->workgroup);
        $users_from_group = Users::find()->where(['workGroup' => $group->workGroup])->all();
        $group_commands = [];

        foreach($users_from_group as $u) {
            $u_commands = Commands::find()->where(['username' => $u->attributes['username'],
                                                    'private' => '0'])
                                            ->orderBy('id')
                                            ->all();
            foreach ($u_commands as $u_command) {
                $group_commands[] = $u_command;
            }
        }

        //Now we need to load all user's private commands
        $user_commands = Commands::find()->
            where(['username' => Users::findOne(Yii::$app->user->identity->getId())->username,
                    'private' => "1" ])->
            orderBy('ID')->all();

        return $this->render('index', ['model' => $model,
                                            'basic_commands' => $basic_commands,
                                            'group_commands' => $group_commands,
                                            'user_commands' => $user_commands ]);
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
        $form = Yii::$app->request->post('Commands');
        if($form != null) {
            $model = new Commands();


            $model->name = $form['name'];
            $model->parameters = $form['parameters'];
            $model->flags = $form['flags'];
            $model->code = $form['code'];
            $model->username = $form['username'];
            $model->description = $form['description'];

            $private_arr = Yii::$app->request->post('privateCommandCheckBox');
            $model->private = ($private_arr == null)? '0' : '1';

            /** Assign a proper new ID*/
            $size = count(Commands::find()->all());
            $model->id  = strval($size+1);

            if($model->validate()){
                $model->save();
                Yii::$app->session->setFlash('commandsSubmitted');
            }
            else{
                Yii::$app->session->setFlash('validationFailed');
            }
        }
        return $this->render('save');
    }

}
