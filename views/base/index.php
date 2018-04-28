<!DOCTYPE html>
<html>
<head>
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

        /* Fake image */
        .fakeimg {
            background-color: #aaa;
            width: 100%;
            padding: 20px;
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
        .library_element{
            background-color: #c7ddef;
            color: #444;
            /*cursor: pointer;*/
            padding: 5px;
            width: 80%;
            border-bottom: 3px solid white;
            text-align: center;
            outline: none;
            font-size: 15px;
        }
        .canvas_element{
            background-color: #6f5499;
            color: #444;
            /*cursor: pointer;*/
            padding: 5px;
            width: 50%;
            border-bottom: 3px solid white;
            text-align: center;
            font-size: 22px;
            font-style: italic;
            margin: auto;

        }
         #div1 {
             width: 100%;
             height: 90%;
             padding: 20px;
             border: 1px solid #aaaaaa;
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
    <a href="#" style="float:right">FAQ</a>
</div>

<div class="row">
    <div class="leftcolumn">
        <div class="library_menu">
            <button class="accordion">Basic Commands</button>
            <div class="panel">
                <div class="library_element" id="le1" draggable="true" ondragstart="drag(event)">
                    <p>Some text 1</p>
                </div>
                <div class="library_element" id="le2" draggable="true" ondragstart="drag(event)">
                    <p>Some text 2</p>
                </div>
                <div class="library_element" id="le3" draggable="true" ondragstart="drag(event)">
                    <p>Some text 3</p>
                </div>
            </div>
            <button class="accordion">My Commands</button>
            <div class="panel">
                <div class="library_element">
                    <p>Some text 1</p>
                </div>
                <div class="library_element">
                    <p>Some text 2</p>
                </div>
                <div class="library_element">
                    <p>Some text 3</p>
                </div>
            </div>
            <button class="accordion">Amdocs Special</button>
            <div class="panel">
                <div class="library_element">
                    <p>Some text 1</p>
                </div>
                <div class="library_element">
                    <p>Some text 2</p>
                </div>
                <div class="library_element">
                    <p>Some text 3</p>
                </div>
            </div>
        </div>
        <script>
            var acc = document.getElementsByClassName("accordion");
            var i;

            for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                    this.classList.toggle("active");
                    var panel = this.nextElementSibling;
                    if (panel.style.maxHeight){
                        panel.style.maxHeight = null;
                    } else {
                        panel.style.maxHeight = panel.scrollHeight + "px";
                    }
                });
            }
        </script>
    </div>
    <div class="rightcolumn">
        <div class="canvas" id="can" ondrop="drop(event)" ondragover="allowDrop(event)">
        </div>
    </div>
    <script>
        function allowDrop(ev) {
            ev.preventDefault();
        }

        function drag(ev) {
            ev.dataTransfer.setData("text", ev.target.id);
        }

        function drop(ev) {
            ev.preventDefault();
            var data=ev.dataTransfer.getData("text");
            var innerText = document.getElementById(data).innerText;
            var copy = document.createElement("div");
            copy.setAttribute("class", "canvas_element");
            copy.innerText = innerText;
            ev.target.appendChild(copy);
        }
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

