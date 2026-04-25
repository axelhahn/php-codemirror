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

        <ul>
            <li><a href=\"demo1.php\">Demo 1</a> - Shows 2 Codemirror instances with different themes and different syntax highlighters<br></li>
            <li><a href=\"demo2.php\">Demo 2</a> - Show available themes and test it on htmlmixed mode example.<br></li>
        </ul>
    "
);