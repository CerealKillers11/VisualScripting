<?php

namespace app\controllers;

use app\models\BuildForm;
use app\models\ExecuteForm;
use app\models\FlowForm;
use app\models\Users;
use app\models\Workgroups;
use app\models\Flows;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
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
                else if( $output == 0) {
                    return "false";
                }
                else{
                    return $output;
                }
            }
            else if($code == 'action') {
                $replaced_script = str_replace("#","&",$command_script);
                $output = eval($replaced_script);
                return $output;
            }
            else {
                file_put_contents('command.sh',$command_script);

                /** There was a case when unable to execute a command.
                 744 is definitely ok, daemon executes, not user.*/
                chmod('command.sh',0744);
                $output = shell_exec('./command.sh');
                unlink('command.sh');

                if($output == null) return '';
                return $output;
            }
        }
    }

    public function actionSaveFlow()
    {
        $model = new Flows();

        $flow = "";
        $from_index = Yii::$app->request->post('FlowForm');
        if($from_index != null) {
            $graph=$from_index['json_graph'];
            $flow=$graph;
        }

        $form = Yii::$app->request->post('Flows');
        if($form != null) {

            /** Assign a proper new ID*/
            $size = count(Flows::find()->all());
            $model->id  = strval($size+1);
            $model->user_id = $form['user_id'];
            $model->name = $form['name'];
            $model->description = $form['description'];
            $model->flow = $form['flow'];

            $private_arr = Yii::$app->request->post('privateCommandCheckBox');
            $model->private = ($private_arr == null)? '0' : '1';


            if($model->validate()){
                $model->save();
                Yii::$app->session->setFlash('flowSubmitted');
            }
            else{
                Yii::$app->session->setFlash('flowValidationFailed');
            }
        }

        return $this->render('save-flow',['model'=>$model , 'flow' => $flow]);
    }

    public function actionLoadFlow()
    {
        if (Yii::$app->request->isAjax) {
            $graph = file_get_contents('graph.txt');
            return ($graph == "FALSE")?  "Error" : $graph;
        }
        else {

            //Now we need to find all users of his group
            $user = Users::findOne(Yii::$app->user->identity->getId());
            $group = Workgroups::findOne($user->workgroup);
            $users_from_group = Users::find()->where(['workGroup' => $group->workGroup])->all();
            $group_flows = [];

            foreach($users_from_group as $u) {
                $u_flows = Flows::find()->where(['user_id' => $u->attributes['id'] ])
                    ->orderBy('id')
                    ->all();
                foreach ($u_flows as $u_flow) {
                    $group_flows[] = $u_flow;
                }
            }
            $model = new FlowForm();

            return $this->render('load-flow', ['flows' => $group_flows, 'model' => $model]);
        }
    }

    public function actionAddCommand()
    {
        $form = Yii::$app->request->post('Commands');
        $max_id = null;
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

            /** Assign a proper new ID.
             The issue is tha fact that id in DB is string,
             but we want to assign based on max integer value.
             Iterate on a query and find the biggest num value.*/

            $all = Commands::find()->all();

            $max_id = 0;

            foreach($all as $command) {
                $arr = $command->toArray();
                $curr_id_str = $arr['id'];
                $curr_id_int = intval($curr_id_str);
                if($curr_id_int > $max_id)
                {
                    $max_id = $curr_id_int;
                }
            }
            $model->id = strval($max_id + 1);

            if($model->validate()){
                $model->save();
                Yii::$app->session->setFlash('commandsSubmitted');
            }
            else{
                Yii::$app->session->setFlash('validationFailed');
            }
        }
        $form = new Commands();
        return $this->render('add-command', ['model'=>$form ]);
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
        $input_flow_model = new ExecuteForm();
        $save_flow_model = new FlowForm();

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

        $json_graph = "";
        $json_graph_name = "";

        $json_loaded_graph_form = Yii::$app->request->post('FlowForm');
        if($json_loaded_graph_form) {
            $json_graph = $json_loaded_graph_form['json_graph'];
            $json_graph_name = $json_loaded_graph_form['graph_name'];
        }


        return $this->render('index', ['input_flow_model' => $input_flow_model,
                                            'save_flow_model' => $save_flow_model,
                                            'basic_commands' => $basic_commands,
                                            'group_commands' => $group_commands,
                                            'user_commands' => $user_commands,
                                            'json_graph' => $json_graph,
                                            'json_graph_name' => $json_graph_name]);
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

    public function actionSaveLog(){
        if(Yii::$app->request->isAjax){
            $filename = "";
            $filename = $filename . Yii::$app->user->identity->getId() . '--' . date("Y-m-d--H-i-s") . '.log';

            $data = Yii::$app->request->post();
            $json_log = $data['json_log'];
            $log = json_decode($json_log);

            file_put_contents('log/'.$filename, $log);

            return $filename;
        }
    }
}
