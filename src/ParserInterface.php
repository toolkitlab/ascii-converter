<?php


namespace ToolkitLab\ASCII;

use ToolkitLab\ASCII\Table;

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