<?php

namespace ToolkitLab\ASCII;

class Table {

    private $data = [];
    private $dimensionX;
    private $dimensionY;
    private $columnsMaxLenght = [];

    /**
     * Constructor
     * @param array $data
     * @param int $dimensionX
     * @param int $dimensionY
     */
    public function __construct($data, $dimensionX = null, $dimensionY = null) {
        $this->setData($data, $dimensionX, $dimensionY);
    }

    /**
     * Returns the specified cell content
     * @param int $x
     * @param int $y
     * @return string
     * @throws \InvalidArgumentException
     */
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
     * Return the maximum length of the column
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
     * Returns the data
     * @return array
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Calculates the dimensions
     */
    private function calculateDimensions() {
        $this->dimensionY = $this->dimensionX = 0;

        foreach ($this->data as $row) {
            $cnt = count($row);
            if ($cnt > $this->dimensionX) {
                            $this->dimensionX = $cnt;
            }
        }
        $this->dimensionY = count($this->data);
        $this->columnsMaxLenght = [];
    }

    /**
     * Sets the data and calculates the dimensions (if not specified)
     * @param array $data
     */
    public function setData($data, $dimensionX = null, $dimensionY = null) {
        $this->data = $data;
        if (is_null($dimensionX)) {
            $this->calculateDimensions();
        } else {
            $this->dimensionX = $dimensionX;
            $this->dimensionY = $dimensionY;
        }
    }

    /**
     * Return the length of the dimension X (width of the table)
     * @return int
     */
    public function getDimensionX() {
        return $this->dimensionX;
    }

    /**
     * Return the length of the dimension Y (height of the table)
     * @return int
     */
    public function getDimensionY() {
        return $this->dimensionY;
    }
    
    /**
     * Rotates the table
     * @param int $angle 90, 180, 270, -90, -180, -270
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function rotate($angle) {
        if (in_array($angle, [90, -270])) {
            return $this->rotateClockwise();
        } elseif (in_array($angle, [-90, 270])) {
            return $this->rotateCounterclockwise();
        } elseif (in_array($angle, [180, -180])) {
            return $this->rotateClockwise()->rotateClockwise();
        }
        throw new \InvalidArgumentException("The angle should be one of the following: 90, 180, 270, -90, -180, -270");
    }
    
    /**
     * Rotates the data clockwise
     * @return $this
     */
    private function rotateClockwise() {
        $data = [];
        for ($i = count($this->data) - 1; $i >= 0; $i--) {
            foreach ($this->data[$i] as $key => $val) {
                $data[$key][] = $val;
            }
        }
        $this->setData($data);
        return $this;
    }
    
    /**
     * Rotates the data counterclockwise
     * @return $this
     */
    private function rotateCounterclockwise() {
        $data = [];
        for ($i = $this->getDimensionX() - 1; $i >= 0; $i--) {
            $row = [];
            foreach ($this->data as $val) {
                $row[] = $val[$i];
            }
            $data[] = $row;
        }
        $this->setData($data);
        return $this;
    }

}
