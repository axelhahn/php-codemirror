<?php

declare(strict_types=1);

// ----------------------------------------------------------------------
// init
// ----------------------------------------------------------------------

$htmlbody='';

require_once __DIR__.'/../classes/cm-helper.class.php';
$codemirror=new cmhelper();

include "inc_functions.php";

// ----------------------------------------------------------------------
// config
// ----------------------------------------------------------------------


$aDemos=[
    // ------------------------------------------------------------
    [
        'mode' => 'php',
        'info' => 'Highlighter for PHP',
        'theme' => 'rubyblue',
        'content' => '<?php 
echo "Hello World"; 
?>',
    ],
    // ------------------------------------------------------------
    [
        'mode' => 'htmlmixed',
        'info' => 'Mixed highlighter for HTML, CSS and JS',
        'theme' => 'abcdef',
        'content' => '<!DOCTYPE html>
<html>
    <head>
        <script>
            function hello(s){
                console.log("Hello "+s);
            }

            hello("World");
        </script>
        <style>
            *{
                font-family: sans-serif;
                font-size: 1.0em;
            }
        </style>
    </head>
    <body>
        <h1>Hello world!</h1>
    </body>
</html>
            ',
    ],
];

// ----------------------------------------------------------------------
// generate content
// ----------------------------------------------------------------------

foreach($aDemos as $aDemo){

    $sIdTextarea='id-'.uniqid();

    $htmlbody.='
        <h2>'.$aDemo['mode'].'</h2>
        <p>
            '.$aDemo['info'].'<br>
            Theme: <strong>'.$aDemo['theme'].'</strong><br>
        </p>'
        . showCode(
            $codemirror, 
            // "<?php \n"
            "\$codemirror->addTextarea(\n"
            ."  [\n"
            ."    'id' => '$sIdTextarea',\n"
            ."    'class' => 'highlight-$aDemo[mode]', // <<< set a class 'highlight-<mode>' here\n"
            ."    'value' => '$aDemo[content]',\n"
            // ."    'value' => '<your-code-snippet-here>'\n"
            ."  ],\n"
            ."  [\n"
            ."    'theme' => ".(($aDemo['theme']??null) ? "'$aDemo[theme]'" : "null") .",\n"
            ."    'readOnly' => true,\n"
            ."  ],\n"
            .");\n",
            $aDemo['content']
        )
        ;
}

// ----------------------------------------------------------------------
// output
// ----------------------------------------------------------------------

showPage(
    "<title>CodeMirror - demo - multiple instances</title>"
        .$codemirror->getHtmlHead()
    , 
    "
        <h1>Demo :: Multiple instances</h1>
        <a class=\"btn\" href=\"index.php\">&laquo; back</a><br>
        <p>
            This demo embeds multiple textareas with syntax highlighting for different languages.<br>
            By adding Codemirror to the page, the content of the textarea is highlighted.<br>
        </p>

        $htmlbody
        ".$codemirror->getJs()
);