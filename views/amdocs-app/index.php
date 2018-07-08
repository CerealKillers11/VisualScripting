<?php
/* @var $this yii\web\View */

use \yii\bootstrap\Html;
use yii\bootstrap\ActiveForm;

?>


<div class="amdocs-app-index">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/lodash.js"></script>
    <script src="js/backbone.js"></script>
    <script src="js/joint.js"></script>
    <link rel="stylesheet" type="text/css" href="css/joint.css" />

    <style>

        #sortable1, #sortable2 {
            list-style-type: none;
            margin: 0;
            padding: 0;
            zoom: 1;
        }

        #sortable1 li, #sortable2 li {
            margin: 0 5px 5px 5px;
            padding: 3px;
            width: 90%;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial;
            padding: 0;
            background: #f1f1f1;
            margin: 0;
            border: 0;

        }

        /* Header/Blog Title */
        .header {
            padding: 10px;
            text-align: center;
            background: lightslategrey;
            margin: 0px;
        }

        .header h1 {
            font-size: 30px;
        }

        /* Style the top navigation bar */
        .topnav {
            overflow: hidden;
            background-color: #333;
        }

        /* Style the topnav links */
        .topnav a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        /* Change color on hover */
        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Create two unequal columns that floats next to each other */
        /* Left column */
        .leftcolumn {
            float: left;
            width: 25%;
        }

        /* Right column */
        .rightcolumn {
            float: left;
            width: 75%;
            background-color: #f1f1f1;
            padding-left: 20px;
            overflow: scroll;
        }

        /* Add a left side menu - vertical scroll only */
        .library_menu {
            background-color: white;
            padding: 20px;
            /*margin-top: 20px;*/
            height: 640px;
            overflow-y: scroll;

        }

        /* Add a canvas for script building */
        .canvas {
            background-color: white;
            padding: 20px;
            margin-top: 20px;
            height: 640px;
            overflow: scroll;

        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /*!* Footer *!*/
        /*.footer {*/
        /*padding: 20px;*/
        /*text-align: center;*/
        /*background: #ddd;*/
        /*margin-top: 20px;*/
        /*}*/

        /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 800px) {
            .leftcolumn, .rightcolumn {
                width: 100%;
                padding: 0;
            }
        }

        /* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
        @media screen and (max-width: 400px) {
            .topnav a {
                float: none;
                width: 100%;
            }
        }

        .accordion {
            background-color: #eee;
            color: #444;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
            transition: 0.4s;
        }

        .accordion:after {
            content: '\002B';
            color: #777;
            font-weight: bold;
            float: right;
            margin-left: 5px;
        }


        .accordion:hover {
            background-color: #ccc;
        }

        .panel {
            padding: 0 18px;
            background-color: white;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
            border: 3px solid white;
        }

        .library_element {
            background-color: #c7ddef;
            color: #444;
            padding: 5px;
            width: 80%;
            border-bottom: 3px solid white;
            text-align: center;
            outline: none;
            font-size: 15px;
            transition: 0.2s;
        }

        .library_element:hover {
            background-color: #0b93d5;
        }

        .canvas_element {
            background-color: #f0ad4e;
            color: #444;
            padding: 20px;
            width: 350px;
            text-align: center;
            outline: none;
            font-size: 15px;
            font-style: italic;
            margin-bottom: 2px;
            border: 1px solid whitesmoke;
        }
    </style>


    <div class="row">
        <div class="col-sm-3">

            <?php $form = ActiveForm::begin(['id' => 'input-flow-form',
                'fieldConfig' => ['enableLabel'=>false], // Do not show the labels in view
                'action' => 'index.php?r=amdocs-app%2Fbuild', //TO-DO pretty urls
                'method' => 'post',
            ]); ?>

            <?= /** An real input will be generated dynamically with getUserFlow() */
            $form->field($model, 'flow')->hiddenInput(['value' => '']); ?>

            <div class="form-group">
                <?= Html::submitButton('Build', ['class' => 'btn btn-primary',
                    'name' => 'build-button',
                    'onclick' => 'setUserFlowToForm();']) ?>
            </div>

            <script>
                function setUserFlowToForm() {
                    let unparsed_input_flow = "";
                    $( "div.canvas_element" ).each(function() {
                        unparsed_input_flow += $( this ).attr("name") + "<br>";
                    });
                    document.getElementById('inputflowform-flow').setAttribute('value',unparsed_input_flow);

                    alert("You fucking want to build, bitch ?!");
                }
            </script>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-sm-2">
            <br>
            <?= Html::button('Zoom Reset', ['id' => 'zoom-reset-button',
                'class' => 'btn btn-primary']); ?>
        </div>
        <div class="col-sm-1">
            <br>
            <?= Html::button('Zoom In', ['id' => 'zoom-in-button',
                'class' => 'btn btn-primary']); ?>
        </div>
        <div class="col-sm-1">
            <br>
            <?= Html::button('Zoom Out', ['id' => 'zoom-out-button',
                'class' => 'btn btn-primary']); ?>
        </div>
        <div class="col-sm-1">
            <br>
            <?= Html::button('Click me', ['id' => 'test-button',
                'class' => 'btn btn-primary']); ?>
        </div>

    </div>
    <div class="row">
        <div class="leftcolumn">

            <div class="library_menu">
                <button class="accordion">Basic Commands</button>
                <div class="panel">
                    <?php foreach ($basic_commands as $command): ?>
                        <div class="library_element"
                             draggable="true"
                             ondragstart="transferCommandData(event);"
                             command_id="<?= Html::encode("{$command->ID}"); ?>"
                             command_name="<?= Html::encode("{$command->Name}"); ?>"
                             command_abr="<?= Html::encode("{$command->ABR}"); ?>"
                             command_parameters="<?= Html::encode("{$command->Parameters}"); ?>"
                             command_flags="<?= Html::encode("{$command->Flags}"); ?>"
                             command_code="<?= Html::encode("{$command->Code}"); ?>"
                        >
                            <?=Html::encode("{$command->Name}"); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="accordion">Amdocs Commands</button>
                <div class="panel">
                    <?php foreach ($amdocs_commands as $command): ?>
                        <div class="library_element"
                             draggable="true"
                             ondragstart="transferCommandData(event);"
                             command_id="<?= Html::encode("{$command->ID}"); ?>"
                             command_name="<?= Html::encode("{$command->Name}"); ?>"
                             command_abr="<?= Html::encode("{$command->ABR}"); ?>"
                             command_parameters="<?= Html::encode("{$command->Parameters}"); ?>"
                             command_flags="<?= Html::encode("{$command->Flags}"); ?>"
                             command_code="<?= Html::encode("{$command->Code}"); ?>"
                        >
                            <?=Html::encode("{$command->Name}"); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="accordion">User Commands</button>
                <div class="panel">
                    <?php foreach ($user_commands as $command): ?>
                        <div class="library_element"
                             draggable="true"
                             ondragstart="transferCommandData(event);"
                             command_id="<?= Html::encode("{$command->ID}"); ?>"
                             command_name="<?= Html::encode("{$command->Name}"); ?>"
                             command_abr="<?= Html::encode("{$command->ABR}"); ?>"
                             command_parameters="<?= Html::encode("{$command->Parameters}"); ?>"
                             command_flags="<?= Html::encode("{$command->Flags}"); ?>"
                             command_code="<?= Html::encode("{$command->Code}"); ?>"
                        >
                            <?=Html::encode("{$command->Name}"); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="rightcolumn" id="rightcolumn" style="height: 640px;">
                <div class="paper_holder" id="paper_holder"
                     ondragover="allowDrop(event);"
                     ondrop="addElementToGraph(event);"></div>
        </div>
    </div>

    <script>
        function addElementToGraph(event) {

            let tmp = new joint.shapes.standard.Rectangle();
            tmp.position(100, 30);
            tmp.resize(100, 40);
            tmp.attr({
                body: {
                    fill: 'blue'
                },
                label: {
                    text: event.dataTransfer.getData("command_name"),
                    fill: 'white'
                }
            });
            tmp.addTo(graph);
        }

        function allowDrop(event) {
            event.preventDefault();
        }

        function transferCommandData(event) {
            event.dataTransfer.setData("command_id", event.target.getAttribute("command_id"));
            event.dataTransfer.setData("command_name", event.target.getAttribute("command_name"));
            event.dataTransfer.setData("command_abr", event.target.getAttribute("command_abr"));
            event.dataTransfer.setData("command_parameters", event.target.getAttribute("command_parameters"));
            event.dataTransfer.setData("command_flags", event.target.getAttribute("command_flags"));
            event.dataTransfer.setData("command_code", event.target.getAttribute("command_code"));
        }
    </script>


</div>

<script>

    /**########### Initial - done at start ###################*/
    /**## Place here all scrips which is used per document ##*/

    let acc = document.getElementsByClassName("accordion");
    let i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("active");
            let panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = "";
            } else {
                panel.style.maxHeight = (panel.scrollHeight + 50) + "px";
            }
        });
    }

    document.addEventListener("dragstart", function(event) {
        if ( event.target.className === "library_element" ) {
            // event.target.style.border = "3px dotted red";
            let paper_holder = document.getElementById('rightcolumn');
            paper_holder.style.border = "3px dotted red";
        }
    });

    document.addEventListener("dragend", function(event) {
        if ( event.target.className === "library_element" ) {
            // event.target.style.border = "";
            let paper_holder = document.getElementById('rightcolumn');
            paper_holder.style.border = "";
        }
    });

    var graph = new joint.dia.Graph();

    var paper = new joint.dia.Paper({
        el: $('#paper_holder'),
        width: 2000,
        height: 2000,
        model: graph,
        gridSize: 10,
        drawGrid: true
    });

    var paper_scale = 1;

    $("#test-button").on("click", function (e) {
        var tmp = new joint.shapes.standard.Rectangle();
        tmp.position(100, 30);
        tmp.resize(100, 40);
        tmp.attr({
            body: {
                fill: 'blue'
            },
            label: {
                text: 'Hello',
                fill: 'white'
            }
        });
        tmp.addTo(graph);
    });


    $(document).ready(function () {
        $("#zoom-in-button").click(function (e) {
            e.preventDefault();
            paper_scale+=0.1;
            paper.scale(paper_scale, paper_scale);
        });
    });
    $(document).ready(function () {
        $("#zoom-out-button").click(function (e) {
            e.preventDefault();
            paper_scale-=0.1;
            paper.scale(paper_scale, paper_scale);
        });
    });
    $(document).ready(function () {
        $("#zoom-reset-button").click(function (e) {
            e.preventDefault();
            paper_scale=1;
            paper.scale(paper_scale, paper_scale);
        });
    });

</script>




