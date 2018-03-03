<?php


namespace ToolkitLab\ASCII;


interface FormatterInterface
{
    /**
     * @param array $data
     * @param array $params
     * @return string
     */
    public function format($data, $params = []);
}