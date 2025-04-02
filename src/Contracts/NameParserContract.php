<?php

namespace Street\Contracts;

interface NameParserContract
{
    public const array EMPTY_PERSON = [
        'title' => null,
        'first_name' => null,
        'initial' => null,
        'last_name' => null
    ];

    /**
     * Takes $names as a string and returns people in an array as defined in EMPTY_PERSON.
     *
     * @param string $names
     * @return array
     */
    public function parseNames(string $names): array;
}