<?php

namespace ToolkitLab\ASCII\Test;

class TableTest extends TableTestCase {

    public function testGetColumnsMaxLenght() {
        $table = $this->getTestTable();
        $len = $table->getColumnsMaxLenght(0);

        $this->assertEquals($len, 6);
    }

    public function testGetCell() {
        $table = $this->getTestTable();
        $cell1 = $table->getCell(0, 0);
        $cell2 = $table->getCell(1, 0);
        $cell3 = $table->getCell(0, 1);
        $cell4 = $table->getCell(1, 1);

        $table = $this->getTestTable(true);
        $cell5 = $table->getCell(15, 15);

        $this->assertEquals($cell1, "qweqwe");
        $this->assertEquals($cell2, "asd");
        $this->assertEquals($cell3, "qaz");
        $this->assertEquals($cell4, "wsx");
        $this->assertEquals($cell5, "");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testGetCellException() {
        $table = $this->getTestTable(true);
        $cell = $table->getCell(21, 21);
    }

    public function testGetData() {
        $table = $this->getTestTable();
        $data1 = $table->getData();
        $data2 = [["qweqwe", "asd"], ["qaz", "wsx"], ["qw", "er"]];
        $this->assertEquals($data1, $data2);
    }

    public function testGetDimension() {
        $table = $this->getTestTable();
        $dx = $table->getDimensionX();
        $dy = $table->getDimensionY();

        $this->assertEquals($dx, 2);
        $this->assertEquals($dy, 3);
    }

    public function testSetData() {
        $table = $this->getTestTable();
        $table->setData([["q", "w"], ["e", "r"]]);
        $dx = $table->getDimensionX();
        $dy = $table->getDimensionY();
        $this->assertEquals($dx, 2);
        $this->assertEquals($dy, 2);

        $cell1 = $table->getCell(0, 0);
        $cell2 = $table->getCell(1, 0);
        $cell3 = $table->getCell(0, 1);
        $cell4 = $table->getCell(1, 1);

        $this->assertEquals($cell1, "q");
        $this->assertEquals($cell2, "w");
        $this->assertEquals($cell3, "e");
        $this->assertEquals($cell4, "r");
    }
    
    public function testRotate() {
        $table = $this->getTestTable();
        $data = [
            ['q', 'w'],
            ['e', 'r'],
            ['u', 'p'],
        ];
        $table->setData($data);
        $table->rotate(90);
        $this->assertEquals($table->getData(), [
            ['u', 'e', 'q'], 
            ['p', 'r', 'w'],
        ]);
        $table->setData($data);
        $table->rotate(180);
        $this->assertEquals($table->getData(), [
            ['p', 'u'], 
            ['r', 'e'],
            ['w', 'q'],
        ]);
        $table->setData($data);
        $table->rotate(270);
        $this->assertEquals($table->getData(), [
            ['w', 'r', 'p'], 
            ['q', 'e', 'u'], 
        ]);
        $table->setData($data);
        $table->rotate(-90);
        $this->assertEquals($table->getData(), [
            ['w', 'r', 'p'], 
            ['q', 'e', 'u'], 
        ]);
        $table->setData($data);
        $table->rotate(-180);
        $this->assertEquals($table->getData(), [
            ['p', 'u'],
            ['r', 'e'],
            ['w', 'q'],
        ]);
        $table->setData($data);
        $table->rotate(-270);
        $this->assertEquals($table->getData(), [
            ['u', 'e', 'q'],
            ['p', 'r', 'w'],
        ]);
        // rotate the previous array, not that one specified at the beginning
        $table->rotate(-90);
        $this->assertEquals($table->getData(), [
            ['q', 'w'],
            ['e', 'r'],
            ['u', 'p'],
        ]);
    }
    
    /**
     * @expectedException     InvalidArgumentException
     */
    public function testRotateException() {
        $table = $this->getTestTable();
        $data = [
            ['q', 'w'],
            ['e', 'r'],
            ['u', 'p'],
        ];
        $table->setData($data);
        $table->rotate(1);
    }

}
