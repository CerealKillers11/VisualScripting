<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="jquery-ui.min.css">
    <script src="external/jquery/jquery.js"></script>
    <script src="jquery-ui.min.js"></script>
    <style>
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0 0 10px;
        }

        li {
            margin: 5px;
            padding: 5px;
            width: 200px;
        }
    </style>
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
    </style>
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

        /* Footer */
        .footer {
            padding: 20px;
            text-align: center;
            background: #ddd;
            margin-top: 20px;
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

        .active:after {
            content: "\2212";
        }

        .active, .accordion:hover {
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
</head>
<body>

<div class="header">
    <h1>Amdocs Project</h1>
</div>

<div class="topnav">
    <a href="#">Home</a>
    <a href="#">Build</a>
    <a href="#">Save</a>
    <a href="#">Add Command</a>
    <a href="#">FAQ</a>
    <a href="#"  style="float:right">Log out</a>
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
                <div class="canvas_element" name="available space">available space</div>
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

<div class="footer">
    <h2>Footer</h2>
</div>
<?php
/* @var $this yii\web\View */
?>
</body>
</html>

