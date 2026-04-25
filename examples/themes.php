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
        'language' => 'htmlmixed',
        'info' => 'Mixed highlighter for HTML, CSS and JS',
        // 'theme' => 'ayu-mirage',
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

$sThemeoptions='';
$sThemeoptions.="<option value=\"\">default</option>";
foreach($codemirror->getThemes() as $sTheme){
    $sThemeoptions.="<option value=\"$sTheme\" ".($_GET['theme']==$sTheme?'selected="selected"':'').">$sTheme</option>";
}

foreach($aDemos as $aDemo){

    $sIdTextarea='id-'.uniqid();

    $htmlbody.='
        <h2>Themes with an example of "'.$aDemo['language'].'"</h2>
        <p>'
            .$aDemo['info'].'<br>
            The selected theme is <strong>'.($_GET['theme']??'').'</strong><br>
        </p>

        <form method="GET" action="?">
            Select a theme:<br>
            <select name="theme" onchange="this.form.submit();" size="10">
                '.$sThemeoptions.'
            </select>
        </form>
        <br>

        <div>
        '
        . showCode(
            $codemirror, 
            "\$codemirror->addTextarea(\n"
            ."  [\n"
            ."    'id' => '$sIdTextarea',\n"
            ."    'class' => 'highlight-$aDemo[language]',\n"
            // ."    'value' => '$aDemo[content]'\n"
            ."    'value' => '$aDemo[content]',\n"
            ."  ],\n"
            ."  [\n"
            ."    'theme' => ".(($_GET['theme']??null) ? "'$_GET[theme]'" : "null") .", // <<< set your theme here\n"
            ."    'readonly' => true,\n"
            ."  ],\n"
            .");\n",
            $aDemo['content']
        )

        .'</div>'
        ;
}

// ----------------------------------------------------------------------
// output
// ----------------------------------------------------------------------

showPage(
    "<title>CodeMirror - demo - themes</title>"
        .$codemirror->getHtmlHead()
    , 
    "
        <h1>Demo :: Themes</h1>
        <a class=\"btn\" href=\"index.php\">&laquo; back</a><br>
        <p>
            This demo embeds multiple textareas with different languages.<br>
            By adding Codemirror to the page, the content of the textarea is highlighted.<br>
        </p>

        $htmlbody
        ".$codemirror->getJs()
);