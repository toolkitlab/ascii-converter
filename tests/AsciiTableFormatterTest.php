<?php

namespace ToolkitLab\ASCII\Test;

use ToolkitLab\ASCII\Formater\MarkdownFormater;
use ToolkitLab\ASCII\Formater\MysqlFormater;
use ToolkitLab\ASCII\Formater\TableFormater;
use ToolkitLab\ASCII\Formater\UnicodeFormater;
use ToolkitLab\ASCII\Formater\DotsFormater;

class AsciiTableFormatterTest extends TableTestCase
{
    public function testMysql() {
        $table = $this->getTestTable();
        $formatter = new MysqlFormater();
        $result = $formatter->format($table);

        $expect = <<<STR
+--------+-----+
| qweqwe | asd |
+--------+-----+
| qaz    | wsx |
| qw     | er  |
+--------+-----+

STR;

        $this->assertEquals($result, $expect);
    }

    public function testMysqlNoHeader() {
        $table = $this->getTestTable();
        $formatter = new MysqlFormater();
        $result = $formatter->format($table, false);

        $expect = <<<STR
+--------+-----+
| qweqwe | asd |
| qaz    | wsx |
| qw     | er  |
+--------+-----+

STR;

        $this->assertEquals($result, $expect);
    }

    public function testMarkdown() {
        $table = $this->getTestTable();
        $formatter = new MarkdownFormater();
        $result = $formatter->format($table);

        $expect = <<<STR
| qweqwe | asd |
|--------|-----|
| qaz    | wsx |
| qw     | er  |

STR;

        $this->assertEquals($result, $expect);
    }

    public function testMarkdownNoHeader() {
        $table = $this->getTestTable();
        $formatter = new MarkdownFormater();
        $result = $formatter->format($table, false);

        $expect = <<<STR
| qweqwe | asd |
| qaz    | wsx |
| qw     | er  |

STR;

        $this->assertEquals($result, $expect);
    }

    public function testUnicode() {
        $table = $this->getTestTable();
        $formatter = new UnicodeFormater();
        $result = $formatter->format($table);

        $expect = <<<STR
╔════════╦═════╗
║ qweqwe ║ asd ║
╠════════╬═════╣
║ qaz    ║ wsx ║
║ qw     ║ er  ║
╚════════╩═════╝

STR;

        $this->assertEquals($result, $expect);
    }

    public function testUnicodeNoHeader() {
        $table = $this->getTestTable();
        $formatter = new UnicodeFormater();
        $result = $formatter->format($table, false);

        $expect = <<<STR
╔════════╦═════╗
║ qweqwe ║ asd ║
║ qaz    ║ wsx ║
║ qw     ║ er  ║
╚════════╩═════╝

STR;
        $this->assertEquals($result, $expect);
    }

    public function testDots() {
        $table = $this->getTestTable();
        $formatter = new DotsFormater();
        $result = $formatter->format($table);

        $expect = <<<STR
................
: qweqwe : asd :
:........:.....:
: qaz    : wsx :
: qw     : er  :
:........:.....:

STR;

        $this->assertEquals($result, $expect);
    }

    public function testDotsNoHeader() {
        $table = $this->getTestTable();
        $formatter = new DotsFormater();
        $result = $formatter->format($table, false);

        $expect = <<<STR
................
: qweqwe : asd :
: qaz    : wsx :
: qw     : er  :
:........:.....:

STR;
        
        $this->assertEquals($result, $expect);
    }

    public function testTable() {
        $table = $this->getTestTable();
        $formatter = new TableFormater();
        $result = $formatter->format($table);

        $expect = <<<STR
 ________ _____ 
| qweqwe | asd |
|--------|-----|
| qaz    | wsx |
| qw     | er  |
 -------- ----- 

STR;

        $this->assertEquals($result, $expect);
    }

    public function testTableNoHeader() {
        $table = $this->getTestTable();
        $formatter = new TableFormater();
        $result = $formatter->format($table, false);

        $expect = <<<STR
 ________ _____ 
| qweqwe | asd |
| qaz    | wsx |
| qw     | er  |
 -------- ----- 

STR;

        $this->assertEquals($result, $expect);
    }
}
