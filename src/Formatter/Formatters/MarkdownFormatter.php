<?php

namespace ToolkitLab\ASCII\Formatter\Formatters;

use ToolkitLab\ASCII\Formatter\AbstractFormatter;

class MarkdownFormatter extends AbstractFormatter {

    protected $metadata = [
        "name" => "Markdown",
        "topBorder" => false,
        "bottomBorder" => false,
        "isSeparated" => false,
        "BL" => "|",
        "BR" => "|",
        "BM" => "|",
        "HBL" => "|",
        "HBR" => "|",
        "HBM" => "|",
        "HPAD" => "-",
        "H2BL" => "|",
        "H2BR" => "|",
        "H2BM" => "|",
        "H2PAD" => "-",
        "BBL" => "+",
        "BBR" => "+",
        "BBM" => "+",
        "BPAD" => "-",
        "FBL" => "|",
        "FBR" => "|",
        "FBM" => "|",
        "FPAD" => "-"
    ];

}
