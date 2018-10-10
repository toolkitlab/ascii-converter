<?php

namespace ToolkitLab\ASCII\Test;

use ToolkitLab\ASCII\AbstractFormatter;
use ToolkitLab\ASCII\Formatter\MarkdownFormatter;
use ToolkitLab\ASCII\Formatter\MysqlFormatter;
use ToolkitLab\ASCII\Formatter\TableFormatter;
use ToolkitLab\ASCII\Formatter\UnicodeFormatter;
use ToolkitLab\ASCII\Formatter\DotsFormatter;
use PHPUnit\Framework\TestCase;

class AsciiTableFormatterTest extends TestCase {
    
    private $testData = [["qweqwe", "asd"], ["qaz", "wsx"], ["qw", "er"]];

    public function testMysql() {
        $formatter = new MysqlFormatter();
        $result = $formatter->format($this->testData, ['mode' => AbstractFormatter::HEADER_FIRST_ROW_MODE]);

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
        $result = $formatter->format($this->testData, ['mode' => AbstractFormatter::HEADER_FIRST_ROW_MODE]);

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
        $result = $formatter->format($this->testData, ['mode' => AbstractFormatter::HEADER_FIRST_ROW_MODE]);

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
        $result = $formatter->format($this->testData, ['mode' => AbstractFormatter::HEADER_FIRST_ROW_MODE]);

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
        $result = $formatter->format($this->testData, ['mode' => AbstractFormatter::HEADER_FIRST_ROW_MODE]);

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
    
    public function testRotateTable() {
        $formatter = new TableFormatter(['rotate' => 90]);
        $result = $formatter->format($this->testData);
        $expect = <<<STR
 ____ _____ ________ 
| qw | qaz | qweqwe |
| er | wsx | asd    |
 ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ 

STR;

        $this->assertEquals($result, $expect);
    }
    
    public function testNumericMode() {
        $formatter = new TableFormatter([
            'rotate' => 90,
            'mode' => AbstractFormatter::HEADER_NUMERIC_MODE,
        ]);
        $result = $formatter->format($this->testData);
        $expect = <<<STR
 ____ _____ ________ 
| 1  | 2   | 3      |
|____|_____|________|
| qw | qaz | qweqwe |
| er | wsx | asd    |
 ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ 

STR;
        $this->assertEquals($result, $expect);
    }
    
    public function testSidebarAbcMode() {
        $formatter = new TableFormatter([
            'mode' => AbstractFormatter::SIDEBAR_ABC_MODE,
        ]);
        $result = $formatter->format($this->testData);
        $expect = <<<STR
 ___ ________ _____ 
| A | qweqwe | asd |
| B | qaz    | wsx |
| C | qw     | er  |
 ¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯¯ 

STR;
        $this->assertEquals($result, $expect);
    }
    
    public function testAbcMode() {
        $formatter = new TableFormatter([
            'rotate' => 90,
            'mode' => AbstractFormatter::HEADER_ABC_MODE,
        ]);
        $data = array_merge($this->testData, $this->testData, $this->testData, $this->testData, $this->testData, $this->testData, $this->testData);
        $data = array_merge($data, $data);
        $result = $formatter->format($data);
        $expect = <<<STR
 ____ _____ ________ ____ _____ ________ ____ _____ ________ ____ _____ ________ ____ _____ ________ ____ _____ ________ ____ _____ ________ ____ _____ ________ ____ _____ ________ ____ _____ ________ ____ _____ ________ ____ _____ ________ ____ _____ ________ ____ _____ ________ 
| A  | B   | C      | D  | E   | F      | G  | H   | I      | J  | K   | L      | M  | N   | O      | P  | Q   | R      | S  | T   | U      | V  | W   | X      | Y  | Z   | AA     | AB | AC  | AD     | AE | AF  | AG     | AH | AI  | AJ     | AK | AL  | AM     | AN | AO  | AP     |
|____|_____|________|____|_____|________|____|_____|________|____|_____|________|____|_____|________|____|_____|________|____|_____|________|____|_____|________|____|_____|________|____|_____|________|____|_____|________|____|_____|________|____|_____|________|____|_____|________|
| qw | qaz | qweqwe | qw | qaz | qweqwe | qw | qaz | qweqwe | qw | qaz | qweqwe | qw | qaz | qweqwe | qw | qaz | qweqwe | qw | qaz | qweqwe | qw | qaz | qweqwe | qw | qaz | qweqwe | qw | qaz | qweqwe | qw | qaz | qweqwe | qw | qaz | qweqwe | qw | qaz | qweqwe | qw | qaz | qweqwe |
| er | wsx | asd    | er | wsx | asd    | er | wsx | asd    | er | wsx | asd    | er | wsx | asd    | er | wsx | asd    | er | wsx | asd    | er | wsx | asd    | er | wsx | asd    | er | wsx | asd    | er | wsx | asd    | er | wsx | asd    | er | wsx | asd    | er | wsx | asd    |
 ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ 

STR;
        $this->assertEquals($result, $expect);
    }

    public function testSpreadsheetMode() {
        $formatter = new TableFormatter([
            'rotate' => 90,
            'mode' => AbstractFormatter::SPREADSHEET_MODE,
        ]);
        $result = $formatter->format($this->testData);
        $expect = <<<STR
 ___ ____ _____ ________ 
|   | A  | B   | C      |
|___|____|_____|________|
| 1 | qw | qaz | qweqwe |
| 2 | er | wsx | asd    |
 ¯¯¯ ¯¯¯¯ ¯¯¯¯¯ ¯¯¯¯¯¯¯¯ 

STR;
        $this->assertEquals($result, $expect);
    }


    public function testNumericSidebarAbcHeaderMode() {
        $formatter = new TableFormatter([
            'mode' => AbstractFormatter::SIDEBAR_NUMERIC_MODE | AbstractFormatter::HEADER_ABC_MODE,
        ]);
        $result = $formatter->format($this->testData);
        $expect = <<<STR
 ___ ________ _____ 
|   | A      | B   |
|___|________|_____|
| 1 | qweqwe | asd |
| 2 | qaz    | wsx |
| 3 | qw     | er  |
 ¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯¯ 

STR;
        $this->assertEquals($result, $expect);
    }

    public function testNumericSidebarNumericHeaderMode() {
        $formatter = new TableFormatter([
            'mode' => AbstractFormatter::SIDEBAR_NUMERIC_MODE | AbstractFormatter::HEADER_NUMERIC_MODE,
        ]);
        $result = $formatter->format($this->testData);
        $expect = <<<STR
 ___ ________ _____ 
|   | 1      | 2   |
|___|________|_____|
| 1 | qweqwe | asd |
| 2 | qaz    | wsx |
| 3 | qw     | er  |
 ¯¯¯ ¯¯¯¯¯¯¯¯ ¯¯¯¯¯ 

STR;
        $this->assertEquals($result, $expect);
    }

    /**
     * @expectedException     LogicException
     */
    public function testInitHeaderException() {
        $formatter = new TableFormatter([
            'mode' => AbstractFormatter::HEADER_NUMERIC_MODE | AbstractFormatter::HEADER_ABC_MODE,
        ]);
        $formatter->format($this->testData);
    }
    
    /**
     * @expectedException     LogicException
     */
    public function testInitSidebarException() {
        $formatter = new TableFormatter([
            'mode' => AbstractFormatter::SIDEBAR_NUMERIC_MODE | AbstractFormatter::SIDEBAR_ABC_MODE,
        ]);
        $formatter->format($this->testData);
    }

    public function testMaxLength() {
        $formatter = new TableFormatter(['max_cell_length' => 4]);
        $data = [
            ['qwerty', 'oiuytrew'],
            ['qwertyuiop', 'jhgfrtyh'],
        ];
        $result = $formatter->format($data);
        $expect = <<<STR
 _________ _________ 
| qwer... | oiuy... |
| qwer... | jhgf... |
 ¯¯¯¯¯¯¯¯¯ ¯¯¯¯¯¯¯¯¯ 

STR;
        $this->assertEquals($result, $expect);
    }
    
    public function testMaxLengthEnding() {
        $formatter = new TableFormatter(['max_cell_length' => 4, 'max_cell_ending' => '']);
        $data = [
            ['qwerty', 'oiuytrew'],
            ['qwertyuiop', 'jhgfrtyh'],
        ];
        $result = $formatter->format($data);
        $expect = <<<STR
 ______ ______ 
| qwer | oiuy |
| qwer | jhgf |
 ¯¯¯¯¯¯ ¯¯¯¯¯¯ 

STR;
        $this->assertEquals($result, $expect);
    }
}
