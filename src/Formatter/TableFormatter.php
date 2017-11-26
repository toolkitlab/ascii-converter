<?php

namespace ToolkitLab\ASCII\Formatter;

use ToolkitLab\ASCII\AbstractFormatter;

class TableFormatter extends AbstractFormatter {

    protected $metadata = [
        'name' => 'Table',
        'content' => [
            'left' => '|',
            'middle' => '|',
            'right' => '|',
            'pad' => ' ',
        ],
        'top_border' => [
            'left' => ' ',
            'middle' => ' ',
            'right' => ' ',
            'pad' => '_',
        ],
        'header' => [
            'left' => '|',
            'middle' => '|',
            'right' => '|',
            'pad' => '_',
        ],
        'bottom_border' => [
            'left' => ' ',
            'middle' => ' ',
            'right' => ' ',
            'pad' => '¯'
        ],
    ];

}
