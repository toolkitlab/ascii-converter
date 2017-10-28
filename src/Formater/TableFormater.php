<?php


namespace ToolkitLab\ASCII\Formater;


class TableFormater extends AbstractFormater
{
    protected $metadata = [
        "name" => "Table",
        "useHeader" => true,
        "useFooter" => true,
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
        "FPAD" => "-"
    ];
}