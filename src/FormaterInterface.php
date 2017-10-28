<?php


namespace ToolkitLab\ASCII;


interface FormaterInterface
{
    /**
     * @param Table $table
     * @param bool $firstRowAsHeader
     * @return string
     */
    public function format(Table $table, $firstRowAsHeader = true);
}