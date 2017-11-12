<?php

namespace ToolkitLab\ASCII\Formatter;

use ToolkitLab\ASCII\Table;

class MysqlFormatter extends AbstractFormatter {

    protected $metadata = [
        "name" => "Mysql",
        "useHeader" => true,
        "useFooter" => true,
        "isSeparated" => false,
        "BL" => "|",
        "BR" => "|",
        "BM" => "|",
        "HBL" => "+",
        "HBR" => "+",
        "HBM" => "+",
        "HPAD" => "-",
        "H2BL" => "+",
        "H2BR" => "+",
        "H2BM" => "+",
        "H2PAD" => "-",
        "BBL" => "+",
        "BBR" => "+",
        "BBM" => "+",
        "BPAD" => "-",
        "FBL" => "+",
        "FBR" => "+",
        "FBM" => "+",
        "FPAD" => "-"
    ];

}
