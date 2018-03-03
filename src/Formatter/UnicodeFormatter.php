<?php

namespace ToolkitLab\ASCII\Formatter;

use ToolkitLab\ASCII\AbstractFormatter;

class UnicodeFormatter extends AbstractFormatter {

    protected $metadata = [
        'name' => 'Unicode',
        'content' => [
            'left' => '║',
            'right' => '║',
            'middle' => '║',
            'pad' => ' ',
        ],
        'top_border' => [
            'left' => '╔',
            'middle' => '╦',
            'right' => '╗',
            'pad' => '═',
        ],
        'header' => [
            'left' => '╠',
            'right' => '╣',
            'middle' => '╬',
            'pad' => '═',
        ],
        'bottom_border' => [
            'left' => '╚',
            'middle' => '╩',
            'right' => '╝',
            'pad' => '═',
        ],
    ];

}
