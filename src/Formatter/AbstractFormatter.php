<?php

namespace ToolkitLab\ASCII\Formatter;

use ToolkitLab\ASCII\Table;

abstract class AbstractFormatter implements FormatterInterface {

    /**
     * @var Table
     */
    protected $table;

    /**
     * @var array
     */
    protected $metadata = [];

    /**
     * @var string
     */
    protected $output = '';

    /**
     * The data to be formatted
     * @var array
     */
    protected $data = [];

    /**
     * Formatting parameters
     * @var array
     */
    protected $params = [
        'first_row_header' => false,
    ];

    /**
     * Constructor
     * @param array $params
     */
    public function __construct($params = []) {
        $this->setParams($params);
    }

    /**
     * Converts an array into ASCII-formatted string (table)
     * @param Table $table
     * @param array $params
     * @return string
     */
    public function format($data, $params = []) {
        $this->init($data, $params);
        $this->addTopBorder();
        $this->addHeader();
        $this->addRows();
        $this->addBottomBorder();
        return $this->output;
    }

    /**
     * Initializes the data/parameters before formatting
     * @param Table $table
     * @param array $params
     * @return void
     */
    protected function init($data, $params = []) {
        $this->table = new Table($data);
        $this->output = '';
        $this->data = $this->table->getData();
        $this->setParams($params);
    }

    /**
     * Updates the parameters with new values
     * @param array $params
     * @throws \InvalidArgumentException
     */
    protected function setParams($params) {
        $unknownParams = array_diff(array_keys($params), array_keys($this->params));
        if (count($unknownParams)) {
            throw new \InvalidArgumentException('Unknown parameter(-s): ' . implode(', ', $unknownParams));
        }
        $this->params = array_merge($this->params, $params);
    }

    /**
     * Get the specified parameter
     * @param string $key
     * @return mixed
     */
    protected function getParam($key) {
        return $this->params[$key];
    }

    /**
     * Adds the top border to the output
     * @return void
     */
    protected function addTopBorder() {
        if ($this->metadata['topBorder']) {
            $this->addRow(
                    $this->metadata["HBL"], $this->metadata["HBM"], $this->metadata["HBR"], $this->metadata["HPAD"]
            );
        }
    }

    /**
     * Adds the header row to the output
     * @return void
     */
    protected function addHeader() {
        if ($this->getParam('first_row_header')) {
            $this->addDataRow(array_shift($this->data));
            $this->addHeaderBorder();
        }
    }

    /**
     * Adds the rows to the output
     */
    protected function addRows() {
        array_walk($this->data, [$this, 'addDataRow']);
    }

    /**
     * Adds the row with the specified data to the output
     * @param array $row
     * @return void
     */
    protected function addDataRow($row) {
        $this->addRow(
            $this->metadata["BL"],
            $this->metadata["BM"],
            $this->metadata["BR"],
            ' ',
            $row
        );
    }

    /**
     * Adds the bottom border of the header to the output
     * @return void
     */
    protected function addHeaderBorder() {
        $this->addRow(
            $this->metadata["H2BL"],
            $this->metadata["H2BM"],
            $this->metadata["H2BR"],
            $this->metadata["H2PAD"]
        );
    }

    /**
     * Adds the bottom border to the output
     * @return void
     */
    protected function addBottomBorder() {
        if ($this->metadata['bottomBorder']) {
            $this->addRow(
                $this->metadata["FBL"],
                $this->metadata["FBM"],
                $this->metadata["FBR"],
                $this->metadata["FPAD"]
            );
        }
    }

    /**
     * Adds the row to the output
     * @param string $lb
     * @param string $bm
     * @param string $br
     * @param string $pad
     * @param array $row
     * @return void
     */
    protected function addRow($lb, $bm, $br, $pad, $row = []) {
        $delimiter = $lb;
        for ($i = 0; $i < $this->table->getDimensionX(); $i++) {
            $maxLength = $this->table->getColumnsMaxLenght($i);
            $this->output .= $delimiter;
            if (count($row)) {
                $spaces = str_repeat($pad, $maxLength - strlen($row[$i]));
                $this->output .= " {$row[$i]}{$spaces} ";
            } else {
                $this->output .= str_repeat($pad, $maxLength + 2);
            }
            $delimiter = $bm;
        }
        $this->output .= $br . PHP_EOL;
    }

}
