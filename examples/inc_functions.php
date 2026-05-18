<?php

declare(strict_types=1);

/**
 * Get html code of executed html code
 * 
 * @param cmhelper $codemirror
 * @param string $sPhpcode
 * @return string
 */
function getOutput(cmhelper &$codemirror, string $sPhpcode): string{
    $sOut = '';

    eval("\$sOut=$sPhpcode;");
    return $sOut;
}

/**
 * Show a code snippet with source code and output
 * @param cmhelper $codemirror cmhelper instance
 * @param string $sCode      code to render in codemirror textarea
 * @param string $sVal       code snippet to highlight
 * @return string
 */
function showCode(cmhelper &$codemirror, string $sCode, string $sVal): string
{
    $id="snippet".uniqid();
    $sSourcecode = (string) $codemirror->addTextarea(
            [
                'id' => $id,
                'class' => 'highlight-php',
                'value' => "<?php \n$sCode"
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
