<?php

namespace ToolkitLab\ASCII\Formater;

class UnicodeFormater extends AbstractFormater
{
    public function __construct()
    {
        $this->metadata = [
            "name"=> "Unicode",
            "useHeader"=>true,
            "useFooter"=> true,
            "isSeparated"=> false,
            "BL" => json_decode('"\u2551"'),
            "BR" => json_decode('"\u2551"'),
            "BM" => json_decode('"\u2551"'),
            "HBL" => json_decode('"\u2554"'),
            "HBR" => json_decode('"\u2557"'),
            "HBM" => json_decode('"\u2566"'),
            "HPAD" => json_decode('"\u2550"'),
            "H2BL" => json_decode('"\u2560"'),
            "H2BR" => json_decode('"\u2563"'),
            "H2BM" => json_decode('"\u256C"'),
            "H2PAD" => json_decode('"\u2550"'),
            "BBL" => json_decode('"\u2551"'),
            "BBR" => json_decode('"\u2551"'),
            "BBM" => json_decode('"\u2551"'),
            "BPAD" => json_decode('"\u2550"'),
            "FBL" => json_decode('"\u255A"'),
            "FBR" => json_decode('"\u255D"'),
            "FBM" => json_decode('"\u2569"'),
            "FPAD" => json_decode('"\u2550"')
        ];
    }
}