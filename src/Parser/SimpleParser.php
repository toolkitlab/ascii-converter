<?php


namespace Tools\AsciiTable\Parser;

use Tools\AsciiTable\ParserInterface;
use Tools\AsciiTable\Table;


class SimpleParser implements ParserInterface
{
    public function parse($string)
    {
        $ret = [];

        $x = 0;
        $rows = explode("\n", $string);
        $y = count($rows);

        foreach ($rows as $row) {
            $cols = explode("\t", $row);
            $ret_row = [];
            $cnt = count($cols);
            if ($cnt > $x) $x = $cnt;
            foreach ($cols as $col) {
                $ret_row[] = $col;
            }
            $ret[] = $ret_row;
        }

        $table = new Table($ret, $x, $y);
        return $table;
    }
}