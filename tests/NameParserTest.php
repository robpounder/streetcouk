<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Street\Contracts\NameParserContract;
use Street\Services\HomeOwnerNameParser;

class NameParserTest extends TestCase
{
    private NameParserContract $parser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->parser = new HomeownerNameParser();
    }

    public function testParsingNames()
    {
        $this->assertEquals([
            [
                'title' => 'Mr',
                'first_name' => 'John',
                'initial' => null,
                'last_name' => 'Smith'
            ]
        ], $this->parser->parseNames('Mr John Smith'));

        $this->assertEquals([
            [
                'title' => 'Mr',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Smith'
            ],
            [
                'title' => 'Mrs',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Smith'
            ]
        ], $this->parser->parseNames('Mr and Mrs Smith'));

        $this->assertEquals([
            [
                'title' => 'Mr',
                'first_name' => null,
                'initial' => 'J',
                'last_name' => 'Smith'
            ]
        ], $this->parser->parseNames('Mr J. Smith'));
    }
}