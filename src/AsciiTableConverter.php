<?php

namespace ToolkitLab\ASCII;

use ToolkitLab\ASCII\Parser\SimpleParser;

class AsciiTableConverter {

    /**
     * @var Table
     */
    private $table;
    private $parser;

    public function __construct(ParserInterface $parser = null) {
        if (is_null($parser)) {
            $this->parser = new SimpleParser();
        } else {
            $this->parser = $parser;
        }
    }

    /**
     * @param ParserInterface $parser
     */
    public function setParser($parser) {
        $this->parser = $parser;
    }

    /**
     * @param string $data
     */
    public function setData($data) {
        $this->table = $this->parser->parse($data);
    }

}
