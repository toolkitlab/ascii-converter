<?php

namespace ToolkitLab\ASCII\Formatter\Formatters;

use ToolkitLab\ASCII\Formatter\AbstractFormatter;

class DotsFormatter extends AbstractFormatter {

    protected $metadata = [
        "name" => "Dots",
        "topBorder" => true,
        "bottomBorder" => true,
        "isSeparated" => false,
        "BL" => ":",
        "BR" => ":",
        "BM" => ":",
        "HBL" => ".",
        "HBR" => ".",
        "HBM" => ".",
        "HPAD" => ".",
        "H2BL" => ":",
        "H2BR" => ":",
        "H2BM" => ":",
        "H2PAD" => ".",
        "BBL" => ":",
        "BBR" => ":",
        "BBM" => ":",
        "BPAD" => ".",
        "FBL" => ":",
        "FBR" => ":",
        "FBM" => ":",
        "FPAD" => "."
    ];

}
