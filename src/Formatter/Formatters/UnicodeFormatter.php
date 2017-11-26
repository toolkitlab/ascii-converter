<?php

namespace ToolkitLab\ASCII\Formatter\Formatters;

use ToolkitLab\ASCII\Formatter\AbstractFormatter;

class UnicodeFormatter extends AbstractFormatter {

    protected $metadata = [
        'name' => 'Unicode',
        'topBorder' => true,
        'bottomBorder' => true,
        'isSeparated' => false,
        'BL' => '║',
        'BR' => '║',
        'BM' => '║',
        'HBL' => '╔',
        'HBR' => '╗',
        'HBM' => '╦',
        'HPAD' => '═',
        'H2BL' => '╠',
        'H2BR' => '╣',
        'H2BM' => '╬',
        'H2PAD' => '═',
        'BBL' => '║',
        'BBR' => '║',
        'BBM' => '║',
        'BPAD' => '═',
        'FBL' => '╚',
        'FBR' => '╝',
        'FBM' => '╩',
        'FPAD' => '═',
    ];

}
