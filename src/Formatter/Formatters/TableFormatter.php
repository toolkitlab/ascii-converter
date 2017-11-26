<?php

namespace ToolkitLab\ASCII\Formatter\Formatters;

use ToolkitLab\ASCII\Formatter\AbstractFormatter;

class TableFormatter extends AbstractFormatter {

    protected $metadata = [
        "name" => "Table",
        "topBorder" => true,
        "bottomBorder" => true,
        "isSeparated" => false,
        "BL" => "|",
        "BR" => "|",
        "BM" => "|",
        "HBL" => " ",
        "HBR" => " ",
        "HBM" => " ",
        "HPAD" => "_",
        "H2BL" => "|",
        "H2BR" => "|",
        "H2BM" => "|",
        "H2PAD" => "_",
        "BBL" => "|",
        "BBR" => "|",
        "BBM" => "|",
        "BPAD" => "-",
        "FBL" => " ",
        "FBR" => " ",
        "FBM" => " ",
        "FPAD" => "¯"
    ];

}
