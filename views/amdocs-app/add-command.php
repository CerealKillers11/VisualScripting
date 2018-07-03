<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use \yii\bootstrap\Html;
use \app\models\Users;

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

            <?= $form->field($model, 'Description')->textarea(['rows' => 6]) ?>

            <?=
            /** An real input can be changed to 'amdocs' (public command), based on checkbox. username - is default.*/
            $form->field($model, 'username')->hiddenInput(['value' =>
             Users::findOne(Yii::$app->user->identity->getId())->username])->label(false);
            ?>


            <?= Html::checkbox('privateCommandCheckBox',[],['label' => 'Private (visible only for me)']) ?>

            <br>
            <br>

            <div class="form-group">
                <?= Html::submitButton('Add command', ['class' => 'btn btn-primary',
                                                                'action' => 'index.php?r=amdocs-app%2Fadd-command',
                                                                'name' => 'commands-button',
                                                                'method' => 'post',
                                                                'onclick' => 'return confirmAddCommand();'
                                                                ]) ?>
            </div>
            <script>
                function confirmAddCommand() {
                    let checkbox = document.getElementsByName('privateCommandCheckBox')[0];

                    if(checkbox.checked){
                        return confirm('Do you want to add this private command?')
                    }
                    else{
                        document.getElementById('commands-username').setAttribute('value','amdocs');
                        return confirm('Do you want to add this public command?')
                    }
                }
            </script>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

    <?php endif; ?>

</div>
