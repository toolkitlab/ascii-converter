<?php

namespace ToolkitLab\ASCII\Formatter;

use ToolkitLab\ASCII\AbstractFormatter;

class MysqlFormatter extends AbstractFormatter {

    protected $metadata = [
        'name' => 'Mysql',
        'content' => [
            'left' => '|',
            'middle' => '|',
            'right' => '|',
            'pad' => ' ',
        ],
        'top_border' => [
            'left' => '+',
            'middle' => '+',
            'right' => '+',
            'pad' => '-',
        ],
        'header' => [
            'left' => '+',
            'middle' => '+',
            'right' => '+',
            'pad' => '-',
        ],
        'bottom_border' => [
            'left' => '+',
            'middle' => '+',
            'right' => '+',
            'pad' => '-'
        ],
    ];

}
