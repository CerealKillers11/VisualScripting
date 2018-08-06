<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use \yii\bootstrap\Html;
use \app\models\Users;

$this->title = 'Add command';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="amdocs-app/add-command" >

    <?php if (Yii::$app->session->hasFlash('commandsSubmitted')): ?>
        <div class="alert alert-success">
            Your command was successfully saved!
        </div>

    <?php elseif (Yii::$app->session->hasFlash('validationFailed')): ?>
        <div class="alert alert-danger">
            One or more of provided command values is not valid. Try again.
        </div>
    <?php else: ?>

    <p>
        Please enter the parameters of new command:
    </p>

    <div class="row">
        <div class="col-lg-5">

            <?php


            $form = ActiveForm::begin(['id' => 'commands-form']);

            /** ID would be set automatically according to database.
             *  Other fields would be filled by user.
             */
            ?>

            <?= $form->field($model, 'name') ?>

            <?= $form->field($model, 'parameters')->
                label('Parameters (e.g. file names/patterns..) :') ?>

            <?= $form->field($model, 'flags')->
                label('Flags (e.g -l,--no-output..) :') ?>

            <?= $form->field($model, 'code')->textarea(['rows' => 3]) ?>

            <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

            <?=
            $form->field($model, 'username')->hiddenInput(['value' =>
             Users::findOne(Yii::$app->user->identity->getId())->username])->label(false);
            ?>


            <?=
            /** Private - visible only for user, public - for his group */
            Html::checkbox('privateCommandCheckBox',[],['label' => 'Private (visible only for me)'])
            ?>

            <br>
            <br>

            <div class="form-group">
                <?= Html::submitButton('Add command', ['class' => 'btn btn-primary',
                                                                'action' => 'index.php?r=amdocs-app%2Fadd-command',
                                                                'name' => 'commands-button',
                                                                'method' => 'post'
                                                                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <?php endif; ?>

</div>
