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
    <script src="js/Logger.js"></script>
    <link rel="stylesheet" type="text/css" href="css/joint.css"/>
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

            width: 75%;
            background-color: #f1f1f1;
            /*padding-left: 20px;*/
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

        .column {
            float: left;
            width: 10%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .row {
            padding-bottom: 10px;
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

        <div class="column">
            <?= Html::button('Save log', ['id' => 'save-log-button',
                'class' => 'btn btn-primary']); ?>
        </div>

        <div class="column">

            <?php $load_flow_form = ActiveForm::begin(['id' => 'load-flow-form',
                'fieldConfig' => ['enableLabel' => false], // Do not show the labels in view
                'action' => 'index.php?r=amdocs-app%2Fload-flow', //TO-DO pretty urls
                'method' => 'post',
            ]); ?>
            <?= Html::submitButton('Load flow', ['name' => 'load-flow-button',
                'class' => 'btn btn-primary']); ?>

            <?php ActiveForm::end(); ?>

        </div>

        <div class="column">
            <?php $save_flow_form = ActiveForm::begin(['id' => 'save-flow-form',
                'fieldConfig' => ['enableLabel' => false], // Do not show the labels in view
                'action' => 'index.php?r=amdocs-app%2Fsave-flow', //TO-DO pretty urls
                'method' => 'post',
            ]); ?>

            <?= Html::submitButton('Save flow', ['name' => 'save-flow-button',
                'class' => 'btn btn-primary']); ?>

            <?= $save_flow_form->field($save_flow_model, 'json_graph')->
            hiddenInput(['value' => ''])->
            label(false) ?>

            <?php ActiveForm::end(); ?>

        </div>

        <div class="column">

            <?= Html::button('Clear flow', ['id' => 'clear-flow-button',
                'class' => 'btn btn-primary']); ?>

        </div>

        <div class="column">

            <?php $execute_form = ActiveForm::begin(['id' => 'execute-form',
                'fieldConfig' => ['enableLabel' => false], // Do not show the labels in view
                'action' => 'index.php?r=amdocs-app%2Fexecute', //TO-DO pretty urls
                'method' => 'post',
            ]); ?>

            <?= Html::submitButton('Execute', ['class' => 'btn btn-primary',
                'name' => 'execute-button',
            ]) ?>
            <?php ActiveForm::end(); ?>

        </div>

        <div class="column">
            <text>Execution path:</text>
            <input id="execution_path" type="text" value="<?php echo getcwd(); ?>" size="30">
        </div>

    </div>

    <div class="row">
        <div class="leftcolumn">
            <div class="library_menu" style="height: 600px;">
                <button class="accordion">Basic Commands</button>
                <div class="panel">
                    <?php foreach ($basic_commands as $command): ?>
                        <div class="library_element"
                             draggable="true"
                             ondragstart="transferCommandData(event);"
                             command_id="<?= Html::encode("{$command->id}"); ?>"
                             command_name="<?= Html::encode("{$command->name}"); ?>"
                             command_parameters="<?= Html::encode("{$command->parameters}"); ?>"
                             command_flags="<?= Html::encode("{$command->flags}"); ?>"
                             command_code="<?= Html::encode("{$command->code}"); ?>"
                             command_description="<?= Html::encode("{$command->description}"); ?>"
                        >
                            <?= Html::encode("{$command->name}"); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="accordion">Workgroup Commands</button>
                <div class="panel">
                    <?php foreach ($group_commands as $command): ?>
                        <div class="library_element"
                             draggable="true"
                             ondragstart="transferCommandData(event);"
                             command_id="<?= Html::encode("{$command->id}"); ?>"
                             command_name="<?= Html::encode("{$command->name}"); ?>"
                             command_parameters="<?= Html::encode("{$command->parameters}"); ?>"
                             command_flags="<?= Html::encode("{$command->flags}"); ?>"
                             command_code="<?= Html::encode("{$command->code}"); ?>"
                             command_description="<?= Html::encode("{$command->description}"); ?>"
                        >
                            <?= Html::encode("{$command->name}"); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="accordion">User Commands</button>
                <div class="panel">
                    <?php foreach ($user_commands as $command): ?>
                        <div class="library_element"
                             draggable="true"
                             ondragstart="transferCommandData(event);"
                             command_id="<?= Html::encode("{$command->id}"); ?>"
                             command_name="<?= Html::encode("{$command->name}"); ?>"
                             command_parameters="<?= Html::encode("{$command->parameters}"); ?>"
                             command_flags="<?= Html::encode("{$command->flags}"); ?>"
                             command_code="<?= Html::encode("{$command->code}"); ?>"
                             command_description="<?= Html::encode("{$command->description}"); ?>"
                        >
                            <?= Html::encode("{$command->name}"); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="rightcolumn" id="rightcolumn" style="height: 600px;">
            <div class="paper_holder" id="paper_holder"
                 ondragover="allowDrop(event);"
                 ondrop="addElementToGraph(event);"></div>
        </div>
    </div>

    <script>

        function addElementToGraph(event) {

            // Firstly, achieve the transferred from library element command parameters.
            // -------------------------------------------------------------------------

            let command_id = event.dataTransfer.getData("command_id");
            let command_name = event.dataTransfer.getData("command_name");
            let command_parameters = event.dataTransfer.getData("command_parameters");
            let command_flags = event.dataTransfer.getData("command_flags");
            let command_code = event.dataTransfer.getData("command_code");
            let command_description = event.dataTransfer.getData("command_description");


            // Now, prepare html string arrays for template:
            // -------------------------------------------------------------------------

            let flags_str_arr = [];
            if (!(command_flags.localeCompare('') === 0)) {

                // Parse parameters. Divided with '$'.
                let arr = command_flags.split("$");
                let i;
                for (i = 1; i < arr.length; i++) {
                    flags_str_arr.push(
                        '<input type="checkbox" name=\"' + arr[i] + '\" value=\"' + arr[i] + '\" >' + arr[i] + '</input>');
                    flags_str_arr.push('<br/>');
                }
            }

            let parameters_str_arr = [];
            let splitted_params = [];
            if (!(command_parameters.localeCompare('') === 0)) {

                // Parse parameters. Divided with '$'.
                splitted_params = command_parameters.split("$");
                let i;
                for (i = 1; i < splitted_params.length; i++) {
                    parameters_str_arr.push(
                        splitted_params[i] + ":" + '<input type="text" name=\"' + splitted_params[i] + '\" value=\"\" ></input>');
                    parameters_str_arr.push('<br/>');
                }
            }

            // Create a custom view for that element that displays an HTML div above it.
            // -------------------------------------------------------------------------


            // Template string can vary depending on command, e.g. 'for' and 'if'.
            // -------------------------------------------------------------------------

            let have_input_variable = 0;
            let have_output_variable = 0;

            let template_str = '';

            if (command_name.localeCompare('for') === 0 || command_name.localeCompare('assignment') === 0) {
                // For loop or assignment have no input and output variables
                template_str =
                    (['<div class="html-element">',
                            '<button class="delete">x</button>',
                            '<button class="btn-info">i</button>',
                            '<label></label>',
                            '<span></span>',
                            '<br/>'].concat(
                            flags_str_arr.concat(
                                parameters_str_arr
                            )
                        )
                    ).join('');
            }
            else if (command_name.localeCompare('if') === 0) { // Input is condition, output is true/false
                template_str =
                    (['<div class="html-element">',
                            '<button class="delete">x</button>',
                            '<button class="btn-info">i</button>',
                            '<label></label>',
                            '<span></span>',
                            '<br/>'].concat(
                            flags_str_arr.concat(
                                parameters_str_arr.concat(
                                    ['------------------------------------', 'output:',
                                        '<input name="output_variable" type="text" value="">']
                                )
                            )
                        )
                    ).join('');
                have_output_variable = 1;
            }
            else { // Other command with possible input and output
                template_str =
                    ([
                            '<div class="html-element">',
                            '<button class="delete">x</button>',
                            '<button class="btn-info">i</button>',
                            '<label></label>',
                            '<br>',
                            'input:',
                            '<input name="input_variable" type="text" value="">',
                            '------------------------------------',
                            '<span></span>',
                            '<br/>'].concat(
                            flags_str_arr.concat(
                                parameters_str_arr.concat(
                                    ['------------------------------------', 'output:',
                                        '<input name="output_variable" type="text" value="">']
                                )
                            )
                        )
                    ).join('');
                have_input_variable = 1;
            }

            // Setting all command params be empty string by default
            let default_params = splitted_params.reduce(function (acc, param, i) {
                if (i === 0) return acc; // Avoid empty string caused by first $ at param string from db
                acc[param] = "";
                return acc;
            }, []);

            // Do inherit from base html element to create our custom.
            joint.shapes.html.Element = joint.shapes.basic.Rect.extend({
                defaults: joint.util.deepSupplement({
                    markup: '<g class="rotatable"><rect class="body"/><text class="label"/></g>',
                    portMarkup: '<circle class="port-body"/>',
                    portLabelMarkup: '<text class="port-label"/>',

                    type: 'html.Element',
                    attrs: {
                        rect: {stroke: 'none', 'fill-opacity': 0}
                    },
                    template: template_str,

                    /** Our special variables needed
                     * for execution of commands. */
                    command_description: command_description,
                    input_command_code: command_code,
                    input_var_in: '',
                    input_var_out: '',
                    input_params: default_params,
                    input_flags: [],

                    /** Special for for-loop
                     * execution status.
                     * Need to know in advance
                     * if we entered to for-loop cell
                     * first time or not.*/
                    entered_first_time: true

                }, joint.shapes.basic.Rect.prototype.defaults),

            });


            // Vary box sizes depending on command parameters.
            // -----------------------------------------------------------

            let actual_cell_height =  40 +
                (parameters_str_arr.length) * 25 +
                (flags_str_arr.length) * 15 +
                have_input_variable * 130 +
                have_output_variable * 130;


            // Create JointJS elements and add them to the graph as usual.
            // -----------------------------------------------------------

            if (command_name.localeCompare('if') === 0) {
                let if_element = createIfCell(actual_cell_height-50);
                if_element.addTo(graph);
            }
            else if (command_name.localeCompare('for') === 0) {
                let for_element = createForLoopCell(actual_cell_height);
                for_element.addTo(graph);
            }
            else {
                let command_element = createOtherCommandCell(actual_cell_height,command_name);
                command_element.addTo(graph);
            }
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

    /**########### Initial - done at start ###########################*/
    /**## Place here all scrips which is used per document at start ##*/

    let accordions = document.getElementsByClassName("accordion");

    for (let i = 0; i < accordions.length; i++) {
        accordions[i].addEventListener("click", function () {
            this.classList.toggle("active");
            let panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = "";
            } else {
                panel.style.maxHeight = (panel.scrollHeight + 50) + "px";
            }
        });
    }

    document.addEventListener("dragstart", function (event) {
        if (event.target.className === "library_element") {
            let paper_holder = document.getElementById('rightcolumn');
            paper_holder.style.border = "3px dotted red";
        }
    });

    document.addEventListener("dragend", function (event) {
        if (event.target.className === "library_element") {
            let paper_holder = document.getElementById('rightcolumn');
            paper_holder.style.border = "";
        }
    });

    $("#save-log-button").click(function () {
        let logger = document.getElementById('logger');
        NodeList.prototype.forEach = Array.prototype.forEach;
        let children = logger.childNodes;

        let log_message = "";
        children.forEach(function(item){

            if(item.className.localeCompare("log-header") === 0) {
                log_message += item.textContent + "\n";
            }
            else if (item.className.localeCompare("log-timestamp") === 0) {
                log_message += item.textContent;
            }
            else if (item.className.localeCompare("log-message") === 0) {
                log_message += item.textContent + "\n";
            }
            else {
                log_message +=("\n");
            }

            /** textContent */
        });
        console.log(log_message);

        let json_log = JSON.stringify(log_message);

        $.ajax({
            url: 'index.php?r=amdocs-app%2Fsave-log',
            type: 'POST',
            data: 'json_log=' + json_log, //POST-style
            success: function (res) {
                alert('Log succesfully saved, filename: ' + res);
                log('Log succesfully saved, filename: ' + res);

            },
            error: function () {
                alert('Unable to save a log - server error!');
            }
        });
    });

    $("#clear-flow-button").click(function () {
        graph.clear();

        start_cell = createStartCell();
        start_cell.position(350, 30);
        graph.addCell(start_cell);

        finish_cell = createFinishCell();
        finish_cell.position(350, 400);
        graph.addCell(finish_cell);

        resetExecution();

        log("Flow was cleared.")
    });

    $(document).ready(function () {
        $("#save-flow-form").on('beforeSubmit', function () {
            let str_graph = JSON.stringify(graph.toJSON());
            document.getElementById('flowform-json_graph').value = str_graph;
        });
    });

    $(document).ready(function () {
        $("#execute-form").on('beforeSubmit', function () {

            // Collecting user variables - better to define them at start of a script
            // and change them on-demand during the flow.
            // At start, all of them are empty strings.
            if (current_cell === start_cell) {
                collectUserVariables();
                let start_cell_successors = graph.getNeighbors(start_cell);
                if (start_cell_successors.length === 0) {
                    log("Error: Start must be connected. Aborting execution.");
                    return false;
                }
                else {
                    current_cell = start_cell_successors[0];
                }
            }

            /** Try to execute one command - current cell,
             * and move to next. What is included in execution:
             * 1) Collect variables from model, take input value from our array.
             * 2) Construct a command inside small script - described later.
             * 3) Send command to server via AJAX with script as parameter.
             * 4) Execute command on a server and take return value and output.
             * 5) Print the output to a log
             * 6) Save variables in our array*/


            /** At first, taking input of current cell*/
            /** Input can be not only a variable, also some value. */

            let input_var_or_string = "";
            let splitted_input = current_cell.attributes.input_var_in.split("$");

            if (splitted_input.length > 1 && splitted_input[0].localeCompare("") === 0) {

                /** This is variable because starts from $ */
                input_var_or_string = user_variables[splitted_input[1]];
            }
            else {

                /** This is just a some user value, not variable.
                 * User values must not contain dollars! */
                input_var_or_string = splitted_input[0];
            }

            /** Constructing the current command's script. */
            let script = "";

            let code = current_cell.attributes.input_command_code;

            if (code.localeCompare("if") === 0) {
                // The only param of 'if' is a condition
                let condition = composeParams(current_cell);
                script = buildConditionEvalScript(condition);
            }
            else if (code.localeCompare("for") === 0) {
                executeForLoopCell();
                return false;
            }
            else if (code.localeCompare("assignment") === 0) {
                let assignment_res = executeAssignment();

                if(assignment_res) {
                    /** There is no need for res so it is empty string. */
                    moveToNextCommand("");
                }
                else {
                    log("Warning: execution will continue from start cell");
                    resetExecution();
                    log("");
                }
                return false;
            }
            else {
                script = buildOtherCommandScript(input_var_or_string);
            }

            /** Sending the script to a server via AJAX */

            $.ajax({
                url: 'index.php?r=amdocs-app%2Fexecute',
                type: 'POST',
                data: 'script=' + script + '&' + 'code=' + code, //POST-style
                success: function (res) {

                    /** Cut the possible \n at end of result */
                    if (res.charAt(res.length - 1) === '\n') {
                        res = res.slice(0, res.length - 1);
                    }


                    let code = current_cell.attributes.input_command_code;

                    let log_output = (res.localeCompare("") === 0) ?

                        "Executed command: " + code + ", no output"
                        :
                        "Executed command: " + code + ", output: " + res;

                    log(log_output);

                    /** Now need to assign the output variable, if was. */
                    assignVariableFromOutput(res);

                    /** Go to next command. Decide based on connected ports. */
                    moveToNextCommand(res);

                },
                error: function () {
                    alert('Error!');
                }
            });

            /** We don't really going to send a form - avoiding refreshing of page */
            return false;
        });
    });

    /**###############################################################*/


    // Override dia.Link class for enabling to see the arrow cursor and disable double marking.
    joint.dia.Link = joint.dia.Link.extend({
        defaults: joint.util.deepSupplement({
            type: 'link',
            markup: [
                '<path class="connection" stroke="black" d="M 0 0 0 0"/>',
                '<path class="marker-source" fill="orange" stroke="black" d="M 0 0 0 0"/>',
                '<path class="marker-target" fill="orange" stroke="black" d="M 10 0 L 0 5 L 10 10 z"/>',
                '<path class="connection-wrap" d="M 0 0 0 0"/>',
                '<g class="labels"/>',
                '<g class="marker-vertices"/>',
                '<g class="marker-arrowheads"/>',
                '<g class="link-tools"/>'
            ].join(''),

            arrowheadMarkup: [
                '<g class="marker-arrowhead-group marker-arrowhead-group-<%= end %>">',
                '<path class="marker-arrowhead" end="<%= end %>" d="M 0 0 0 0" />',
                '</g>'
            ].join(''),
            router: {name: 'manhattan'},

        }, joint.dia.Link.prototype.defaults),
    });



    var graph = new joint.dia.Graph();


    var paper = new joint.dia.Paper({
        el: $('#paper_holder'),
        width: 2000,
        height: 2000,
        model: graph,
        gridSize: 10,
        drawGrid: true,
        snapLinks: {radius: 50},

        validateConnection: function (cellViewS, magnetS, cellViewT, magnetT, end, linkView) {
            // Prevent linking from output ports to input ports within one element.
            if (cellViewS === cellViewT) return false;

            // Prevent linking from input ports.
            if (magnetS && magnetS.getAttribute('port-group') === 'in') return false;
            if (magnetS && magnetS.getAttribute('port-group') === 'loop-end') return false;

            // Prevent linking to output ports.
            return magnetT &&
                (magnetT.getAttribute('port-group') === 'in' || magnetT.getAttribute('port-group') === 'loop-end');
        },

        validateMagnet: function (cellView, magnet) {
            // Prevent links from ports that already have a link
            var port = magnet.getAttribute('port');
            var links = graph.getConnectedLinks(cellView.model, {outbound: true});
            var portLinks = _.filter(links, function (o) {
                return o.get('source').port === port;
            });
            if (portLinks.length > 0) return false;
            // Note that this is the default behaviour. Just showing it here for reference.
            // Disable linking interaction for magnets marked as passive (see below `.inPorts circle`).
            return magnet.getAttribute('magnet') !== 'passive';
        },

        // Enable marking available cells & magnets
        markAvailable: true,

        // Disable dropping on blank area
        linkPinning: false,

        // Disable multiple linking
        multiLinks: false,

        // Overriden will be in use
        defaultLink: new joint.dia.Link()

    });


    /** Define a namespace for our html elements. */
    joint.shapes.html = {};

    /** An empty implementation of html element. */
    joint.shapes.html.Element = joint.shapes.basic.Rect.extend({
        defaults: joint.util.deepSupplement({
            markup: '<g class="rotatable"><rect class="body"/><text class="label"/></g>',
            portMarkup: '<circle class="port-body"/>',
            portLabelMarkup: '<text class="port-label"/>',

            type: 'html.Element',
            attrs: {
                rect: {stroke: 'none', 'fill-opacity': 0}
            },
            template: '',

            /** Our special variables needed
             * for execution of commands. */
            command_description: '',
            input_command_code: '',
            input_var_in: '',
            input_var_out: '',
            input_params: {},
            input_flags: [],

            /** Special for for-loop
             * execution status.
             * Need to know in advance
             * if we entered to for-loop cell
             * first time or not.*/
            entered_first_time: true

        }, joint.shapes.basic.Rect.prototype.defaults),

    });


    /** A real view of html element, model is not depend on it. */
    joint.shapes.html.ElementView = joint.dia.ElementView.extend({

        template: '', // Will be uploaded from a model.

        initialize: function () {
            _.bindAll(this, 'updateBox');
            joint.dia.ElementView.prototype.initialize.apply(this, arguments);


            this.template = this.model.get('template');

            this.$box = $(_.template(this.template)());

            // If the flow was uploaded from DB, need to upload elements!

            // TO-DO!!!!

            // Array of all inputs, include checkboxes.
            let user_inputs_array = this.$box.find('input') || [];

            for (let i = 0; i < user_inputs_array.length; i++) {
                if (user_inputs_array[i].name.localeCompare("input_variable") === 0) {
                    user_inputs_array[i].value = this.model.get('input_var_in');
                }
                else if (user_inputs_array[i].name.localeCompare("output_variable") === 0) {
                    user_inputs_array[i].value = this.model.get('input_var_out');
                }

                /** Other values which must be assigned from a model are flags and checkboxes*/
                else if (user_inputs_array[i].type.localeCompare("checkbox") === 0) {
                    if (this.model.get('input_flags').includes(user_inputs_array[i].name)) {
                        user_inputs_array[i].checked = true;
                    }
                }
                else if (user_inputs_array[i].type.localeCompare("text") === 0) {
                    if (Object.keys(this.model.get('input_params')).includes(user_inputs_array[i].name)) {
                        user_inputs_array[i].value = this.model.get('input_params')[user_inputs_array[i].name];
                    }
                }
                else {
                    alert("Error restoring values on view!");
                }
            }

            // Prevent paper from handling pointerdown.
            this.$box.find('input,select').on('mousedown click', function (evt) {
                evt.stopPropagation();
            });
            // Reacting on the input change and storing the input data in the cell model.
            this.$box.find('input').on('change', _.bind(function (evt) {

                // We need to listen on user changes of html elements and save
                // the data inside a model, for future building the script.

                // Array of all inputs, include checkboxes.
                let user_inputs_array = $.makeArray(this.$box.find('input'));

                // First one is always input variable and last one is output variable.
                // But not in case we dealing with 'for' or 'if'

                if (this.model.get('input_command_code').localeCompare('for') === 0 ||

                    this.model.get('input_command_code').localeCompare('assignment') === 0) {

                    let input_params = user_inputs_array.reduce(function (acc, input, i) {
                        if (input.type.localeCompare('text') === 0) {
                            acc[input.name] = input.value;
                        }
                        return acc;
                    }, {});
                    this.model.set('input_params', input_params);

                }
                else if (this.model.get('input_command_code').localeCompare('if') === 0) {
                    let output_variable = user_inputs_array[user_inputs_array.length - 1].value;
                    let input_params = user_inputs_array.reduce(function (acc, input, i) {
                        if (i !== user_inputs_array.length - 1 && input.type.localeCompare('text') === 0) {
                            acc[input.name] = input.value;
                        }
                        return acc;
                    }, {});
                    this.model.set('input_var_out', output_variable);
                    this.model.set('input_params', input_params);

                }
                else {
                    let input_variable = user_inputs_array[0].value;
                    let output_variable = user_inputs_array[user_inputs_array.length - 1].value;

                    let checked_checkboxes = user_inputs_array.reduce(function (acc, input) {
                        if (input.type.localeCompare('checkbox') === 0 && input.checked) {
                            acc.push(input.name);
                        }
                        return acc;
                    }, []);
                    let input_params = user_inputs_array.reduce(function (acc, input, i) {
                        if (i !== 0 && i !== user_inputs_array.length - 1 && input.type.localeCompare('text') === 0) {
                            acc[input.name] = input.value;
                        }
                        return acc;
                    }, {});

                    this.model.set('input_var_in', input_variable);
                    this.model.set('input_var_out', output_variable);
                    this.model.set('input_flags', checked_checkboxes);
                    this.model.set('input_params', input_params);
                }

                // Reacting on saving data to model with green border.
                this.$box.css({
                    borderStyle: 'solid',
                    borderColor: 'green'
                });
            }, this));

            // Reacting on the keypress as unsaved data - red border.
            this.$box.find('input').on('keypress', _.bind(function (evt) {
                this.$box.css({
                    borderStyle: 'solid',
                    borderColor: 'red'
                });
            }, this));

            this.$box.find('select').on('change', _.bind(function (evt) {
                this.model.set('select', $(evt.target).val());
            }, this));
            this.$box.find('select').val(this.model.get('select'));
            this.$box.find('.delete').on('click', _.bind(this.model.remove, this.model));
            this.$box.find('.btn-info').on('click', _.bind(
                function () {
                    alert(this.model.get('command_description'));
                }, this
            ));

            // Update the box position whenever the underlying model changes.
            this.model.on('change', this.updateBox, this);
            // Remove the box when the model gets removed from the graph.
            this.model.on('remove', this.removeBox, this);

            this.updateBox();

        },
        render: function () {
            joint.dia.ElementView.prototype.render.apply(this, arguments);
            this.paper.$el.prepend(this.$box);
            this.updateBox();
            return this;
        },

        updateBox: function () {
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
        removeBox: function (evt) {
            this.$box.remove();
        }
    });

    var paper_scale = 1;

    // $(document).ready(function () {
    //     $("#zoom-in-button").click(function (e) {
    //         e.preventDefault();
    //         paper_scale+=0.1;
    //         paper.scale(paper_scale, paper_scale);
    //     });
    // });
    // $(document).ready(function () {
    //     $("#zoom-out-button").click(function (e) {
    //         e.preventDefault();
    //         paper_scale-=0.1;
    //         paper.scale(paper_scale, paper_scale);
    //     });
    // });
    // $(document).ready(function () {
    //     $("#zoom-reset-button").click(function (e) {
    //         e.preventDefault();
    //         paper_scale=1;
    //         paper.scale(paper_scale, paper_scale);
    //     });
    // });

    //Add a logger
    Logger.show();
    Logger.toggle();

    var start_cell;
    var finish_cell;

    intializeNewOrLoadedGraph();

    /**########### Execution process ###########################*/

    /** Real execution of commands done on server.
     * We need to save the flow graph during execution.
     * So the per-command execution is done via ajax. */

    /** At start, we actually need to start a flow from start cell.
     * Initialized from loaded graph or created if no load. */
    var current_cell = start_cell;

    /** User variables are changed during the execution,
     * we need to save them during the execution of commands.
     * Pay attention - this is associative array. */
    var user_variables = [];


    /**###############################################################*/
    /** Script execution helpers */
    /**###############################################################*/


    /**###############################################################*/
    /** Graph and cell creation helpers */
    /**###############################################################*/

    function intializeNewOrLoadedGraph() {
        /** We need a way to get view parameter - we may request to load a script from db*/
        let loaded_graph = <?php echo json_encode($json_graph) ?>;
        let loaded_graph_name = <?php echo json_encode($json_graph_name) ?>;

        if (loaded_graph.localeCompare("") === 0) {
            /** There is no loaded graph.
             * Build new start and finish cells. */
            start_cell = createStartCell();
            start_cell.position(350, 30);
            graph.addCell(start_cell);

            finish_cell = createFinishCell();
            finish_cell.position(350, 400);
            graph.addCell(finish_cell);
        }
        else {
            /** Parse a loaded graph from JSON
             *  and restore cells. */

            log("Uploaded flow: " + loaded_graph_name);

            graph.fromJSON(JSON.parse(loaded_graph));

            let all_cells = graph.getCells();

            for (let i = 0; i < all_cells.length; i++) {
                if (all_cells[i].attributes.type.localeCompare("basic.Rect") === 0) {
                    if (all_cells[i].attributes.ports.items[0].name.localeCompare("out") === 0) {
                        /** This is definitely start cell! */
                        start_cell = all_cells[i];
                    } else if (all_cells[i].attributes.ports.items[0].name.localeCompare("in") === 0) {
                        /** This is definitely finish cell! */
                        finish_cell = all_cells[i];
                    }
                }
            }
        }
    }

    function createStartCell() {
        return new joint.shapes.basic.Rect({
            markup: '<g class="rotatable"><rect class="body"/><text class="label"/></g>',
            portMarkup: '<circle class="port-body"/>',
            portLabelMarkup: '<text class="port-label"/>',
            size: {
                width: 90,
                height: 30
            },
            ports: {
                groups: {
                    'out': {
                        position: 'bottom',
                        attrs: {
                            '.port-label': {
                                fill: '#000',
                                text: 'out'
                            },
                            '.port-body': {
                                fill: '#E74C3C',
                                stroke: '#000',
                                r: 10,
                                magnet: true
                            },
                        },
                        label: {
                            position: {
                                name: 'right',
                                args: {y: +10} // extra arguments for the label layout function, see `layout.PortLabel` section
                            }
                        },
                    }
                },
                items: [
                    // initialize port in group 'in'
                    {
                        name: 'out',
                        group: 'out',
                        args: {} // overrides `args` from the group level definition.
                    }
                    // ... other ports
                ]
            },
            attrs: {
                '.label': {text: 'Start', fill: 'black', 'ref-y': 10},
                rect: {
                    fill: 'orange',
                    width: 90,
                    height: 30
                }
            }
        });
    }

    function createFinishCell() {
        return new joint.shapes.basic.Rect({
            markup: '<g class="rotatable"><rect class="body"/><text class="label"/></g>',
            portMarkup: '<circle class="port-body"/>',
            portLabelMarkup: '<text class="port-label"/>',
            size: {
                width: 90,
                height: 30
            },
            ports: {
                groups: {
                    'in': {
                        position: 'top',
                        attrs: {
                            '.port-label': {
                                fill: '#000',
                                text: 'in'
                            },
                            '.port-body': {
                                fill: '#16A085',
                                stroke: '#000',
                                r: 10,
                                magnet: true
                            }
                        },
                        label: {
                            position: {
                                name: 'right',
                                args: {y: -10} // extra arguments for the label layout function, see `layout.PortLabel` section
                            }
                        },
                    },
                },
                items: [
                    // initialize port in group 'in'
                    {
                        name: 'in',
                        group: 'in',
                        args: {} // overrides `args` from the group level definition.
                    }
                    // ... other ports
                ]
            },
            attrs: {
                '.label': {text: 'Finish', fill: 'black', 'ref-y': 20},
                rect: {
                    fill: 'orange',
                    width: 90,
                    height: 30
                }
            }
        });
    }

    function createIfCell(actual_cell_height){
        return new joint.shapes.html.Element({
            position: {x: 20, y: 20},
            size: {
                width: 200,
                height: actual_cell_height
            },
            ports: {
                groups: {
                    'in': {
                        position: 'top',
                        attrs: {
                            '.port-label': {
                                fill: '#000',
                                text: 'in'
                            },
                            '.port-body': {
                                fill: '#16A085',
                                stroke: '#000',
                                r: 10,
                                magnet: true
                            }
                        },
                        label: {
                            position: {
                                name: 'right',
                                args: {y: -10, x: -25} // extra arguments for the label layout function, see `layout.PortLabel` section
                            }
                        }
                    },
                    'out(true)': {
                        position: 'bottom',
                        attrs: {
                            '.port-label': {
                                fill: '#000',
                                text: 'out(true)'
                            },
                            '.port-body': {
                                fill: '#E74C3C',
                                stroke: '#000',
                                r: 10,
                                magnet: true
                            },
                        },
                        label: {
                            position: {
                                name: 'right',
                                args: {y: +15, x: -65} // extra arguments for the label layout function, see `layout.PortLabel` section
                            }
                        }
                    },
                    'out(false)': {
                        position: 'bottom',
                        attrs: {
                            '.port-label': {
                                fill: '#000',
                                text: 'out(false)'
                            },
                            '.port-body': {
                                fill: '#E74C3C',
                                stroke: '#000',
                                r: 10,
                                magnet: true
                            },
                        },
                        label: {
                            position: {
                                name: 'right',
                                args: {y: +15, x: +10} // extra arguments for the label layout function, see `layout.PortLabel` section
                            }
                        }
                    }
                },
                items: [
                    {
                        name: 'in',
                        group: 'in',
                        args: {} // overrides `args` from the group level definition.
                    },
                    {
                        name: 'out(true)',
                        group: 'out(true)',
                        args: {dx: -60} // overrides `args` from the group level definition.
                    },
                    {
                        name: 'out(false)',
                        group: 'out(false)',
                        args: {dx: +60} // overrides `args` from the group level definition.
                    }
                ]
            },
            attrs: {
                // This is size and other properties of rect which is under the HTML
                rect: {
                    width: 200,
                    height: actual_cell_height
                }
            },
            label: 'if',
        });

    }

    function createForLoopCell(actual_cell_height){
        return new joint.shapes.html.Element({
            position: {x: 20, y: 20},
            size: {
                width: 200,
                height: actual_cell_height
            },
            ports: {
                groups: {
                    'in': {
                        position: 'top',
                        attrs: {
                            '.port-label': {
                                fill: '#000',
                                text: 'in'
                            },
                            '.port-body': {
                                fill: '#16A085',
                                stroke: '#000',
                                r: 10,
                                magnet: true
                            }
                        },
                        label: {
                            position: {
                                name: 'right',
                                args: {y: -10, x: -25} // extra arguments for the label layout function, see `layout.PortLabel` section
                            }
                        }
                    },
                    'out': {
                        position: 'bottom',
                        attrs: {
                            '.port-label': {
                                fill: '#000',
                                text: 'out'
                            },
                            '.port-body': {
                                fill: '#E74C3C',
                                stroke: '#000',
                                r: 10,
                                magnet: true
                            },
                        },
                        label: {
                            position: {
                                name: 'right',
                                args: {y: +10, x: -35} // extra arguments for the label layout function, see `layout.PortLabel` section
                            }
                        }
                    },
                    'loop-end': {
                        position: 'left',
                        attrs: {
                            '.port-label': {
                                fill: '#000',
                                text: 'loop-end'
                            },
                            '.port-body': {
                                fill: '#16A085',
                                stroke: '#000',
                                r: 10,
                                magnet: true
                            }
                        },
                        label: {
                            position: {
                                name: 'right',
                                args: {y: -20, x: -60} // extra arguments for the label layout function, see `layout.PortLabel` section
                            }
                        }
                    },
                    'loop-start': {
                        position: 'left',
                        attrs: {
                            '.port-label': {
                                fill: '#000',
                                text: 'loop-start'
                            },
                            '.port-body': {
                                fill: '#E74C3C',
                                stroke: '#000',
                                r: 10,
                                magnet: true
                            },
                        },
                        label: {
                            position: {
                                name: 'right',
                                args: {y: +20, x: -60} // extra arguments for the label layout function, see `layout.PortLabel` section
                            }
                        }
                    }
                },
                items: [
                    // initialize port in group 'in'
                    {
                        name: 'loop-end',
                        group: 'loop-end',
                        args: { dy: +70 } // overrides `args` from the group level definition.
                    },
                    {
                        name: 'in',
                        group: 'in',
                        args: {} // overrides `args` from the group level definition.
                    },
                    {
                        name: 'loop-start',
                        group: 'loop-start',
                        args: { dy: -70} // overrides `args` from the group level definition.
                    },
                    {
                        name: 'out',
                        group: 'out',
                        args: {} // overrides `args` from the group level definition.
                    }
                    // ... other ports
                ]
            },
            attrs: {
                // This is size and other properties of rect which is under the HTML
                rect: {
                    width: 200,
                    height: actual_cell_height
                }
            },
            label: 'for',
        });
    }

    function createOtherCommandCell(actual_cell_height, command_name){
        return new joint.shapes.html.Element({
            position: {x: 20, y: 20},

            // This is size of overlapping HTML element
            size: {
                width: 200,
                height: actual_cell_height
            },
            ports: {
                groups: {
                    'in': {
                        position: 'top',
                        attrs: {
                            '.port-label': {
                                fill: '#000',
                                text: 'in'
                            },
                            '.port-body': {
                                fill: '#16A085',
                                stroke: '#000',
                                r: 10,
                                magnet: true
                            }
                        },
                        label: {
                            position: {
                                name: 'right',
                                args: {y: -10} // extra arguments for the label layout function, see `layout.PortLabel` section
                            }
                        }
                    },
                    'out': {
                        position: 'bottom',
                        attrs: {
                            '.port-label': {
                                fill: '#000',
                                text: 'out'
                            },
                            '.port-body': {
                                fill: '#E74C3C',
                                stroke: '#000',
                                r: 10,
                                magnet: true
                            },
                        },
                        label: {
                            position: {
                                name: 'right',
                                args: {y: +10} // extra arguments for the label layout function, see `layout.PortLabel` section
                            }
                        }
                    }
                },
                items: [
                    // initialize port in group 'in'
                    {
                        name: 'in',
                        group: 'in',
                        args: {} // overrides `args` from the group level definition.
                    },
                    {
                        name: 'out',
                        group: 'out',
                        args: {} // overrides `args` from the group level definition.
                    }
                    // ... other ports
                ]
            },

            attrs: {
                // This is size and other properties of rect which is under the HTML
                rect: {
                    width: 200,
                    height: actual_cell_height
                }
            },
            label: command_name,
        });

    }

    /**###############################################################*/
    /** Script building and execution helpers */
    /**###############################################################*/

    function executeAssignment() {
        let params = current_cell.attributes.input_params;
        let variable = params["variable"];
        let value = params["value"];
        let splitted_variable = variable.split("$");
        if(splitted_variable.length === 1 ||
            splitted_variable[0].localeCompare("") !== 0 ||
            splitted_variable[1].localeCompare("") === 0) {

            log("Error: variable name must start with \"$\" and cannot be empty.");
            return false;
        }
        else {
            user_variables[splitted_variable[1]] = value;
            log("Executed command: assignment, variable assigned: " + variable + " = \"" + value + "\"");
            return true;
        }
    }

    function executeForLoopCell() {

        /** The strategy to perform for-loop execution is:
         * 1) Action(assignment,++, etc. is performed by PHP's eval().
         * 2) Condition is checked also using PHP's eval(),
         * like as in a case with 'if', just to do it easier.
         * 3) I assume user don't going to change the varable name in code,
         * but it will be checked too.
         * 4) Pay attention that loop can be inclosed in another but
         * this is not a problem, just need to do a correct decision
         * what is the next cell to be executed. */

        let params = current_cell.attributes.input_params;

        /** When we enter not first time we must perform the action. */
        if(!current_cell.attributes.entered_first_time) {

            /** All next time we enter we will perform the action before checking condition. */
            current_cell.attributes.entered_first_time = false;

            let action = params["action"];
            let action_to_eval = buildActionEvalScript(action);

            $.ajax({
                url: 'index.php?r=amdocs-app%2Fexecute',
                type: 'POST',
                data: 'script=' + action_to_eval + '&' + 'code=' + 'action', //POST-style
                success: function (res) {

                    /** Cut the possible \n at end of result */
                    if (res.charAt(res.length - 1) === '\n') {
                        res = res.slice(0, res.length - 1);
                    }

                    log("In a for-loop: performed action \"" + action + "\", result: " + res);

                    /** Now we need to assign result of action to a variable. */
                    updateVariableAfterAction(action,res);

                    checkConditionAndMoveToNextInForLoop();

                },
                error: function () {
                    alert('Internal server error while performing action of for-loop!');
                }
            });
        }
        else {
            /** All next time we enter we will perform the action before checking condition. */
            current_cell.attributes.entered_first_time = false;
            checkConditionAndMoveToNextInForLoop();
        }
    }


    function buildOtherCommandScript(input) {

        /** Other commands are executed on shell.
         * The problem was that the input can contain quotations.
         * This can be solved representing input as array. */

            // Bash script preamble
        let script = "#!/bin/bash" + "\n" + "\n";

        // Prepare code of a command
        let code = current_cell.attributes.input_command_code;

        /** Other command, with classic structure. */

            // Prepare flags
        let flags = composeFlags(current_cell);

        // Achieve params from associative array inside cell model
        let params = composeParams(current_cell);

        // Compose the command string
        let current_command_string = code;
        if (flags.localeCompare("") !== 0) {
            current_command_string += (" " + flags);
        }
        if (params.localeCompare("") !== 0) {
            current_command_string += (" " + params);
        }

        /** Structure of such a command is like this:

         #!/bin/bash

         arr = ("Value of input variable")

         echo "${arr[@]}" | current_command_string

         And its output will be assigned to output variable.

         */

        if (input.localeCompare("") === 0) {
            /** No need for pipelined input.*/
            script += current_command_string;
        }
        else {
            script += "arr=(" + input + ")\n";
            script += "echo \"${arr[@]}\" | " + current_command_string;
        }

        return script;
    }

    function buildConditionEvalScript(condition) {

        /** Decision is made with PHP's eval() on a server side.
         * Condition can be written as comparison,
         * including logical operators.
         * Comparison is made for strings and variables.*/

        let string_to_eval = buildStringWithDefinitionOfPHPVariables(condition);
        string_to_eval += "return (" + condition + ");";

        /** Here the issue is that post-type request uses '&' char.
         * Replace the '&' with '#' in conditional to sent via post. */

        string_to_eval = string_to_eval.replace("&&", "##");

        return string_to_eval;
    }

    function buildActionEvalScript(action) {

        /** Action is performed with PHP's eval() on a server side.*/

        let string_to_eval = buildStringWithDefinitionOfPHPVariables(action);

        /** We assume that lvalue of action is a variable to be changed. */

        /** We need to achieve lvalue of an action. */

        let regex = /([()=<>&| "])/;

        let splitted_action = action.split(regex);

        let lvalue = "";

        for (let i = 0; i < splitted_action.length; i++) {
            if (splitted_action[i].startsWith("$")) {
                lvalue = splitted_action[i];
            }
        }

        string_to_eval +=  action + ";" + "return " + lvalue + ";";

        /** Here the issue is that post-type request uses '&' char.
         * Replace the '&' with '#' in script to sent via post. */

        string_to_eval = string_to_eval.replace("&&", "##");

        return string_to_eval;

    }

    function buildStringWithDefinitionOfPHPVariables(php_code) {

        let regex = /([()=<>&| "])/;

        /** Need to prepare variables.*/
        let splitted_condition = php_code.split(regex);

        let vars_from_condition = [];

        for (let i = 0; i < splitted_condition.length; i++) {
            if (splitted_condition[i].startsWith("$") && !vars_from_condition.includes(splitted_condition[i], 0)) {
                vars_from_condition.push(splitted_condition[i]);
            }
        }

        /** These variables are with '$' at start - need to cut */
        for (let i = 0; i < vars_from_condition.length; i++) {
            vars_from_condition[i] = vars_from_condition[i].replace("$", "");
        }

        /** If one of condition's variables is not defined yet,
         * add it automatically as empty string, but log a warning.*/
        for (let i = 0; i < vars_from_condition.length; i++) {
            if (!Object.keys(user_variables).includes(vars_from_condition[i])) {
                user_variables[vars_from_condition[i]] = "";
                log("Warning: variable $" + vars_from_condition[i] + " was not defined before.");
                log("Warning: auto-assigning variable $" + vars_from_condition[i] + " to \"\".");
            }
        }

        /** Prepare a string with definition of variables */
        let string_to_eval = "";
        for (let i = 0; i < vars_from_condition.length; i++) {
            for (let v in user_variables) {
                if (v.localeCompare(vars_from_condition[i]) === 0) {
                    string_to_eval += "$" + v + " = "  + user_variables[v] + ";\n"
                    //Quotes may cause problems
                    // string_to_eval += "$" + v + " = " + "\"" + user_variables[v] + "\"" + ";\n"

                }
            }
        }

        return string_to_eval;
    }



    function updateVariableAfterAction(action,res) {
        let regex = /([()=<>&| "])/;

        let splitted_action = action.split(regex);

        let variable_to_assign = "";

        for (let i = 0; i < splitted_action.length; i++) {
            if (splitted_action[i].startsWith("$")) {
                variable_to_assign = splitted_action[i];
            }
        }

        let splitted_variable = variable_to_assign.split("$");
        if(splitted_variable.length === 1 ||
            splitted_variable[0].localeCompare("") !== 0 ||
            splitted_variable[1].localeCompare("") === 0) {

            log("Error: variable name must start with \"$\" and cannot be empty.");
            log('Error: unable to perform action in for-loop"')
        }
        else {
            user_variables[splitted_variable[1]] = res;
            log("In a for-loop: performed action, variable assigned: " +
                variable_to_assign +
                " = \"" + res + "\"");
            log();
        }
    }

    function checkConditionAndMoveToNextInForLoop() {

        /** Now, let's check the condition.*/
        let params = current_cell.attributes.input_params;

        let condition = params["condition"];
        let condition_to_eval = buildConditionEvalScript(condition);

        $.ajax({
            url: 'index.php?r=amdocs-app%2Fexecute',
            type: 'POST',
            data: 'script=' + condition_to_eval + '&' + 'code=' + 'if', //POST-style
            success: function (res) {

                /** Cut the possible \n at end of result */
                if (res.charAt(res.length - 1) === '\n') {
                    res = res.slice(0, res.length - 1);
                }

                log("In a for-loop: checked condition \"" + condition + "\", result: " + res);

                /** res is "true" or "false".
                 *  And this is the work for
                 *  "moveToNextCommand".*/
                moveToNextCommand(res);
            },
            error: function () {
                alert('Internal server error while checking condition of for-loop!');
            }
        });
    }



    function assignVariableFromOutput(res) {
        let var_out = current_cell.attributes.input_var_out;

        if (var_out.localeCompare("") !== 0) {
            /** User defined variable to assign output to it */
            let splitted_output = var_out.split("$");

            if (splitted_output.length > 1 && splitted_output[0].localeCompare("") === 0) {

                /** This is variable because starts from $. Ok, assign and save. */
                user_variables[splitted_output[1]] = res;
                log("Variable assigned: " + var_out + " = \"" + res + "\"");

            }
            else if (splitted_output[0].localeCompare("") === 0) {
                /** Do nothing, user don't need an assignment of variable. */
            }
            else {
                /** Output can be variable or nothing! Error!*/
                log("Warning: cannot assign execution output to non-variable " + "\"" + var_out + "\"");
            }
        }
    }

    function moveToNextCommand(res) {
        /** Move to the next command.
         * In case of loop and if we need to make decisions based on ports.*/

        let out_neighbors = graph.getNeighbors(current_cell, {outbound: true});
        console.log("");

        if (out_neighbors.length === 0) {
            log("Warning: unexpected end of flow - not connected to finish cell!");
            log("Warning: execution will continue from start cell");
            resetExecution();
        }
        else {
            let code = current_cell.attributes.input_command_code;

            if(code.localeCompare("for") === 0) {
                moveToNextCommandFromForCell(res,out_neighbors);
            }
            else if(code.localeCompare("if") === 0) {
                moveToNextCommandFromIfCell(res,out_neighbors);
            }
            else {
                moveToNextCommandFromOtherCell(res,out_neighbors);
            }
        }
        /** Print an empty string between the executions of commands*/
        log();
    }

    function moveToNextCommandFromIfCell(res,out_neighbors) {
        if (out_neighbors.length === 1) {

            /** It may be 'if' with only one connected port! */
            let links = graph.getConnectedLinks(current_cell, {outbound: true});

            if (links.length < 2) {
                /** It is 'if' with only one connected port! */
                log("Error: one of ports of 'if' command is not connected!");
                log("Warning: execution will continue from start cell");
                resetExecution();
            }
            else {
                /** Two links to a same cell - is ok*/

                /** Successor can be a finish cell*/
                if (finish_cell === out_neighbors[0]) {
                    log("Finish cell reached during execution! Execution finished!");
                    log("Tip: Execution can be continued from start cell");
                    resetExecution();
                }
                else {
                    /** Move to a next cell*/
                    current_cell = out_neighbors[0];
                }
            }
        }
        else if (out_neighbors.length === 2) {
            /** Case of two links to two cells.*/
            let links = graph.getConnectedLinks(current_cell, {outbound: true});

            for(let i=0; i<links.length; i++) {
                let port_id = links[i].attributes.source.port;
                let port = current_cell.getPort(port_id);
                let port_name = port.name;
                if(port_name.localeCompare('out(true)') === 0 && res.localeCompare("true") === 0){
                    let target_id = links[i].attributes.target.id;
                    let first_neighbor_id = out_neighbors[0].attributes.id;
                    if(target_id.localeCompare(first_neighbor_id) === 0) {
                        if (finish_cell === out_neighbors[0]) {
                            log("Finish cell reached during execution! Execution finished!");
                            log("Tip: Execution can be continued from start cell");
                            resetExecution();
                            return;

                        }
                        else {
                            current_cell = out_neighbors[0];
                            return;
                        }
                    }
                    else {
                        if (finish_cell === out_neighbors[1]) {
                            log("Finish cell reached during execution! Execution finished!");
                            log("Tip: Execution can be continued from start cell");
                            resetExecution();
                            return;
                        }
                        else {
                            current_cell = out_neighbors[1];
                            return;

                        }
                    }
                }
                else if (port_name.localeCompare('out(false)') === 0 && res.localeCompare("false") === 0){
                    let target_id = links[i].attributes.target.id;
                    let first_neighbor_id = out_neighbors[0].attributes.id;
                    if(target_id.localeCompare(first_neighbor_id) === 0) {
                        if (finish_cell === out_neighbors[0]) {
                            log("Finish cell reached during execution! Execution finished!");
                            log("Tip: Execution can be continued from start cell");
                            resetExecution();
                            return;

                        }
                        else {
                            current_cell = out_neighbors[0];
                            return;
                        }
                    }
                    else {
                        if (finish_cell === out_neighbors[1]) {
                            log("Finish cell reached during execution! Execution finished!");
                            log("Tip: Execution can be continued from start cell");
                            resetExecution();
                            return;
                        }
                        else {
                            current_cell = out_neighbors[1];
                            return;

                        }
                    }
                }
            }
        }
        else {
            /** No case where more than two outbound links can be*/
            log("Error: too much outbound links for command \"if\"!");
            log("Warning: execution will continue from start cell");
            resetExecution();
        }
    }

    function moveToNextCommandFromForCell(res,out_neighbors) {

        /** First of all, if res is false, the only way to go
         * is an out port, and if res is true need to go inside a loop.*/

        if(res.localeCompare("true") === 0) {
            /** Need to enter a loop.*/
            if(out_neighbors.length === 1) {
                /** Here we have two cases.
                 * 1) Loop is empty, out is connected.
                 * 2) Out is not connected, and start of loop is connected.*/
                log("Error: one of out ports of 'for' is not connected, check your flow!");
                log("Warning: execution will continue from start cell");
                resetExecution();
            }
            else if(out_neighbors.length === 2) {
                /** Two ports are connected, need to get decision using ports and links,
                 * e.g continue to loop. */

                let links = graph.getConnectedLinks(current_cell, {outbound: true});

                for(let i=0; i<links.length; i++) {
                    let port_id = links[i].attributes.source.port;
                    let port = current_cell.getPort(port_id);
                    let port_name = port.name;
                    if(port_name.localeCompare('loop-start') === 0){
                        let target_id = links[i].attributes.target.id;
                        let first_neighbor_id = out_neighbors[0].attributes.id;
                        if(target_id.localeCompare(first_neighbor_id) === 0) {
                            if (finish_cell === out_neighbors[0]) {
                                log("Error: finish cell inside a loop, check your flow!");
                                log("Warning: execution will continue from start cell");
                                resetExecution();
                                return;

                            }
                            else {
                                current_cell = out_neighbors[0];
                                return;

                            }
                        }
                        else
                        {
                            if (finish_cell === out_neighbors[1]) {
                                log("Error: finish cell inside a loop, check your flow!");
                                log("Warning: execution will continue from start cell");
                                resetExecution();
                                return;

                            }
                            else {
                                current_cell = out_neighbors[1];
                                return;

                            }
                        }
                    }
                }
            }
            else {
                /** No case where more than two outbound links can be*/
                log("Error: too much outbound links for command \"for\"!");
                log("Warning: execution will continue from start cell");
                resetExecution();
            }
        }
        else if(res.localeCompare("false") === 0) {
            /** Need to go out.
             * Do not forget to update flag entered_first_time
             * from the model*/
            current_cell.attributes.entered_first_time = true;

            if(out_neighbors.length === 1) {
                /** Here we have two cases.
                 * 1) Loop is empty, out is connected.
                 * 2) Out is not connected, and start of loop is connected.*/
                log("Error: one of out ports of 'for' is not connected, check your flow!");
                log("Warning: execution will continue from start cell");
                resetExecution();
            }
            else if(out_neighbors.length === 2) {
                /** Two ports are connected, just go neighbors[0],
                 * e.g. to out.
                 * Ports are enumerated by order of their groups. */
                let links = graph.getConnectedLinks(current_cell, {outbound: true});

                for(let i=0; i<links.length; i++) {
                    let port_name = current_cell.getPort(links[i].attributes.source.port).name;
                    if(port_name.localeCompare('out') === 0){
                        let target_id = links[i].attributes.target.id;
                        let first_neighbor_id = out_neighbors[0].attributes.id;

                        if(target_id.localeCompare(first_neighbor_id) === 0) {
                            if (finish_cell === out_neighbors[0]) {
                                log("Error: finish cell inside a loop, check your flow!");
                                log("Warning: execution will continue from start cell");
                                resetExecution();
                                return;
                            }
                            else {
                                current_cell = out_neighbors[0];
                                return;
                            }
                        }
                        else
                        {
                            if (finish_cell === out_neighbors[1]) {
                                log("Error: finish cell inside a loop, check your flow!");
                                log("Warning: execution will continue from start cell");
                                resetExecution();
                                return;
                            }
                            else {
                                current_cell = out_neighbors[1];
                                return;

                            }
                        }
                    }
                }
            }
            else {
                /** No case where more than two outbound links can be*/
                log("Error: too much outbound links for command \"for\"!");
                log("Warning: execution will continue from start cell");
                resetExecution();
            }
        }


    }

    function moveToNextCommandFromOtherCell(res, out_neighbors) {
        if (out_neighbors.length === 1) {
            /** Case of a standard command with
             * one connected out port */

            /** Successor can be a finish cell*/
            if (finish_cell === out_neighbors[0]) {
                log("Finish cell reached during execution! Execution finished!");
                log("Tip: Execution can be continued from start cell");
                resetExecution();
            }
            else {
                /** Move to a next cell*/
                current_cell = out_neighbors[0];
            }
        }
        else {
            /** No case where more than one outbound links can be
             * for standard command! */
            log("Error: too much outbound links for command " +
                "\"" + code + "\"" + "!");
            log("Warning: execution will continue from start cell");
            resetExecution();
        }
    }

    function composeFlags(cell) {
        // Prepare flags of a command, remember that will be space in end of flags string
        let flags = "";
        flags += cell.attributes.input_flags.reduce(function (acc, flag_str, i) {
            if (i === cell.attributes.input_flags.length - 1) {
                acc += flag_str;
            }
            else {
                acc += (flag_str + " ");
            }
            return acc;
        }, "");
        return flags;
    }

    function composeParams(cell) {
        let params = "";
        let i = 0;
        for (let param in cell.attributes.input_params) {
            let keys = Object.keys(cell.attributes.input_params);
            if (i === keys.length - 1) {
                params += (cell.attributes.input_params[param]);
            }
            else {
                params += (cell.attributes.input_params[param] + ' ');
            }
            i++;
        }
        return params;
    }


    function resetExecution() {
        current_cell = start_cell;
        restoreEntryStatusOnForLoops();
    }

    function restoreEntryStatusOnForLoops() {
        let all_cells = graph.getCells(); // Including links

        for (let i = 0; i < all_cells.length; i++) {
            let graph_element = all_cells[i];

            /** Start and finish cells cannot have this status*/
            if (!(graph_element === start_cell) && !(graph_element === finish_cell)) {

                /** Avoid links, only cells*/
                if (graph_element.attributes.type.localeCompare("html.Element") === 0) {
                    graph_element.attributes.entered_first_time = true;
                }
            }
        }
    }


    function collectUserVariables() {
        let all_cells = graph.getCells(); // Including links

        for (let i = 0; i < all_cells.length; i++) {
            let graph_element = all_cells[i];

            /** Start and finish cells cannot have variables*/
            if (!(graph_element === start_cell) && !(graph_element === finish_cell)) {

                /** Avoid links, only cells*/
                if (graph_element.attributes.type.localeCompare("html.Element") === 0) {
                    let var_in_arr = graph_element.attributes.input_var_in.split("$");

                    /** Get only variables, not user string inputs*/
                    if (var_in_arr.length > 1 && var_in_arr[0].localeCompare("") === 0) {

                        /** Avoid reassignment of variables gotten from previous execution */
                        if (!Object.keys(user_variables).includes(var_in_arr[1])) {
                            user_variables[var_in_arr[1]] = "";
                        }
                    }

                    let var_out_arr = graph_element.attributes.input_var_out.split("$");

                    /** Get only variables, not user string inputs*/
                    if (var_out_arr.length > 1 && var_out_arr[0].localeCompare("") === 0) {

                        /** Avoid reassignment of variables gotten from previous execution */
                        if (!Object.keys(user_variables).includes(var_out_arr[1])) {
                            user_variables[var_out_arr[1]] = "";
                        }
                    }
                }
            }
        }
    }

</script>




