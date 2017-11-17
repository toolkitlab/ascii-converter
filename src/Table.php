<?php

namespace ToolkitLab\ASCII;

class Table {

    private $data = [];
    private $dimensionX;
    private $dimensionY;
    private $columnsMaxLenght = [];

    public function __construct($_data, $_dimensionX = null, $_dimensionY = null) {
        $this->data = $_data;
        if (is_null($_dimensionX)) {
            $this->calculateDimensions();
        } else {
            $this->dimensionX = $_dimensionX;
            $this->dimensionY = $_dimensionY;
        }
    }

    public function getCell($x, $y) {
        if ($x >= $this->dimensionX || $y >= $this->dimensionY) {
            throw new \InvalidArgumentException("Index Out of range");
        }
        if (!isset($this->data[$y][$x])) {
            return "";
        }
        return $this->data[$y][$x];
    }

    /**
     * @param int $columnIndex
     * @return int
     */
    public function getColumnsMaxLenght($columnIndex) {
        if (isset($this->columnsMaxLenght[$columnIndex])) {
                    return $this->columnsMaxLenght[$columnIndex];
        }
        $width = 0;
        for ($y = 0; $y < $this->dimensionY; $y++) {
            $len = strlen($this->getCell($columnIndex, $y));
            if ($len > $width) {
                            $width = $len;
            }
        }

        $this->columnsMaxLenght[$columnIndex] = $width;
        return $width;
    }

    /**
     * @return array
     */
    public function getData() {
        return $this->data;
    }

    private function calculateDimensions() {
        $this->dimensionY = $this->dimensionX = 0;

        foreach ($this->data as $row) {
            $cnt = count($row);
            if ($cnt > $this->dimensionX) {
                            $this->dimensionX = $cnt;
            }
        }
        $this->dimensionY = count($this->data);
    }

    /**
     * @param array $data
     */
    public function setData($data) {
        $this->data = $data;
        $this->calculateDimensions();
    }

    /**
     * @return mixed
     */
    public function getDimensionX() {
        return $this->dimensionX;
    }

    /**
     * @return mixed
     */
    public function getDimensionY() {
        return $this->dimensionY;
    }

}
