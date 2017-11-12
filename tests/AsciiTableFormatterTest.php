<?php

namespace ToolkitLab\ASCII\Test;

use ToolkitLab\ASCII\Formatter\MarkdownFormatter;
use ToolkitLab\ASCII\Formatter\MysqlFormatter;
use ToolkitLab\ASCII\Formatter\TableFormatter;
use ToolkitLab\ASCII\Formatter\UnicodeFormatter;
use ToolkitLab\ASCII\Formatter\DotsFormatter;

class AsciiTableFormatterTest extends TableTestCase {

    public function testMysql() {
        $table = $this->getTestTable();
        $formatter = new MysqlFormatter();
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
        $formatter = new MysqlFormatter();
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
        $formatter = new MarkdownFormatter();
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
        $formatter = new MarkdownFormatter();
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
        $formatter = new UnicodeFormatter();
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
        $formatter = new UnicodeFormatter();
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
        $formatter = new DotsFormatter();
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
        $formatter = new DotsFormatter();
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
        $formatter = new TableFormatter();
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
        $formatter = new TableFormatter();
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
