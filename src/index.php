<?php

require_once __DIR__.'/../vendor/autoload.php';

use Street\Services\HomeOwnerNameParser;

$parser = new HomeOwnerNameParser();

$csvFilePath = __DIR__ . '/../examples-4-.csv';

if (($handle = fopen($csvFilePath, 'r')) !== false) {
    $header = fgetcsv($handle);
    while (($data = fgetcsv($handle)) !== false) {
        $name = $data[0];

        $parsedNames = $parser->parseNames($name);

        echo "Parsed names for '{$name}':\n";
        foreach ($parsedNames as $person) {
            echo "Title: {$person['title']}\n";
            echo "First Name: {$person['first_name']}\n";
            echo "Initial: {$person['initial']}\n";
            echo "Last Name: {$person['last_name']}\n";
            echo "-----------------------\n";
        }
    }
    fclose($handle);
} else {
    echo "Error: Unable to open the CSV file.\n";
}
