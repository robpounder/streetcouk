<?php

namespace Street\Services;

use Street\Contracts\NameParserContract;

class HomeOwnerNameParser implements NameParserContract
{
    public function parseNames(string $names): array
    {
        $people = [];

        $names = str_replace(' and ', ',', $names);
        $names = str_replace(' & ', ',', $names);#
        $nameParts = explode(',', $names);

        $nameOne = $nameParts[0];
        $nameTwo = $nameParts[1] ?? null;
        $defaultSurname = '';
        if (isset($nameTwo)) {
            $explodedNameTwo = explode(' ', $nameTwo);
            $defaultSurname = end($explodedNameTwo);
        }

        $person1 = $this->parseName($nameOne, $defaultSurname);
        if (isset($nameTwo)) {
            $person2 = $this->parseName($nameTwo);
        }

        $people[] = $person1;
        if (isset($person2)) {
            $people[] = $person2;
        }

        return $people;
    }

    private function parseName(string $name, string $defaultSurname = ''): array
    {
        $person = self::EMPTY_PERSON;
        $nameParts = explode(' ', $name);
        $person['title'] = $nameParts[0];
        if (count($nameParts) === 1) {
            $person['last_name'] = $defaultSurname;
        } elseif (count($nameParts) === 2) {
            $person['last_name'] = $nameParts[1];
        } elseif (count($nameParts) === 3) {
            if ($this->isInitial($nameParts[1])) {
                $person['initial'] = trim(str_replace('.', '', $nameParts[1]));
            } else {
                $person['first_name'] = $nameParts[1];
            }
            $person['last_name'] = $nameParts[2];
        }

        return $person;
    }

    private function isInitial($firstName): bool
    {
        $firstName = trim(str_replace('.', '', $firstName));

        return strlen($firstName) === 1;
    }
}