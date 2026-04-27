## Use it in your php code

### Initialize the php class

Include the class file and create a new instance.

```php
<?php
require_once __DIR__.'/../classes/cm-helper.class.php';
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

#### Array for textarea

You can define any html attribute for the textarea tag.
The specialties are:

* `id` - this attribute is required
* `class` - this attribute is required and must contain a css class `highlight-<mode>` to define the mode for syntax highlighting
* `value` - content of the textarea. This key will be removed before writing the textarea tag.

#### Array for options

The options define the behavior of the editor. Currently only the following options are supported:

| key         | type   | description
| ---         | ---    | --- 
| `readOnly`  | bool   | if true the editor is readonly 
| `theme`     | string | name of the theme 

### Apply codemirror - addEditor()

This is an alternative method to `addTextarea()` that applies the codemirror editor to an already existing textarea.

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



### Render page

The page is rendered by the class methods 

* `getHtmlHead()` to load the vase code, themes, syntax highlighting and 
* `getJs()` to initialize the editor

```php
echo $codemirror->getHtmlHead();
echo $codemirror->getJs();
```