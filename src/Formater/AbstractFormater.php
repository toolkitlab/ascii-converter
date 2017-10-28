<?php


namespace ToolkitLab\ASCII\Formater;


use ToolkitLab\ASCII\FormaterInterface;
use ToolkitLab\ASCII\Table;

abstract class AbstractFormater implements FormaterInterface
{
    /**
     * @var Table
     */
    protected $table;

    protected $metadata = [];

    public function setMeta($key, $value) {
        $this->metadata[$key] = $value;
    }

    public function format(Table $table, $firstRowAsHeader = true){
        $this->table = $table;
        $str = "";

        $firsRow = 0;
        if ($firstRowAsHeader) {
            $str .= $this->header();
            $firsRow = 1;
        } else if ($this->metadata['useHeader']) {
            $delimiter = $this->metadata["HBL"];
            for ($i = 0; $i < $this->table->getDimensionX(); $i++) {
                $columnLenght = $this->table->getColumnsMaxLenght($i) + 2;
                $str .= $delimiter;
                $str .= str_repeat($this->metadata["HPAD"], $columnLenght);
                $delimiter = $this->metadata["HBM"];
            }
            $str .= $this->metadata["HBR"] . PHP_EOL;

        }

        for ($i = $firsRow; $i < $this->table->getDimensionY(); $i++){
            $str .= $this->line($i);
        }

        if ($this->metadata['useFooter']) {
            $delimiter = $this->metadata["FBL"];
            for ($i = 0; $i < $this->table->getDimensionX(); $i++) {
                $columnLenght = $this->table->getColumnsMaxLenght($i) + 2;
                $str .= $delimiter;
                $str .= str_repeat($this->metadata["FPAD"], $columnLenght);
                $delimiter = $this->metadata["FBM"];
            }
            $str .= $this->metadata["FBR"] . PHP_EOL;
        }

        return $str;
    }


    private function line($rowIndex) {
        $retStr = "";
        $delimiter = $this->metadata["BL"];
        for ($i = 0; $i < $this->table->getDimensionX(); $i++){
            $retStr .= $delimiter;
            $cell = $this->table->getCell($i, $rowIndex);
            $retStr .= " " . $cell . str_repeat(" ", $this->table->getColumnsMaxLenght($i) - strlen($cell)) . " ";
            $delimiter = $this->metadata["BM"];
        }
        $retStr .= $this->metadata["BR"] . PHP_EOL;
        return $retStr;
    }

    protected function header() {
        $retStr = "";

        // First row
        if ($this->metadata['useHeader']) {
            $delimiter = $this->metadata["HBL"];
            for ($i = 0; $i < $this->table->getDimensionX(); $i++) {
                $columnLenght = $this->table->getColumnsMaxLenght($i) + 2;
                $retStr .= $delimiter;
                $retStr .= str_repeat($this->metadata["HPAD"], $columnLenght);
                $delimiter = $this->metadata["HBM"];
            }
            $retStr .= $this->metadata["HBR"] . PHP_EOL;
        }

        // Second row
        $delimiter = $this->metadata["BL"];
        for ($i = 0; $i < $this->table->getDimensionX(); $i++){
            $retStr .= $delimiter;
            $retStr .= " " . $this->table->getCell($i, 0) . " ";
        }
        $retStr .= $this->metadata["BR"] . PHP_EOL;

        // Third row
        $delimiter = $this->metadata["H2BL"];
        for ($i = 0; $i < $this->table->getDimensionX(); $i++){
            $columnLenght = $this->table->getColumnsMaxLenght($i) + 2;
            $retStr .= $delimiter;
            $retStr .= str_repeat($this->metadata["BPAD"], $columnLenght);
            $delimiter = $this->metadata["H2BM"];
        }
        $retStr .= $this->metadata["H2BR"] . PHP_EOL;


        return $retStr;
    }
}