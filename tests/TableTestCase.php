<?php


namespace ToolkitLab\ASCII\Test;

use PHPUnit\Framework\TestCase;
use ToolkitLab\ASCII\Table;

class TableTestCase extends TestCase
{
    public function getTestTable() {
        $data = [["qweqwe","asd"], ["qaz", "wsx"], ["qw", "er"]];
        $table = new Table($data);
        return $table;
    }
}