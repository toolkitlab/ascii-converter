<?php


namespace Tools\AsciiTable\Formater;

use Tools\AsciiTable\Table;

class MysqlFormater extends AbstractFormater
{
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