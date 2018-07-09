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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
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

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

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
    </style>

    <style>
        /** Paper html elements styling */
        .html-element {
            position: absolute;
            background: #3498DB;
            /* Make sure events are propagated to the JointJS element so, e.g. dragging works.*/
            pointer-events: none;
            -webkit-user-select: none;
            border-radius: 4px;
            border: 2px solid #2980B9;
            box-shadow: inset 0 0 5px black, 2px 2px 1px gray;
            padding: 5px;
            box-sizing: border-box;
            z-index: 2;
        }
        .html-element select,
        .html-element input,
        .html-element button {
            /* Enable interacting with inputs only. */
            pointer-events: auto;
        }
        .html-element button.delete {
            color: white;
            border: none;
            background-color: #C0392B;
            border-radius: 20px;
            width: 15px;
            height: 15px;
            line-height: 15px;
            text-align: center;
            position: absolute;
            top: -20px;
            left: -15px;
            padding: 0;
            margin: 0;
            font-weight: bold;
            cursor: pointer;
        }
        .html-element button.btn-info {
            color: white;
            border: none;
            background-color: #2b669a;
            border-radius: 20px;
            width: 15px;
            height: 15px;
            line-height: 15px;
            text-align: center;
            position: absolute;
            top: -20px;

            padding: 0;
            margin: 0;
            font-weight: bold;
            cursor: pointer;
        }

        .html-element button.btn-info:hover {
            width: 20px;
            height: 20px;
            line-height: 20px;
        }

        .html-element button.delete:hover {
            width: 20px;
            height: 20px;
            line-height: 20px;
        }
        .html-element select {
            position: absolute;
            right: 2px;
            bottom: 28px;
        }
        .html-element input {
            /*position: relative;*/
            /*bottom: 0;*/
            /*left: 0;*/
            /*right: 0;*/
            /*border: none;*/
            /*color: #333;*/
            /*padding: 5px;*/
            /*height: 16px;*/
        }
        .html-element label {
            color: #333;
            text-shadow: 1px 0 0 lightgray;
            font-weight: bold;
        }
        .html-element span {
            position: absolute;
            top: 2px;
            right: 9px;
            color: white;
            font-size: 10px;
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

                    alert("Do you want to build?");
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
                             command_description="<?= Html::encode("{$command->Description}"); ?>"
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
                             command_description="<?= Html::encode("{$command->Description}"); ?>"
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
                             command_description="<?= Html::encode("{$command->Description}"); ?>"
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

            // Firstly, achieve the transferred command parameters.
            // -------------------------------------------------------------------------

            let command_id = event.dataTransfer.getData("command_id");
            let command_name = event.dataTransfer.getData("command_name");
            let command_abr = event.dataTransfer.getData("command_abr");
            let command_parameters = event.dataTransfer.getData("command_parameters");
            let command_flags = event.dataTransfer.getData("command_flags");
            let command_code = event.dataTransfer.getData("command_code");
            let command_description = event.dataTransfer.getData("command_description");


            // Now, prepare html string arrays for template:
            // -------------------------------------------------------------------------

            let flags_str_arr = [];
            if(!(command_flags.localeCompare('') == 0)){

                // Parse parameters. Divided with '$'.
                let arr = command_flags.split("$");
                let i;
                for(i=1; i<arr.length; i++) {
                    flags_str_arr.push(
                    '<input type="checkbox" name=\"' + arr[i] + '\" value=\"' + arr[i] + '\" >'+ arr[i] + '</input>');
                    flags_str_arr.push('<br/>');
                }
            }

            let parameters_str_arr = [];
            if(!(command_parameters.localeCompare('') == 0)){

                // Parse parameters. Divided with '$'.
                let arr = command_parameters.split("$");
                let i;
                for(i=1; i<arr.length; i++) {
                    parameters_str_arr.push(
                        '<input type="text" name=\"' + arr[i] + '\" value=\"' + arr[i] + '\" ></input>');
                    parameters_str_arr.push('<br/>');
                }
            }

            console.log(command_description);




            // Do inherit from base html element to create our custom.
            // -------------------------------------------------------------------------

            joint.shapes.html = {};
            joint.shapes.html.Element = joint.shapes.basic.Rect.extend({
                defaults: joint.util.deepSupplement({
                    type: 'html.Element',
                    attrs: {
                        rect: { stroke: 'none', 'fill-opacity': 0 }
                    }
                }, joint.shapes.basic.Rect.prototype.defaults)
            });

            // Create a custom view for that element that displays an HTML div above it.
            // -------------------------------------------------------------------------

            joint.shapes.html.ElementView = joint.dia.ElementView.extend({

                template: ([
                    '<div class="html-element">',
                    '<button class="delete">x</button>',
                    '<button class="btn-info">i</button>',
                    '<label></label>',
                    '<span></span>',
                    '<br/>'].concat(
                        flags_str_arr.concat(
                            parameters_str_arr
                        )
                    )
                )
                .join(''),

                initialize: function() {
                    _.bindAll(this, 'updateBox');
                    joint.dia.ElementView.prototype.initialize.apply(this, arguments);

                    this.$box = $(_.template(this.template)());
                    // Prevent paper from handling pointerdown.
                    this.$box.find('input,select').on('mousedown click', function(evt) {
                        evt.stopPropagation();
                    });
                    // This is an example of reacting on the input change and storing the input data in the cell model.
                    this.$box.find('input').on('change', _.bind(function(evt) {
                        this.model.set('input', $(evt.target).val());
                    }, this));
                    this.$box.find('select').on('change', _.bind(function(evt) {
                        this.model.set('select', $(evt.target).val());
                    }, this));
                    this.$box.find('select').val(this.model.get('select'));
                    this.$box.find('.delete').on('click', _.bind(this.model.remove, this.model));
                    this.$box.find('.btn-info').on('click', _.bind(
                        function(evt){
                            alert(command_description);
                        }
                    ));

                    // Update the box position whenever the underlying model changes.
                    this.model.on('change', this.updateBox, this);
                    // Remove the box when the model gets removed from the graph.
                    this.model.on('remove', this.removeBox, this);

                    this.updateBox();
                },
                render: function() {
                    joint.dia.ElementView.prototype.render.apply(this, arguments);
                    this.paper.$el.prepend(this.$box);
                    this.updateBox();
                    return this;
                },
                updateBox: function() {
                    // Set the position and dimension of the box so that it covers the JointJS element.
                    var bbox = this.model.getBBox();
                    // Example of updating the HTML with a data stored in the cell model.
                    this.$box.find('label').text(this.model.get('label'));
                    this.$box.find('span').text(this.model.get('select'));
                    this.$box.css({
                        width: bbox.width,
                        height: bbox.height,
                        left: bbox.x,
                        top: bbox.y,
                        transform: 'rotate(' + (this.model.get('angle') || 0) + 'deg)'
                    });
                },
                removeBox: function(evt) {
                    this.$box.remove();
                }
            });

            let additionalHeight = (flags_str_arr.length-1)*10 + (parameters_str_arr.length-1)*10

            // Create JointJS elements and add them to the graph as usual.
            // -----------------------------------------------------------
            let el1 = new joint.shapes.html.Element({
                position: { x: 150, y: 150 },
                size: {
                    width: 190,
                    height: 70 + additionalHeight
                },
                label: event.dataTransfer.getData("command_name"),
            });

            el1.addTo(graph);
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
            event.dataTransfer.setData("command_description", event.target.getAttribute("command_description"));
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




