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
        <div class="col-sm-1">

            <?php $form = ActiveForm::begin(['id' => 'input-flow-form',
                'fieldConfig' => ['enableLabel'=>false], // Do not show the labels in view
                'action' => 'index.php?r=amdocs-app%2Fexecute', //TO-DO pretty urls
                'method' => 'post',
            ]); ?>

            <?= Html::submitButton('Execute', ['class' => 'btn btn-primary',
                'name' => 'execute-button',
                ]) ?>

            <script>

                // Real execution of commands done on server.
                // We need to save the flow graph during execution.
                // So the per-command execution is done via ajax.

                $(document).ready(function () {
                    $("#input-flow-form").on('beforeSubmit', function () {


                        // Collecting user variables - better to define them at start of a script
                        // and change them on-demand during the flow.
                        let user_variables = collectUserVariables();

                        // Start may not be either connected
                        if (!checkStartConnected()) return false;

                        // Starting to build the script.
                        let script = buildScript(user_variables);

                        // Script can be empty, e.g. Start just connected to Finish.
                        if(script.localeCompare("")==0) {
                            log("build: Script cannot be empty. Aborting build.")
                            alert("Script cannot be empty.");
                            return false;
                        }

                        $.ajax({
                            url: 'index.php?r=amdocs-app%2Fexecute',
                            type: 'POST',
                            data: 'script='+script, //POST-style
                            success: function(res){
                                console.log(res);
                            },
                            error: function(){
                                alert('Error!');
                            }
                        });
                        return false;

                    });
                });


                function setUserFlowToForm() {

                    // TO-DO :
                    // Implement check if finish is reachable.


                    // Collecting user variables - better to define them at start of a script
                    // and change-on-demand during the flow.
                    let user_variables = collectUserVariables();

                    // Start may not be either connected
                    if (!checkStartConnected()) return false;

                    // Starting to build the script.
                    let script = buildScript(user_variables);

                    // Script can be empty, e.g. Start just connected to Finish.
                    if(script.localeCompare("")==0) {
                        log("build: Script cannot be empty. Aborting build.")
                        alert("Script cannot be empty.");
                        return false;
                    }


                    document.getElementById('inputflowform-flow').setAttribute('value',script);
                }


                function checkStartConnected() {
                    let start_cell_successors = graph.getSuccessors(start_cell);
                    if(start_cell_successors.length === 0) {
                        log("build: Start must be connected. Aborting build.");
                        alert("Start must be connected.")
                        return false;
                    }
                    return true;
                }

                function buildScript(user_variables) {
                    let script = "#!/bin/bash" + "\n" + "\n";

                    script = setUserVariablesToDefaults(script, user_variables);

                    // During building we'll construct pipeline flows
                    // which may be outputted to variables.
                    let pipeline_flow = "";

                    let current_cell = graph.getSuccessors(start_cell)[0];
                    while(!(current_cell === finish_cell)) {

                        // Prepare code of a command
                        let code = current_cell.attributes.input_command_code;

                        // If command is a for, need to prepare it well and build



                        // Prepare flags
                        let flags = composeFlags(current_cell);

                        // Achieve params from associative array
                        let params = composeParams(current_cell);

                        // Compose the command string
                        let current_command_string = code;
                        if(flags.localeCompare("")!=0){
                            current_command_string+= (' ' + flags);
                        }
                        if(params.localeCompare("")!=0){
                            current_command_string+= (" " + params);
                        }

                        // Since we use redirecting of input/output,
                        // we must consider when commands must be pipelined,
                        // when they must be redirected to variable,
                        // and when the variable is used as input value.

                        // let input = current_cell.attributes.input_var_in;
                        // let output = current_cell.attributes.input_var_out;
                        //
                        // if(isVariable(input,user_variables) && isVariable(output,user_variables)) {
                        //     // Building assignment to a variable
                        //     // Do not forget that variable stored with prefix.
                        //     script += (output.split("$")[1] + "=$(echo \"" + input  + "\" | " + current_command_string + " )\n");
                        // }
                        // else if(!isVariable(input,user_variables) && isVariable(output,user_variables)) {
                        //     // Input is not a variable, but output is a variable.
                        //     // Two cases regarding input:
                        //
                        //     // Empty string - pipeline output from previous command to input of current.
                        //     // Here ends the flow of a pipeline
                        //
                        //     // Otherwise,
                        // }
                        // else if(isVariable(input,user_variables) && !isVariable(output,user_variables)) {
                        //     // Input is a variable but output isn't.
                        //     // It means that input variable starts the pipeline which continues to next command.
                        // }
                        // else {
                        //     // Input and output are not variables.
                        //     // Expected to be a command starting pipeline or in a middle of a pipeline.
                        // }
                        //
                        //
                        //
                        //
                        //
                        //
                        //





                        script += (current_command_string + "\n");

                        let current_cell_successors = graph.getSuccessors(current_cell);

                        if(current_cell_successors.length === 0) {
                            // A case when flow does not connected to finish cell
                            log("build: Every flow must end at Finish cell. Aborting build.")
                            alert("Every flow must end at Finish cell.");
                            return false;
                        }
                        current_cell = current_cell_successors[0];
                    }
                    // Now we reached the finish cell
                    return script;
                }


                // Script build's helper functions.
                //-----------------------------------------

                function setUserVariablesToDefaults(script, variables) {
                    let i=0;
                    for(i;i<variables.length;i++) {
                        script += variables[i] + "= \n";
                    }
                    return script;
                }

                function composeFlags(cell) {
                    // Prepare flags of a command, remember that will be space in end of flags string
                    let flags = "";
                    flags += cell.attributes.input_flags.reduce(function (acc,flag_str,i) {
                        if(i===cell.attributes.input_flags.length-1){
                            acc += flag_str;
                        }
                        else{
                            acc += (flag_str + " ");
                        }
                        return acc;
                    },"");
                    return flags;
                }

                function composeParams(cell) {
                    let params = "";
                    let i=0;
                    for(param in cell.attributes.input_params){
                        if(i===cell.attributes.input_params.keys().length-1){
                            params += (cell.attributes.input_params[param]);
                        }
                        else{
                            params += (cell.attributes.input_params[param] + ' ');
                        }
                    }
                    return params;
                }

                function collectUserVariables() {
                    let user_variables = [];
                    let all_cells = graph.getCells(); // Including links

                    for(i = 0; i < all_cells.length; i++) {
                        let graph_element = all_cells[i];
                        if( !(graph_element === start_cell) && !(graph_element === finish_cell) ) {
                            if(graph_element.attributes.type.localeCompare("html.Element") == 0 ) {
                                let var_in_arr = graph_element.attributes.input_var_in.split("$");
                                if(var_in_arr.length > 1 && var_in_arr[0].localeCompare("")==0) {
                                    user_variables.push(var_in_arr[1]);
                                }

                                let var_out_arr = graph_element.attributes.input_var_out.split("$");
                                if(var_out_arr.length > 1 && var_out_arr[0].localeCompare("")==0) {
                                    user_variables.push(var_out_arr[1]);
                                }
                            }
                        }
                    }
                    return user_variables;
                }

                function isVariable(s,vars) {
                    let i=0;
                    for(i;i<vars.length;i++) {
                        if (("$" + vars[i]).localeCompare(s) == 0) {
                            return true;
                        }
                    }
                    return false;
                }


                //-----------------------------------------


            </script>

            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-sm-2">
            <?= Html::button('Save', ['id' => 'save-button',
                'class' => 'btn btn-primary']); ?>
        </div>
        <div class="col-lg-1">
            <p>
                Execution path:
            </p>
        </div>

        <div class="col-sm-1">
            <input id="execution_path" type="text" value="<?php echo getcwd(); ?>" size="80">
        </div>

    </div>
    <div class="row">
        <div class="leftcolumn">
            <div class="library_menu" style="height: 600px;" >
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
                            <?=Html::encode("{$command->name}"); ?>
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
                            <?=Html::encode("{$command->name}"); ?>
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
                            <?=Html::encode("{$command->name}"); ?>
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

            // Firstly, achieve the transferred command parameters.
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
            let splitted_params = [];
            if(!(command_parameters.localeCompare('') == 0)){

                // Parse parameters. Divided with '$'.
                splitted_params = command_parameters.split("$");
                let i;
                for(i=1; i<splitted_params.length; i++) {
                    parameters_str_arr.push(
                        splitted_params[i] + ":" + '<input type="text" name=\"' + splitted_params[i] + '\" value=\"\" ></input>');
                    parameters_str_arr.push('<br/>');
                }
            }

            // Do inherit from base html element to create our custom.
            // -------------------------------------------------------------------------

            joint.shapes.html = {};
            joint.shapes.html.Element = joint.shapes.devs.Model.extend({
                defaults: joint.util.deepSupplement({
                    type: 'html.Element',
                    attrs: {
                        rect: { stroke: 'none', 'fill-opacity': 0 }
                    }
                }, joint.shapes.devs.Model.prototype.defaults),

            });

            // Create a custom view for that element that displays an HTML div above it.
            // -------------------------------------------------------------------------


            // Template string can vary depending on command, e.g. 'for' and 'if'.
            // -------------------------------------------------------------------------

            let template_str = '';

            if(command_name.localeCompare('for') == 0) { // For loop have no input and output variables
                template_str =
                ([  '<div class="html-element">',
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
            else if(command_name.localeCompare('if') == 0) { // Input is condition, output is true/false
                template_str =
                ([  '<div class="html-element">',
                    '<button class="delete">x</button>',
                    '<button class="btn-info">i</button>',
                    '<label></label>',
                    '<span></span>',
                    '<br/>'].concat(
                        flags_str_arr.concat(
                            parameters_str_arr.concat(
                                ['------------------------------------',
                                    '<input name="output_variable" type="text" value="$(out)">']
                            )
                        )
                    )
                ).join('');
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
            }

            joint.shapes.html.ElementView = joint.dia.ElementView.extend({

                template: template_str,

                initialize: function() {
                    _.bindAll(this, 'updateBox');
                    joint.dia.ElementView.prototype.initialize.apply(this, arguments);

                    this.$box = $(_.template(this.template)());
                    // Prevent paper from handling pointerdown.
                    this.$box.find('input,select').on('mousedown click', function(evt) {
                        evt.stopPropagation();
                    });
                    // Reacting on the input change and storing the input data in the cell model.
                    this.$box.find('input').on('change', _.bind(function(evt) {

                        // We need to listen on user changes of html elements and save
                        // the data inside a model, for future building the script.

                        // Array of all inputs, include checkboxes.
                        let user_inputs_array = $.makeArray(this.$box.find('input'));

                        // First one is always input variable and last one is output variable.
                        // But not in case we dealing with 'for' or 'if'
                        if(command_name.localeCompare('for')==0){
                            let input_params = user_inputs_array.reduce(function (acc,input,i) {
                                if(input.type.localeCompare('text') == 0){
                                    acc[input.defaultValue] = input.value;
                                }
                                return acc;
                            }, [] );
                            this.model.set('input_params',input_params);

                        }
                        else if(command_name.localeCompare('if')==0){
                            let output_variable = user_inputs_array[user_inputs_array.length - 1].value;
                            let input_params = user_inputs_array.reduce(function (acc,input,i) {
                                if(i!==user_inputs_array.length-1 && input.type.localeCompare('text') == 0){
                                    acc[input.defaultValue] = input.value;
                                }
                                return acc;
                            }, [] );
                            this.model.set('input_var_out',output_variable);
                            this.model.set('input_params',input_params);

                        }
                        else {
                            let input_variable = user_inputs_array[0].value;
                            let output_variable = user_inputs_array[user_inputs_array.length - 1].value;

                            let checked_checkboxes = user_inputs_array.reduce(function (acc,input) {
                                if (input.type.localeCompare('checkbox') == 0 && input.checked) {
                                    acc.push(input.name);
                                }
                                return acc;
                            }, [] );
                            let input_params = user_inputs_array.reduce(function (acc,input,i) {
                                if(i!==0 && i!==user_inputs_array.length-1 && input.type.localeCompare('text') == 0){
                                    acc[input.defaultValue] = input.value;
                                }
                                return acc;
                            }, [] );

                            this.model.set('input_var_in',input_variable);
                            this.model.set('input_var_out',output_variable);
                            this.model.set('input_flags',checked_checkboxes);
                            this.model.set('input_params',input_params);
                        }

                        // Reacting on saving data to model with green border.
                        this.$box.css({
                            borderStyle: 'solid',
                            borderColor: 'green'
                        });
                    }, this));

                    // Command code is one of prerequisite to build and run
                    this.model.set('input_command_code',command_code);

                    // Setting the default parameter values
                    this.model.set('input_var_in',"");
                    this.model.set('input_var_out',"");

                    // Setting all command params be empty string by default
                    let default_params = splitted_params.reduce(function (acc,param,i) {
                        if(i===0) return acc; // Avoid empty string caused by first $ at param string from db
                        acc[param]="";
                        return acc;
                    },[]);
                    this.model.set('input_params',default_params);

                    // No one of flags is checked at start
                    this.model.set('input_flags',[]);


                    // Reacting on the keypress as unsaved data - red border.
                    this.$box.find('input').on('keypress', _.bind(function(evt) {
                        this.$box.css({
                            borderStyle: 'solid',
                            borderColor: 'red'
                        });
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

            // Vary box sizes depending on command parameters.
            // -----------------------------------------------------------

            let additionalHeight = (flags_str_arr.length-1)*15 + (parameters_str_arr.length-1)*15 + 160;

            // Create JointJS elements and add them to the graph as usual.
            // -----------------------------------------------------------

            if(command_name.localeCompare('if') == 0){
                let if_element = new joint.shapes.html.Element({
                    position: { x:20, y: 20 },
                    size: {
                        width: 190,
                        height: 20 + additionalHeight
                    },
                    inPorts: ['in'],
                    outPorts: ['out(true)','out(false)'],
                    ports: {
                        groups: {
                            'in': {
                                position: 'top',
                                attrs: {
                                    '.port-body': {
                                        fill: '#16A085'
                                    }
                                },
                                label: {
                                    position: {
                                        name: 'right',
                                        args: { y: -10 } // extra arguments for the label layout function, see `layout.PortLabel` section
                                    }
                                }
                            },
                            'out': {
                                position: 'bottom',
                                attrs: {
                                    '.port-body': {
                                        fill: '#E74C3C'
                                    }
                                }
                            }
                        }
                    },
                    label: event.dataTransfer.getData("command_name"),
                });

                if_element.addTo(graph);
            }
            else if(command_name.localeCompare('for') == 0){
                let for_element = new joint.shapes.html.Element({
                    position: { x:20, y: 20 },
                    size: {
                        width: 190,
                        height: 70
                    },
                    inPorts: ['in'],
                    outPorts: ['loop','continue'],
                    ports: {
                        groups: {
                            'in': {
                                position: 'top',
                                attrs: {
                                    '.port-body': {
                                        fill: '#16A085'
                                    }
                                },
                                label: {
                                    position: {
                                        name: 'right',
                                        args: { y: -10 } // extra arguments for the label layout function, see `layout.PortLabel` section
                                    }
                                }
                            },
                            'out': {
                                position: 'bottom',
                                attrs: {
                                    '.port-body': {
                                        fill: '#E74C3C'
                                    }
                                }
                            }
                        }
                    },
                    label: event.dataTransfer.getData("command_name"),
                });

                for_element.addTo(graph);
            }
            else{
                let command_element = new joint.shapes.html.Element({
                    position: { x:20, y: 20 },
                    size: {
                        width: 190,
                        height: 70 + additionalHeight
                    },
                    inPorts: ['in'],
                    outPorts: ['out'],
                    ports: {
                        groups: {
                            'in': {
                                position: 'top',
                                attrs: {
                                    '.port-body': {
                                        fill: '#16A085'
                                    }
                                },
                                label: {
                                    position: {
                                        name: 'right',
                                        args: { y: -10 } // extra arguments for the label layout function, see `layout.PortLabel` section
                                    }
                                }
                            },
                            'out': {
                                position: 'bottom',
                                attrs: {
                                    '.port-body': {
                                        fill: '#E74C3C'
                                    }
                                }
                            }
                        }
                    },
                    label: event.dataTransfer.getData("command_name"),
                });
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


    // Override dia.Link class for enabling to see the arrow cursor and disable double marking.
    joint.dia.Link = joint.dia.Link.extend({
        defaults: joint.util.deepSupplement({
            type: 'dia.Link',
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
            router: { name: 'manhattan' },

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
        snapLinks: { radius: 50 },

        validateConnection: function(cellViewS, magnetS, cellViewT, magnetT, end, linkView) {
            // Prevent linking from input ports.
            if (magnetS && magnetS.getAttribute('port-group') === 'in') return false;
            // Prevent linking from output ports to input ports within one element.
            if (cellViewS === cellViewT) return false;

            // Prevent linking to input ports which are already linked.
            // var links = graph.getConnectedLinks(cellViewT.model, { inbound: true });
            // if(links.length > 0) return false;

            // Prevent linking from input ports.
            return magnetT && magnetT.getAttribute('port-group') === 'in';
        },

        validateMagnet: function(cellView, magnet) {
            // Prevent links from ports that already have a link
            var port = magnet.getAttribute('port');
            var links = graph.getConnectedLinks(cellView.model, { outbound: true });
            var portLinks = _.filter(links, function(o) {
                return o.get('source').port == port;
            });
            if(portLinks.length > 0) return false;
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

    var start_cell = new joint.shapes.devs.Model({
        size: {
            width: 90,
            height: 30
        },
        outPorts: ['out'],
        ports: {
            groups: {
                'out': {
                    position: 'bottom',
                    attrs: {
                        '.port-body': {
                            fill: '#E74C3C'
                        },
                    }
                }
            }
        },
        attrs: {
            '.label': { text: 'Start', fill: 'black',  'ref-y': 5},
            rect: { fill: 'orange' }
        }
    });

    start_cell.position(350, 30);
    graph.addCell(start_cell);

    var finish_cell = new joint.shapes.devs.Model({
        size: {
            width: 90,
            height: 30
        },
        inPorts: ['in'],
        ports: {
            groups: {
                'in': {
                    position: 'top',
                    attrs: {
                        '.port-body': {
                            fill: '#16A085',
                            magnet: 'passive'
                        },
                    },
                    label: {
                        position: {
                            name: 'right',
                            args: { y: -10 } // extra arguments for the label layout function, see `layout.PortLabel` section
                        }
                    },
                },
            }
        },
        attrs: {
            '.label': { text: 'Finish', fill: 'black',  'ref-y': 15 },
            rect: { fill: 'orange' }
        }
    });
    finish_cell.position(350, 400);
    finish_cell.addTo(graph);

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
    log("This is log!");

</script>


<?php
$this->registerJs( <<< EOT_JS_CODE

    $('input-flow-form').on('beforeSubmit', function(){
    alert('Работает!');
    return false;
    }); 

EOT_JS_CODE
);
?>
