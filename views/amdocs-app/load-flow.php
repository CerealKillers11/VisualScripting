<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use \yii\bootstrap\Html;

$this->title = 'Load flow';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="amdocs-app/load-flow" >
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        td,th {
            text-align:center;
        };
    </style>



    <div class="container">
        <h2>Searching flows to load</h2>
        <p>Type something in the input field to search the table for user id, privacy, flow name or description:</p>
        <input class="form-control" id="user-input" type="text" placeholder="Search..">
        <br>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Privacy</th>
                    <th>Flow Name</th>
                    <th>Flow Description</th>
                    <th>Load</th>
                </tr>
            </thead>
            <tbody id="flows-table">
                <?php foreach ($flows as $flow): ?>
                    <?php $form = ActiveForm::begin(['id' => 'load-flow-form',
                        'fieldConfig' => ['enableLabel'=>false], // Do not show the labels in view
                        'action' => 'index.php',
                        'method' => 'post']); ?>

                    <?= $form->field($model, 'json_graph')->hiddenInput(['value' =>
                        $flow->flow])->label(false); ?>
                    <?= $form->field($model, 'graph_name')->hiddenInput(['value' =>
                        $flow->name])->label(false); ?>

                    <tr>
                        <td><?= Html::encode("{$flow->user_id}"); ?></td>
                        <td><?php echo ($flow->private == 0)? 'Public' : 'Private' ?></td>
                        <td><?= Html::encode("{$flow->name}"); ?></td>
                        <td><?= Html::encode("{$flow->description}"); ?></td>
                        <td>
                            <?= Html::submitButton('Load flow',
                                ['name' => 'load-flow-button',
                                'class' => 'btn btn-primary',
                                'style' => 'width:100%; height:100%;']); ?>
                        </td>
                    </tr>

                    <?php ActiveForm::end(); ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function(){
            $("#user-input").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#flows-table tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</div>
