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

$sThemeParam=preg_replace('/[^a-zA-Z0-9\-]/', '', (string) ($_GET['theme']??''));
$sThemeParam=$sThemeParam ? $sThemeParam : "default";

$sPrevTheme=(string) array_last($codemirror->getThemes());
$sCurrentTheme='';
$sNextTheme='';

$sThemeoptions='';
foreach(array_merge(['default'], $codemirror->getThemes()) as $sTheme){
    $bSelected=false;
    if(($sThemeParam??'')===$sTheme ) {
        $bSelected=true;
        $sCurrentTheme = $sThemeParam;
    }
    $sPrevTheme=$sCurrentTheme ? $sPrevTheme : (string) $sTheme;
    $sNextTheme=($sCurrentTheme && !$bSelected && !$sNextTheme) ? (string) $sTheme : $sNextTheme;

    $sThemeoptions.="<option value=\"$sTheme\" ".($bSelected?'selected="selected"':'').">$sTheme</option>";
}

foreach($aDemos as $aDemo){

    $sIdTextarea='id-'.uniqid();

    $htmlbody.='
        <h2>Themes with an example of "'.$aDemo['language'].'"</h2>
        <p>'
            .$aDemo['info'].'<br>
            The selected theme is <strong>"'.$sThemeParam.'"</strong><br>
        </p>

        <form method="GET" action="?">
            Select a theme:<br>
            <br>
            <select name="theme" onchange="this.form.submit();" size="10" style="float: left;;">
                '.$sThemeoptions.'
            </select>
            <a class="btn btn-theme" href="?theme='.$sPrevTheme.'"> 🔼 '.$sPrevTheme.'</a> <br>
            <a class="btn btn-theme" href="?theme='.$sNextTheme.'"> 🔽 '.$sNextTheme.'</a>
            <div style="clear: both;"></div>
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
            ."    'theme' => ".($sThemeParam ? "'$sThemeParam'" : "null") .", // <<< set your theme here\n"
            ."    'readOnly' => true,\n"
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
    "<title>CodeMirror - demo - Themes</title>"
        .$codemirror->getHtmlHead()
    , 
    "
        <h1>Demo :: Themes</h1>
        <a class=\"btn\" href=\"index.php\">⬅️ back</a><br>
        <p>
            This demo embeds multiple textareas with different languages.<br>
            By adding Codemirror to the page, the content of the textarea is highlighted.<br>
        </p>

        $htmlbody
        
        ".$codemirror->getJs()
);