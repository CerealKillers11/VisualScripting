<?php
/* @var $this yii\web\View */

use \yii\bootstrap\Html;
use \app\models\BuildForm;
use yii\bootstrap\ActiveForm;


$pub1 = Yii::$app->assetManager->publish(__DIR__ . '/js/jquery.js');
$this->registerJsFile($pub1[1], ['depends' => ['yii\web\JqueryAsset']]);


$pub2 = Yii::$app->assetManager->publish(__DIR__ . '/js/jquery-ui.min.js');
$this->registerJsFile($pub2[1], ['depends' => ['yii\web\JqueryAsset']]);


$pub3 = Yii::$app->assetManager->publish(__DIR__ . '/css/jquery-ui.min.css');
$this->registerCssFile($pub3[1], ['depends' => ['yii\web\JqueryAsset']]);

?>

<?php $this->beginPage() ?>
<div class="amdocs-app-index">

    <link rel="stylesheet" href="css/jquery-ui.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.min.js"></script>
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
        }

        /* Add a left side menu - vertical scroll only */
        .library_menu {
            background-color: white;
            padding: 20px;
            margin-top: 20px;
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
            transition: max-height 0.2s ease-out;
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
        <div class="col-lg-5">

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
    </div>


    <div class="row">
        <div class="leftcolumn">

            <div class="library_menu">
                <button class="accordion">Basic Commands</button>
                <div class="panel">
                    <div class="library_element" name="le1"> <!--draggable="true" ondragstart="drag(event)"-->
                        Some text 1
                    </div>
                    <div class="library_element" name="le2">
                        Some text 2
                    </div>
                    <div class="library_element" name="le3">
                        Some text 3
                    </div>

                </div>
                <button class="accordion">My Commands</button>
                <div class="panel" >
                    <div class="library_element">
                        Some text 1
                    </div>
                    <div class="library_element">
                        Some text 2
                    </div>
                    <div class="library_element">
                        Some text 3
                    </div>
                </div>
                <button class="accordion">Amdocs Special</button>
                <div class="panel">
                    <div class="library_element">
                        Some text 1
                    </div>
                    <div class="library_element">
                        Some text 2
                    </div>
                    <div class="library_element">
                        Some text 3
                    </div>
                </div>
            </div>

            <script>
                let acc = document.getElementsByClassName("accordion");
                let i;

                for (i = 0; i < acc.length; i++) {
                    acc[i].addEventListener("click", function () {
                        this.classList.toggle("active");
                        let panel = this.nextElementSibling;
                        if (panel.style.maxHeight) {
                            panel.style.maxHeight = null;
                        } else {
                            panel.style.maxHeight = panel.scrollHeight + "px";
                        }
                    });
                }
            </script>
        </div>
        <div class="rightcolumn">
            <div class="canvas" id="canvas1">
                <div id="sortable">
                    <div class="canvas_element ui-state-disabled" name="start">Start</div>
                    <div class="canvas_element" name="sudo rm -rf AmdocsProjectFolder">sudo</div>
                    <div class="canvas_element" name="find -name 'Adam' ../../users">find</div>
                    <div class="canvas_element" name="grep -l 'Max' MyFile.txt">grep</div>
                    <div class="canvas_element" name="mkdir NewFolder">mkdir</div>
                    <div class="canvas_element ui-state-disabled" name="end">End</div>
                </div>
                <script>
                    $(document).ready(function(){
                        $("p").click(function(){
                            /*$("#sortable").each*/
                            let order = "";
                            $( "div.canvas_element" ).each(function() {
                                order += $( this ).attr("name") + "\n";
                            });
                            alert(order);
                        });
                    });
                </script>
                <p>Click on this paragraph.</p>
            </div>
        </div>
        <script>
            $(function () {
                $("#accordion").accordion({
                    collapsible: true
                });
            });
        </script>
        <script>
            $(function () {
                $("#sortable").sortable({
                    items: "div:not(.ui-state-disabled)"
                });
                $("#sortable div, .library_element,.canvas_element").disableSelection();
            });
        </script>
        <script>
            $(function () {
                $("#sortable").sortable({
                    revert: true
                });
                $("div.library_element").draggable({
                    connectToSortable: "#sortable",
                    helper: function () {
                        let returned = $(this).clone();
                        returned.switchClass("library_element", "canvas_element");
                        //TODO take from db the info for the canvas element
                        return returned;
                    },
                    revert: "invalid",
                });
                $("ul, li").disableSelection();
            });
        </script>
    </div>

    <?php
    /* @var $this yii\web\View */
    ?>

</div>
