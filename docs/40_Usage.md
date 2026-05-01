## Use it in your php code

### Initialize the php class

Include the class file and create a new instance.

```php
<?php
require_once '<webroot>/vendor/php-codemirror/classes/cm-helper.class.php';
$codemirror=new cmhelper();
```

### Set a base url for codemirror resources

This step is optional. If you have a local copy of codemirror you can set a base url. By default the resources are loaded from cdnjs.

You can set a relative or absolute url. The base url will be loaded in the html head.

`<link rel="stylesheet" href="<your base url>/codemirror.min.css">`

👉 **Example**:

```php
$codemirror->setBase('/vendor/codemirror/6.65.7');
```

### Add a textarea - addTextarea()

You can insert a textarea inside the html body to use it as a viewer or inside a form tag to use it as an editor.

The basic syntax is

```txt
echo $codemirror->addTextarea(
    <array for textarea>,
    <array for options>
)
```

This method returns the html code for the textarea.
Internally it stores newly added highlighters and themes and loads them when needed.

#### Array for textarea

You can define any html attribute for the textarea tag.
The specialties are:

* `id` - this attribute is required
* `class` - this attribute is required and must contain a css class `highlight-<mode>` to define the mode for syntax highlighting
* `value` - content of the textarea. This key will be removed before writing the textarea tag.

#### Array for options

The options define the behavior of the editor. Currently only the following options are supported:

| key             | type   | description
| ---             | ---    | --- 
| `readOnly`      | bool   | if true the editor is readonly 
| `theme`         | string | name of the theme 
| `indentUnit`    | int    | indent unit; default: 4
| `tabSize`       | int    | tab size; default: 4
| `lineNumbers`   | bool   | show line numbers; default: false
| `lineWrapping`  | bool   | wrap long lines; default: false
| `matchBrackets` | bool   | highlight matching brackets; default: true

### Apply codemirror - addEditor()

This is an alternative method to `addTextarea()` that applies the codemirror editor to an already existing / elsewhere rendered textarea.

```text
$codemirror->addEditor(
    <mode>,
    <textarea id>,
    <array for options>
)
```

| key   | type   | description
| ---   | ---    | --- 
| #1    | string | mode/ language for syntax highlighting
| #2    | string | id of the textarea
| #3    | array  | The options are the same as for `addTextarea()`

This method returns nothing.
Internally it stores newly added highlighters and themes and loads them when needed.

### Render page

The page is rendered by the class methods 

* `getHtmlHead()` to load the vase code, themes, syntax highlighting and 
* `getJs()` to initialize the editor

!!! warning "WARNING"
    You need to keep in mind to call these methods after you have added all your textareas. In deppendcy of set highlighters and themes they respond a list on needed libs to load.

This is a complete example.

```php
<?php
declare(strict_types=1);

require_once '[webroot]/vendor/php-codemirror/classes/cm-helper.class.php';
$codemirror=new cmhelper();

$htmlbody=$codemirror->addTextarea(
            [
                'class' => 'highlight-htmlmixed',
                'value' => '<your sourcecode to highlight>',
            ],
            [
                'readOnly' => true,
            ]
        );

$sCmHead=$codemirror->getHtmlHead();
$sCmJs=$codemirror->getJs();

echo <<<HTML
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>CodeMirror - demo</title>"
        {$sCmHead}

    </head>
    <body>

        <h1>Demo</h1>

        {$htmlbody}
        {$sCmJs}

    </body>
</html>
HTML;
```

### Other methods

TODO
