<?php

namespace ToolkitLab\ASCII\Test;

use ToolkitLab\ASCII\Formatter\Formatters\MarkdownFormatter;
use ToolkitLab\ASCII\Formatter\Formatters\MysqlFormatter;
use ToolkitLab\ASCII\Formatter\Formatters\TableFormatter;
use ToolkitLab\ASCII\Formatter\Formatters\UnicodeFormatter;
use ToolkitLab\ASCII\Formatter\Formatters\DotsFormatter;
use PHPUnit\Framework\TestCase;

class AsciiTableFormatterTest extends TestCase {
    
    private $testData = [["qweqwe", "asd"], ["qaz", "wsx"], ["qw", "er"]];

    public function testMysql() {
        $formatter = new MysqlFormatter();
        $result = $formatter->format($this->testData, ['first_row_header' => true]);

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
        $formatter = new MysqlFormatter();
        $result = $formatter->format($this->testData);

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
        $formatter = new MarkdownFormatter();
        $result = $formatter->format($this->testData, ['first_row_header' => true]);

        $expect = <<<STR
| qweqwe | asd |
|--------|-----|
| qaz    | wsx |
| qw     | er  |

STR;

        $this->assertEquals($result, $expect);
    }

    public function testMarkdownNoHeader() {
        $formatter = new MarkdownFormatter();
        $result = $formatter->format($this->testData);

        $expect = <<<STR
| qweqwe | asd |
| qaz    | wsx |
| qw     | er  |

STR;

        $this->assertEquals($result, $expect);
    }

    public function testUnicode() {
        $formatter = new UnicodeFormatter();
        $result = $formatter->format($this->testData, ['first_row_header' => true]);

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
        $formatter = new UnicodeFormatter();
        $result = $formatter->format($this->testData);

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
        $formatter = new DotsFormatter();
        $result = $formatter->format($this->testData, ['first_row_header' => true]);

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
        $formatter = new DotsFormatter();
        $result = $formatter->format($this->testData);

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
        $formatter = new TableFormatter();
        $result = $formatter->format($this->testData, ['first_row_header' => true]);

        $expect = <<<STR
 ________ _____ 
| qweqwe | asd |
|________|_____|
| qaz    | wsx |
| qw     | er  |
 ¯¯¯¯¯¯¯¯ ¯¯¯¯¯ 

STR;

        $this->assertEquals($result, $expect);
    }

    public function testTableNoHeader() {
        $formatter = new TableFormatter();
        $result = $formatter->format($this->testData);

        $expect = <<<STR
 ________ _____ 
| qweqwe | asd |
| qaz    | wsx |
| qw     | er  |
 ¯¯¯¯¯¯¯¯ ¯¯¯¯¯ 

STR;

        $this->assertEquals($result, $expect);
    }
    
    /**
     * @expectedException     InvalidArgumentException
     */
    public function testSetUnknownParams() {
        $formatter = new TableFormatter(['unknown_param' => 1]);
    }

}
