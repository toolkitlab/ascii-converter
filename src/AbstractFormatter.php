<?php

namespace ToolkitLab\ASCII;

use ToolkitLab\ASCII\Table;

abstract class AbstractFormatter implements FormatterInterface {
    
    const
        DEFAULT_MODE              = 0x00,

        HEADER_FIRST_ROW_MODE     = 0X01,
        HEADER_NUMERIC_MODE       = 0x02,
        HEADER_ABC_MODE           = 0X04,
            
        SIDEBAR_NUMERIC_MODE      = 0X10,
        SIDEBAR_ABC_MODE          = 0x20,
            
        SPREADSHEET_MODE          = 0X14;

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
     * @var boolean
     */
    protected $useHeader = false;

    /**
     * Formatting parameters
     * @var array
     */
    protected $params = [
        'mode' => self::DEFAULT_MODE,
        'rotate' => false,
        'max_cell_length' => 100,
        'max_cell_ending' => '...',
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
     * @param mixed $data
     * @param array $params
     * @return string
     */
    public function format($data, $params = []) {
        $table = $data instanceof Table ? $data : new Table($data);
        $this->init($table, $params);
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
    protected function init(Table $table, $params = []) {
        $this->output = '';
        $this->setParams($params);
        $this->table = $table;
        if ($this->getParam('rotate') !== false) {
            $this->table->rotate($this->getParam('rotate'));
        }
        $this->initHeader();
        $this->initSidebar();
        $maxLength = $this->getParam('max_cell_length');
        $ending = $this->getParam('max_cell_ending');
        $this->table->truncate($maxLength, $ending);
    }
    
    /**
     * Initializes the header
     * @throws \LogicException
     */
    protected function initHeader() {
        $count = 0;
        $mode = $this->getParam('mode');
        $data = $this->table->getData();
        $x = $this->table->getDimensionX();
        
        if (($mode & self::HEADER_FIRST_ROW_MODE) === self::HEADER_FIRST_ROW_MODE) {
            $count++;
        }
        
        if (($mode & self::HEADER_ABC_MODE) === self::HEADER_ABC_MODE) {
            $data = array_merge([$this->getAbcRange($x)], $data);
            $count++;
        }
        
        if (($mode & self::HEADER_NUMERIC_MODE) === self::HEADER_NUMERIC_MODE) {
            $data = array_merge([range(1, $x)], $data);
            $count++;
        }
        
        if ($count > 1) {
            throw new \LogicException('There should be only one header.');
        }
        
        if ($count) {
            $this->useHeader = true;
            $this->table->setData($data);
        }
    }
    
    /**
     * Initializes the sidebar
     * @throws \LogicException
     */
    protected function initSidebar() {
        $count = 0;
        $mode = $this->getParam('mode');
        $data = $this->table->getData();
        
        if (($mode & self::SIDEBAR_ABC_MODE) === self::SIDEBAR_ABC_MODE) {
            $y = $this->table->getDimensionY();
            $abc = $this->getAbcRange($y);
            foreach ($data as $key => $val) {
                $data[$key] = array_merge([array_shift($abc)], $val);
            }
            $count++;
        }
        
        if (($mode & self::SIDEBAR_NUMERIC_MODE) === self::SIDEBAR_NUMERIC_MODE) {
            foreach ($data as $key => $val) {
                $data[$key] = array_merge([$key ? $key : ''], $val);
            }
            $count++;
        }
        
        if ($count > 1) {
            throw new \LogicException('There should be only one sidebar.');
        }
        
        if ($count) {
            $this->table->setData($data);
        }
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
     * Returns an array of letters for a spreadsheet header
     * @param int $length
     * @return array
     */
    final protected function getAbcRange($length) {
        $baseRange = range('A', 'Z');
        $range = range('A', 'Z');
        while (count($range) < $length && count($baseRange) > 1) {
            $letter = array_shift($baseRange);
            $tmpRange = range('A', 'Z');
            array_walk($tmpRange, function(&$e) use ($letter) { $e = $letter . $e; });
            $range = array_merge($range, $tmpRange);
        }
        return array_slice($range, 0, $length);
    }

    /**
     * Adds the top border to the output
     * @return void
     */
    protected function addTopBorder() {
        if ($this->metadata['top_border']) {
            $this->addRow(
                $this->metadata['top_border']['left'],
                $this->metadata['top_border']['middle'],
                $this->metadata['top_border']['right'],
                $this->metadata['top_border']['pad']
            );
        }
    }

    /**
     * Adds the header row to the output
     * @return void
     */
    protected function addHeader() {
        if ($this->useHeader) {
            $data = $this->table->getData();
            $x = $this->table->getDimensionX();
            $y = $this->table->getDimensionY();
            $this->addDataRow(array_shift($data));
            $this->addHeaderBorder();
            $this->table->setData($data, $x, $y);
        }
    }

    /**
     * Adds the rows to the output
     */
    protected function addRows() {
        $data = $this->table->getData();
        array_walk($data, [$this, 'addDataRow']);
    }

    /**
     * Adds the row with the specified data to the output
     * @param array $row
     * @return void
     */
    protected function addDataRow($row) {
        $this->addRow(
            $this->metadata['content']['left'],
            $this->metadata['content']['middle'],
            $this->metadata['content']['right'],
            $this->metadata['content']['pad'],
            $row
        );
    }

    /**
     * Adds the bottom border of the header to the output
     * @return void
     */
    protected function addHeaderBorder() {
        $this->addRow(
            $this->metadata['header']['left'],
            $this->metadata['header']['middle'],
            $this->metadata['header']['right'],
            $this->metadata['header']['pad']
        );
    }

    /**
     * Adds the bottom border to the output
     * @return void
     */
    protected function addBottomBorder() {
        if ($this->metadata['bottom_border']) {
            $this->addRow(
                $this->metadata['bottom_border']['left'],
                $this->metadata['bottom_border']['middle'],
                $this->metadata['bottom_border']['right'],
                $this->metadata['bottom_border']['pad']
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
            $maxLength = $this->table->getColumnsMaxLength($i);
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
