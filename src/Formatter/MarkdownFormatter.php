<?php

namespace ToolkitLab\ASCII\Formatter;

class MarkdownFormatter extends AbstractFormatter {

    protected $metadata = [
        "name" => "Markdown",
        "useHeader" => false,
        "useFooter" => false,
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
