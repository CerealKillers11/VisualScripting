<?php

/* @var $this yii\web\View */

use app\models\Commands;
use app\models\Users;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Build';
$this->params['breadcrumbs'][] = $this->title;


$pub1 = Yii::$app->assetManager->publish(__DIR__ . '/js/jquery.js');
$this->registerJsFile($pub1[1], ['depends' => ['yii\web\JqueryAsset']]);


$pub2 = Yii::$app->assetManager->publish(__DIR__ . '/js/jquery-ui.min.js');
$this->registerJsFile($pub2[1], ['depends' => ['yii\web\JqueryAsset']]);


?>
<div class="amdocs-app-build">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.min.js"></script>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the Build page. You can see here your prepared script ready to be executed: <br><br>
        <?php echo $script; ?>
    </p>

    <br>
    <br>

    <div class="row">
        <div class="col-lg-5">

            <form>
                <?= Html::button('Save', ['id' => 'save-button',
                                    'class' => 'btn btn-primary']); ?>
            </form>

            <br>

            <?php

            $form = ActiveForm::begin(['id' => 'commands-form','action' => 'index.php?r=amdocs-app%2Fsave']);

            /** ID and Code would be set automatically according to database and given script.
             *  Other fields would be filled by user.
             */

            ?>

            <?= $form->field($model, 'Name')->label('Short descriptive name for your script') ?>

            <?= $form->field($model, 'ABR')->label('Add abbreviation for your script') ?>

            <?= $form->field($model, 'Parameters')->label('Parameters, if need') ?>

            <?= $form->field($model, 'Flags')->label('Flags, if need') ?>

            <?= $form->field($model, 'Description')->
                                            textarea(['rows' => 6])->
                                            label('Add a good description for your script') ?>
            <?= $form->field($model, 'Code')->
                                            hiddenInput(['value' => $script])->
                                            label(false) ?>

            <?=
            /** An real input can be changed to 'amdocs' (public command), based on checkbox. username - is default.*/
            $form->field($model, 'username')->hiddenInput(['value' =>
                Users::findOne(Yii::$app->user->identity->getId())->username])->label(false);



            ?>


            <?= Html::checkbox('privateCommandCheckBox',[],['label' => 'Private (visible only for me)']) ?>

            <br>
            <br>

            <div class="form-group">
                <?= Html::submitButton('Save script', ['class' => 'btn btn-primary',
//                    'action' => 'index.php?r=amdocs-app%2Fsave',
                    'name' => 'save-script-button',
                    'method' => 'post',
                    'onclick' => 'return confirmSaveScript();'
                ]) ?>
            </div>

            <script>
                function confirmSaveScript() {
                    let checkbox = document.getElementsByName('privateCommandCheckBox')[0];

                    if(checkbox.checked){
                        return confirm('Do you want to save this script as private ?')
                    }
                    else{
                        document.getElementById('commands-username').setAttribute('value','amdocs');
                        return confirm('Do you want to save this script as public?')
                    }
                }
            </script>



            <?php ActiveForm::end(); ?>

            <script>
                $(document).ready(function () {
                    $("#commands-form").hide();
                });

                $(document).ready(function () {
                    $("#save-button").click(function (e) {
                        e.preventDefault();
                        $("#commands-form").toggle(400);
                        $(this).text(function (i, text) {
                            return text === "Save" ? "Hide" : "Save";
                        });
                    });
                });

            </script>

        </div>

    </div>

</div>

