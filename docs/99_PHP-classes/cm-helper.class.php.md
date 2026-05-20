---
title: \cmhelper
generator: Axels php-classdoc; https://github.com/axelhahn/php-classdoc
---

## 📦 Class \cmhelper

```txt

 ----------------------------------------------------------------------

 HELPER CLASS for syntax highlighting with codemiror

 @author Axel Hahn
 @link https://github.com/axelhahn/php-codemirror
 @license http://www.gnu.org/licenses/gpl-3.0.html GPL 3.0

 ----------------------------------------------------------------------
 2025-11-16  v0.1  <axel>  initial version
 2026-04-17  v0.2  <axel>  allow multiple instances
 2026-05-18  v0.3  <axel>  __lastModified__

```

## 🔶 Properties

### 🔸 public $_aAvailableShModes

Mapping array for codemirror modes

 WORK IN PROGRESS
 These are just a few of the supported languages!
 @see https://codemirror.net/5/mode/index.html

 Per language/ file type we define
 - load {array}  list of javascript files to load
 - mode {string} mode value when initalizing editor object

 @var array

type: array

default value: {{defaultvalue}}



## 🔷 Methods

### 🔹 public __construct()

__construct

Line [74](https://github.com/axelhahn/php-codemirror/tree/main/classes/cm-helper.class.php#L74) (7 lines)

**Return**: `void`

**Parameters**: **0** (required: 0)

### 🔹 public setBase()

Set a base url for codemirror resources.
 Its value cannot be verified - it is just used for html head
 Check the browser dev tools -> network if the resource can be loaded.

Line [94](https://github.com/axelhahn/php-codemirror/tree/main/classes/cm-helper.class.php#L94) (32 lines)

**Return**: `void`

**Parameters**: **1** (required: 0)

| Parameter | Type | Description
|--         |--    |--
| \<optional\> $sNewbase | `string` | new ur

### 🔹 public addEditor()

Add an editor with its own syntax highlighting for a textarea.
 You can call this method multiple times for several editors with its
 own options.

 As a reminder: you need to call
 - $o->getHtmlHead()
 - $o->getJs()
 ... to apply the editor settings in the html document

Line [155](https://github.com/axelhahn/php-codemirror/tree/main/classes/cm-helper.class.php#L155) (56 lines)

**Return**: `bool`

**Parameters**: **3** (required: 1)

| Parameter | Type | Description
|--         |--    |--
| \<required\> $sMode | `string` | Mode/ language for syntax highlighting
| \<optional\> $sFormid | `string` | id of the textarea
| \<optional\> $aMoreOptions | `array` | array of additional options. known subkeys are
                              - readOnly        bool    if true the editor is readonly
                              - theme           string  thene name

                              - indentUnit      int     indent unit; default: 4
                              - tabSize         int     tab size; default: 4
                              - lineNumbers     bool    show line numbers; default: false
                              - lineWrapping    bool    wrap long lines; default: false
                              - matchBrackets   bool    highlight matching brackets; default: true
                              - height          string  css value for height

### 🔹 public addTextarea()

Add an editor with its own syntax highlighting for a textarea.
 You can call this method multiple times for several editors with its
 own options.

 As a reminder: you need to call
 - $o->getHtmlHead()
 - $o->getJs()
 ... to apply the editor settings in the html document

Line [241](https://github.com/axelhahn/php-codemirror/tree/main/classes/cm-helper.class.php#L241) (31 lines)

**Return**: `string`

**Parameters**: **2** (required: 0)

| Parameter | Type | Description
|--         |--    |--
| \<optional\> $aTextarea | `array` | array attributes for the textarea. Required subkeys are
                              - id       string  id attribute
                              - class    string  css classes attribute; one of it must be "highlight-<type>"
                              optional subkeys
                              - name     string  name of the form variable
                              - value    string  initial value inside teaxtarea
                              - ... all other textarea attributes
| \<optional\> $aMoreOptions | `array` | array of additional options. Known subkeys are
                              - readOnly        bool    if true the editor is readonly
                              - theme           string  thene name

                              - indentUnit      int     indent unit; default: 4
                              - tabSize         int     tab size; default: 4
                              - lineNumbers     bool    show line numbers; default: false
                              - lineWrapping    bool    wrap long lines; default: false
                              - matchBrackets   bool    highlight matching brackets; default: true
                              - height          string  TODO css value for height

### 🔹 public getModes()

Get a list of supported syntax highlight modes

Line [352](https://github.com/axelhahn/php-codemirror/tree/main/classes/cm-helper.class.php#L352) (7 lines)

**Return**: `array`

**Parameters**: **1** (required: 0)

| Parameter | Type | Description
|--         |--    |--
| \<optional\> $bWithOptions | ` *` | 

### 🔹 public getThemes()

Get a list of known themes

Line [364](https://github.com/axelhahn/php-codemirror/tree/main/classes/cm-helper.class.php#L364) (4 lines)

**Return**: `array`

**Parameters**: **0** (required: 0)

### 🔹 public getHtmlHead()

Get html code for html head lines

Line [375](https://github.com/axelhahn/php-codemirror/tree/main/classes/cm-helper.class.php#L375) (4 lines)

**Return**: `string`

**Parameters**: **0** (required: 0)

### 🔹 public getJs()

Get html code for javascript code for bottom of html page

Line [384](https://github.com/axelhahn/php-codemirror/tree/main/classes/cm-helper.class.php#L384) (4 lines)

**Return**: `string`

**Parameters**: **0** (required: 0)

---
Generated with [Axels PHP class doc parser](https://github.com/axelhahn/php-classdoc)
