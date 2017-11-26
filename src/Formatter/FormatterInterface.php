<?php


namespace ToolkitLab\ASCII\Formatter;


interface FormatterInterface
{
    /**
     * @param array $data
     * @param array $params
     * @return string
     */
    public function format($data, $params = []);
}