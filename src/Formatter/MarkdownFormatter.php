<?php

namespace ToolkitLab\ASCII\Formatter;

use ToolkitLab\ASCII\AbstractFormatter;

class MarkdownFormatter extends AbstractFormatter {

    protected $metadata = [
        'name' => 'Markdown',
        'content' => [
            'left' => '|',
            'middle' => '|',
            'right' => '|',
            'pad' => ' ',
        ],
        'top_border' => false,
        'header' => [
            'left' => '|',
            'middle' => '|',
            'right' => '|',
            'pad' => '-',
        ],
        'bottom_border' => false,
    ];

}
