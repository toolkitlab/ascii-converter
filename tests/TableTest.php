<?php


namespace ToolkitLab\ASCII\Test;

class TableTest extends TableTestCase
{
    public function testGetColumnsMaxLenght() {
        $table = $this->getTestTable();
        $len = $table->getColumnsMaxLenght(0);

        $this->assertEquals($len, 6);
    }

    public function testGetCell() {
        $table = $this->getTestTable();
        $cell1 = $table->getCell(0,0);
        $cell2 = $table->getCell(1,0);
        $cell3 = $table->getCell(0,1);
        $cell4 = $table->getCell(1,1);

        $this->assertEquals($cell1, "qweqwe");
        $this->assertEquals($cell2, "asd");
        $this->assertEquals($cell3, "qaz");
        $this->assertEquals($cell4, "wsx");
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
        $table->setData([["q", "w"],["e", "r"]]);
        $dx = $table->getDimensionX();
        $dy = $table->getDimensionY();
        $this->assertEquals($dx, 2);
        $this->assertEquals($dy, 2);

        $cell1 = $table->getCell(0,0);
        $cell2 = $table->getCell(1,0);
        $cell3 = $table->getCell(0,1);
        $cell4 = $table->getCell(1,1);

        $this->assertEquals($cell1, "q");
        $this->assertEquals($cell2, "w");
        $this->assertEquals($cell3, "e");
        $this->assertEquals($cell4, "r");
    }

}