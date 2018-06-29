<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use \yii\bootstrap\Html;


?>
<div class="amdocs-app/add-command" >

    <?php if (Yii::$app->session->hasFlash('commandsSubmitted')): ?>
        <div class="alert alert-success">
            Your command was successfully saved! Stay high!
        </div>

    <?php elseif (Yii::$app->session->hasFlash('validationFailed')): ?>
        <div class="alert alert-danger">
            One of more of provided command values is not valid. Try again.
        </div>
    <?php else: ?>

    <p>
        Please enter the parameters of new command:
    </p>

    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'commands-form']);

            /** ID would be set automatically according to database.
             *  Other fields would be filled by user.
             */
            ?>

            <?= $form->field($model, 'Name') ?>

            <?= $form->field($model, 'ABR') ?>

            <?= $form->field($model, 'Parameters') ?>

            <?= $form->field($model, 'Flags') ?>

            <?= $form->field($model, 'Code')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton('Add command', ['class' => 'btn btn-primary',
                                                                'action' => 'index.php?r=amdocs-app%2Fadd-command',
                                                                'name' => 'commands-button',
                                                                'method' => 'post',
                                                                'onclick' => 'confirmAddCommand();']) ?>
            </div>
            <script>
                function confirmAddCommand() {
                    confirm('Do you want to add this command?')
                }
            </script>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <?php endif; ?>

</div>
