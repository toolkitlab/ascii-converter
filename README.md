# ASCII converter
[![Latest version][ico-version]][link-packagist]
[![Software License][ico-license]][link-license]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]
[![Gitter][ico-gitter]][link-gitter]

The converter allows you to convert an array into an ASCII formatted string. You can see such ASCII formatted tables when working in command line with MySQL or PostgreSQL.

## Available converters
ToolkitLab\ASCII\Formatter\MysqlFormatter
```
+---+-------+----------+
|   | A     | B        |
+---+-------+----------+
| 1 | Name  | Position |
| 2 | John  | Writer   |
| 3 | Anna  | Student  |
| 4 | David | Teacher  |
+---+-------+----------+
```
ToolkitLab\ASCII\Formatter\UnicodeFormatter
```
╔═══╦═══════╦══════════╗
║   ║ A     ║ B        ║
╠═══╬═══════╬══════════╣
║ 1 ║ Name  ║ Position ║
║ 2 ║ John  ║ Writer   ║
║ 3 ║ Anna  ║ Student  ║
║ 4 ║ David ║ Teacher  ║
╚═══╩═══════╩══════════╝
```
ToolkitLab\ASCII\Formatter\DotsFormatter
```
........................
:   : A     : B        :
:...:.......:..........:
: 1 : Name  : Position :
: 2 : John  : Writer   :
: 3 : Anna  : Student  :
: 4 : David : Teacher  :
:...:.......:..........:
```
ToolkitLab\ASCII\Formatter\MarkdownFormatter
```
|   | A     | B        |
|---|-------|----------|
| 1 | Name  | Position |
| 2 | John  | Writer   |
| 3 | Anna  | Student  |
| 4 | David | Teacher  |
```
ToolkitLab\ASCII\Formatter\TableFormatter
```
 ___ _______ __________ 
|   | A     | B        |
|___|_______|__________|
| 1 | Name  | Position |
| 2 | John  | Writer   |
| 3 | Anna  | Student  |
| 4 | David | Teacher  |
 ¯¯¯ ¯¯¯¯¯¯¯ ¯¯¯¯¯¯¯¯¯¯ 
```

## Usage

```php
<?php
    
use ToolkitLab\ASCII\Formatter\MysqlFormatter;

$formatter = new MysqlFormatter();
echo $formatter->format([
    ["Name", "Position"],
    ["John", "Writer"],
    ["Anna", "Student"],
    ["David", "Teacher"],
]);

?>
```

this will output the following:

```
+-------+----------+
| Name  | Position |
| John  | Writer   |
| Anna  | Student  |
| David | Teacher  |
+-------+----------+
```

#### Modes
There are different modes available, which add additional formatting to the output:

##### Use the first row as a header
```php
<?php
    
use ToolkitLab\ASCII\Formatter\MysqlFormatter;
use ToolkitLab\ASCII\AbstractFormatter;

$formatter = new MysqlFormatter([
    'mode' => AbstractFormatter::HEADER_FIRST_ROW_MODE
]);
echo $formatter->format([
    ["Name", "Position"],
    ["John", "Writer"],
    ["Anna", "Student"],
    ["David", "Teacher"],
]);

?>
```
will output:
```
+-------+----------+
| Name  | Position |
+-------+----------+
| John  | Writer   |
| Anna  | Student  |
| David | Teacher  |
+-------+----------+
```
##### Use a numbered header
```php
<?php
    
use ToolkitLab\ASCII\Formatter\MysqlFormatter;
use ToolkitLab\ASCII\AbstractFormatter;

$formatter = new MysqlFormatter([
    'mode' => AbstractFormatter::HEADER_NUMERIC_MODE
]);
echo $formatter->format([
    ["Name", "Position"],
    ["John", "Writer"],
    ["Anna", "Student"],
    ["David", "Teacher"],
]);

?>
```
will output:
```
+-------+----------+
| 1     | 2        |
+-------+----------+
| Name  | Position |
| John  | Writer   |
| Anna  | Student  |
| David | Teacher  |
+-------+----------+
```
##### Use an alphabetical header
```php
<?php
    
use ToolkitLab\ASCII\Formatter\MysqlFormatter;
use ToolkitLab\ASCII\AbstractFormatter;

$formatter = new MysqlFormatter([
    'mode' => AbstractFormatter::HEADER_ABC_MODE
]);
echo $formatter->format([
    ["Name", "Position"],
    ["John", "Writer"],
    ["Anna", "Student"],
    ["David", "Teacher"],
]);

?>
```
will output:
```
+-------+----------+
| A     | B        |
+-------+----------+
| Name  | Position |
| John  | Writer   |
| Anna  | Student  |
| David | Teacher  |
+-------+----------+
```

##### Use a numbered sidebar
```php
<?php
    
use ToolkitLab\ASCII\Formatter\MysqlFormatter;
use ToolkitLab\ASCII\AbstractFormatter;

$formatter = new MysqlFormatter([
    'mode' => AbstractFormatter::SIDEBAR_NUMERIC_MODE
]);
echo $formatter->format([
    ["Name", "Position"],
    ["John", "Writer"],
    ["Anna", "Student"],
    ["David", "Teacher"],
]);

?>
```
will output:
```
+---+-------+----------+
| 1 | Name  | Position |
| 2 | John  | Writer   |
| 3 | Anna  | Student  |
| 4 | David | Teacher  |
+---+-------+----------+
```

##### Use an alphabetical sidebar
```php
<?php
    
use ToolkitLab\ASCII\Formatter\MysqlFormatter;
use ToolkitLab\ASCII\AbstractFormatter;

$formatter = new MysqlFormatter([
    'mode' => AbstractFormatter::SIDEBAR_ABC_MODE
]);
echo $formatter->format([
    ["Name", "Position"],
    ["John", "Writer"],
    ["Anna", "Student"],
    ["David", "Teacher"],
]);

?>
```
will output:
```
+---+-------+----------+
| A | Name  | Position |
| B | John  | Writer   |
| C | Anna  | Student  |
| D | David | Teacher  |
+---+-------+----------+
```

##### Apply spreadsheet mode
```php
<?php
    
use ToolkitLab\ASCII\Formatter\MysqlFormatter;
use ToolkitLab\ASCII\AbstractFormatter;

$formatter = new MysqlFormatter([
    'mode' => AbstractFormatter::SPREADSHEET_MODE
]);
echo $formatter->format([
    ["Name", "Position"],
    ["John", "Writer"],
    ["Anna", "Student"],
    ["David", "Teacher"],
]);

?>
```
will output:
```
+---+-------+----------+
|   | A     | B        |
+---+-------+----------+
| 1 | Name  | Position |
| 2 | John  | Writer   |
| 3 | Anna  | Student  |
| 4 | David | Teacher  |
+---+-------+----------+
```

##### Using multiple modes
```php
<?php
    
use ToolkitLab\ASCII\Formatter\MysqlFormatter;
use ToolkitLab\ASCII\AbstractFormatter;

$formatter = new MysqlFormatter([
    'mode' => AbstractFormatter::SIDEBAR_NUMERIC_MODE | AbstractFormatter::HEADER_NUMERIC_MODE
]);
echo $formatter->format([
    ["Name", "Position"],
    ["John", "Writer"],
    ["Anna", "Student"],
    ["David", "Teacher"],
]);

?>
```
will output:
```
+---+-------+----------+
|   | 1     | 2        |
+---+-------+----------+
| 1 | Name  | Position |
| 2 | John  | Writer   |
| 3 | Anna  | Student  |
| 4 | David | Teacher  |
+---+-------+----------+
```

##### Rotate
```php
<?php
    
use ToolkitLab\ASCII\Formatter\MysqlFormatter;

$formatter = new MysqlFormatter();
echo $formatter->format([
    ["Name", "Position"],
    ["John", "Writer"],
    ["Anna", "Student"],
    ["David", "Teacher"],
], [
   'rotate' => -90 
]);

?>
```
will output:
```
+----------+--------+---------+---------+
| Position | Writer | Student | Teacher |
| Name     | John   | Anna    | David   |
+----------+--------+---------+---------+
```
##### Set max cell length
The parameter "max_cell_length" allows you to set the maximum cell length. If the length is exceeded all further text will be replaced by three dots (the ending can be set with the parameter "max_cell_ending"). Default value is 100. 
```php
<?php
    
use ToolkitLab\ASCII\Formatter\MysqlFormatter;

$formatter = new MysqlFormatter();
echo $formatter->format([
    ["Name", "Position"],
    ["John", "Writer"],
    ["Anna", "Student"],
    ["David", "Teacher"],
], [
   'max_cell_length' => 5,
]);

?>
```
will output:
```
+-------+----------+
| Name  | Posit... |
| John  | Write... |
| Anna  | Stude... |
| David | Teach... |
+-------+----------+
```
##### Set ending for exceeded max cell length
The parameter "max_cell_ending" allows you to set the ending if the maximum cell length is exceeded. Default value is "...".
```php
<?php
    
use ToolkitLab\ASCII\Formatter\MysqlFormatter;

$formatter = new MysqlFormatter();
echo $formatter->format([
    ["Name", "Position"],
    ["John", "Writer"],
    ["Anna", "Student"],
    ["David", "Teacher"],
], [
   'max_cell_length' => 5,
   'max_cell_ending' => '[hidden]',
]);

?>
```
will output:
```
+-------+---------------+
| Name  | Posit[hidden] |
| John  | Write[hidden] |
| Anna  | Stude[hidden] |
| David | Teach[hidden] |
+-------+---------------+
```

[ico-version]: https://img.shields.io/packagist/v/toolkitlab/ascii-converter.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/toolkitlab/ascii-converter/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/toolkitlab/ascii-converter.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/toolkitlab/ascii-converter.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/toolkitlab/ascii-converter.svg?style=flat-square
[ico-gitter]: https://img.shields.io/badge/GITTER-JOIN%20CHAT%20%E2%86%92-brightgreen.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/toolkitlab/ascii-converter
[link-license]: https://github.com/toolkitlab/ascii-converter/blob/test/LICENSE
[link-travis]: https://travis-ci.org/toolkitlab/ascii-converter
[link-scrutinizer]: https://scrutinizer-ci.com/g/toolkitlab/ascii-converter/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/toolkitlab/ascii-converter
[link-downloads]: https://packagist.org/packages/toolkitlab/ascii-converter
[link-gitter]: https://gitter.im/toolkitlab/ascii-converter