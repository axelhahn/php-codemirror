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


// ----------------------------------------------------------------------
// generate content
// ----------------------------------------------------------------------



$sModes='<table><tr><th>Mode</th><th>Loaded languages</th><th>Mimetype</th></tr>';
foreach($codemirror->getModes(true) as $sMode=>$aOptions){
    // $sModes.="<strong>$sMode</strong> - ".print_r($aOptions, true)."<br>";

    if (!is_array($aOptions)) {
        $aOptions = [];
    }
    $aOptions['load'] = $aOptions['load'] ?? [];
    $aOptions['mode'] = $aOptions['mode'] ?? '';
    
    $sModes.="<tr>
        <td><strong>$sMode</strong></td>
        <td>".implode(", ", $aOptions['load'])."</td>
        <td>".(string) $aOptions['mode']."</td>
    </tr>";
}
$sModes.='</table>';

$sSnippet = "<?php 
\$sBody .= \$codemirror->addTextarea(
  [
    'id' => 'id-".uniqid()."',
    'class' => 'highlight-<mode>', // <<< set a class 'highlight-<mode>' here
    'value' => '<code-snippet-here>',
  ],
  [
    'theme' => 'eclipse',
    'readOnly' => true,
  ],
);
";

$textarea=$codemirror->addTextarea(
    [
        'id' => 'id-'.uniqid(),
        'class' => 'highlight-php',
        'value' => $sSnippet,
    ],
    [
        'theme' => null,
        'readoOnly' => false,
    ],
);

// ----------------------------------------------------------------------
// output
// ----------------------------------------------------------------------

showPage(
    "<title>CodeMirror - demo - Modes</title>"
        .$codemirror->getHtmlHead()
    , 
    "
        <h1>Demo :: Modes</h1>
        <a class=\"btn\" href=\"index.php\">&laquo; back</a><br>
        <p>
            A mode value describes the type of a file that a syntax highlight can be applied.<br>
            You need to set a class named 'higlight-<strong>&lt;mode></strong>' on the textarea (other classes you can apply a well).<br>
            <br>
            $textarea
            <br>
            The following modes are currently implemented:<br>
            $sModes
            <br>
            This is not feature complete yet. Check <a href=\"https://codemirror.net/5/mode/index.html\">https://codemirror.net/5/mode/index.html</a>
        </p>

        $htmlbody

        ".$codemirror->getJs()
);