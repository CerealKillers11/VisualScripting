<?php

/* @var $this yii\web\View */

use app\models\Commands;
use app\models\Users;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Save flow';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="amdocs-app/save-flow" >

    <?php if (Yii::$app->session->hasFlash('flowSubmitted')): ?>
        <div class="alert alert-success">
            Your flow was saved successfully!
        </div>

    <?php elseif (Yii::$app->session->hasFlash('flowValidationFailed')): ?>
        <div class="alert alert-danger">
            One or more of provided flow values is not valid. Try again.
        </div>
    <?php else: ?>

        <p>
            Please enter the name of this flow:
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

                <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>


                <?=
                $form->field($model, 'flow')->hiddenInput(['value' => $flow ])->label(false);
                ?>

                <?=
                $form->field($model, 'user_id')->hiddenInput(['value' =>
                    Users::findOne(Yii::$app->user->identity->getId())->id])->label(false);
                ?>

                <?=
                /** Private - visible only for user, public - for his group */
                Html::checkbox('privateCommandCheckBox',[],['label' => 'Private (visible only for you)'])
                ?>

                <br>
                <br>

                <div class="form-group">
                    <?= Html::submitButton('Save flow', ['class' => 'btn btn-primary',
                        'action' => 'index.php?r=amdocs-app%2Fsave-flow',
                        'name' => 'commands-button',
                        'method' => 'post'
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>

</div>

