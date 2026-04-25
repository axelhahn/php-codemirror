<?php

declare(strict_types=1);
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
            Welcome to the CodeMirror Demos.
        </p>

        <h2>Demos</h2>

        <h3>Multiple instances</h3>
        <blockquote>
        <p>
            Display CodeMirror on your page.<br>
            You can use multiple CodeMirror instances on your page. So you can mix different themes and syntax highlighters.<br>
            <a class=\"btn\" href=\"multiple-instances.php\">Multiple instances</a>
        </p>
        </blockquote>

        <h3>Available themes</h3>
        <blockquote>
        <p>
            Codemirror has several themes you can select from.<br>
            <a class=\"btn\" href=\"themes.php\">Try the themes</a>
        </p>
        </blockquote>
    "
);