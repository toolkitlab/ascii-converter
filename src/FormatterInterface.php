<?php


namespace ToolkitLab\ASCII;


interface FormatterInterface
{
    /**
     * @param Table $table
     * @param bool $firstRowAsHeader
     * @return string
     */
    public function format(Table $table, $firstRowAsHeader = true);
}