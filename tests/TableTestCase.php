<?php


namespace ToolkitLab\ASCII\Test;

use PHPUnit\Framework\TestCase;
use ToolkitLab\ASCII\Table;

class TableTestCase extends TestCase
{
    public function getTestTable($dimensions = false) {
        $data = [["qweqwe","asd"], ["qaz", "wsx"], ["qw", "er"]];
        $table = $dimensions ? new Table($data, 20, 20) : new Table($data);
        return $table;
    }
}