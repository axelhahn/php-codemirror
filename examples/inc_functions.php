<?php


/**
 * Get html code of executed html code
 * 
 * @param object $codemirror
 * @param string $sPhpcode
 * @return string
 */
function getOutput(&$codemirror, string $sPhpcode): string{
    $sOut = '';

    eval("\$sOut=$sPhpcode;");
    return $sOut;
}


function showCode(&$codemirror, string $sCode, string $sVal): string
{
    $id="snippet".uniqid();
    if(!$codemirror) {
        die("codemirror not known");
    }
    $sSourcecode = 
        $codemirror->addTextarea(
            [
                'id' => $id,
                'class' => 'highlight-php',
                'value' => "<?php \n". $sCode
            ],
            [
                'theme' => null,
                'readOnly' => true,
            ]
        )
        ;
    $sSourcecode=str_replace($sVal, "<code-snippet-here>", $sSourcecode);
    $sOutput = getOutput($codemirror, $sCode);

    return "<table class=\"snippet\">
        <tr>
            <th>Sourcecode</th>
            <th>Output</th>
        </tr>
        <tr>
            <td>$sSourcecode</td>
            <td>$sOutput</td>
        </tr>
    </table>";
}

function showPage(string $sHeader, string $sBody): void 
{
    if(strstr($_SERVER['REQUEST_URI'], 'index.php')) {
        $nav="";
    } else {
        $nav="<a class=\"btn\" href=\"index.php\">&laquo; back</a>";
    }
    $toHome="<a class=\"btn\" href=\"index.php\">&laquo; back</a><br>";
    echo <<<HTML
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">

        {$sHeader}

    </head>
    <body>
        <main>
            {$sBody}
        </main>

        <footer>
            👤 Author: Axel Hahn<br>
            📄 Source: <a href="https://github.com/axelhahn/php-codemirror">https://github.com/axelhahn/php-codemirror</a><br>
            📜 License: GNU GPL 3.0<br>
        </footer>

    </body>
</html>
HTML;
}
