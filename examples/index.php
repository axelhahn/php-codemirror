<?php

declare(strict_types=1);
ini_set('display_errors', '1');
error_reporting(E_ALL);

include "inc_functions.php";

// ----------------------------------------------------------------------
// output
// ----------------------------------------------------------------------

showPage(
    "<title>CodeMirror - demo</title>"
    ,
    "
        <h1>Php CodeMirror class</h1>
        
        <p>
            Welcome to the CodeMirror Demos.<br>
            Axel wrote this class to show and edit code snippets with syntax highlighting.<br>
        </p>

        <h2>Demos</h2>

        <h3>Let's dive in</h3>
        <blockquote>
        <p>
            Let's get a first impression.<br>
            We want to display a code snippet on our web page - and use syntax highlighting.<br>
            Yep, no problem.<br>
            <br>
            And we want to use multiple instances on your page. You can mix different themes and syntax highlighters as well.<br>
            <a class=\"btn\" href=\"multiple-instances.php\">▶️ Show me</a>
        </p>
        </blockquote>

        <h3>Available themes</h3>
        <blockquote>
        <p>
            Codemirror has several themes you can select from.<br>
            <a class=\"btn\" href=\"themes.php\">🎨 Try the themes</a>
        </p>
        </blockquote>

        <h3>Available modes</h3>
        <blockquote>
        <p>
            A few syntax highlight modes were added<br>
            <a class=\"btn\" href=\"modes.php\">🗂️ See the modes</a>
        </p>
        </blockquote>
    "
);