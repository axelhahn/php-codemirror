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
        'language' => 'php',
        'info' => 'Highlighter for PHP',
        'theme' => 'mdn-like',
        'content' => '<?php 
echo "Hello World"; 
?>',
    ],
    // ------------------------------------------------------------
    [
        'language' => 'htmlmixed',
        'info' => 'Mixed highlighter for HTML, CSS and JS',
        'theme' => 'ayu-mirage',
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

    $sIdTextarea='textarea-'.$aDemo['language'];

    $htmlbody.='
        <h2>'.$aDemo['language'].'</h2>
        <p>
            '.$aDemo['info'].'<br>
            Theme: '.$aDemo['theme'].'
        </p>'
        . showCode(
            $codemirror, 
            // "<?php \n"
            "\$codemirror->addTextarea(\n"
            ."  [\n"
            ."    'id' => '$sIdTextarea',\n"
            ."    'class' => 'highlight-$aDemo[language]', // <<< set a class 'highlight-<language>' here\n"
            ."    'value' => '$aDemo[content]',\n"
            // ."    'value' => '<your-code-snippet-here>'\n"
            ."  ],\n"
            ."  [\n"
            ."    'theme' => ".(($aDemo['theme']??null) ? "'$aDemo[theme]'" : "null") .",\n"
            ."    'readonly' => true,\n"
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
    "<title>CodeMirror - demo</title>"
        .$codemirror->getHtmlHead()
    , 
    "
        <h1>Php CodeMirror class :: Demo 1</h1>
        <p>
            This demo embeds multiple textareas with different languages.<br>
            By adding Codemirror to the page, the content of the textarea is highlighted.<br>
        </p>

        $htmlbody
        ".$codemirror->getJs()
);