<?php


namespace Tools\AsciiTable;

use Tools\AsciiTable\Table;

interface ParserInterface
{
    /**
     * Parse input data to Table class
     *
     * @param $string string
     * @return Table
     */
    public function parse($data);
}