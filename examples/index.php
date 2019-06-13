<?php

$person = Person::getBuilder()
    ->withFirstName("John")
    ->withLastName("Doe")
    ->withAge(97)
    ->build();

if ($person->isOfLegalDrinkingAge()) {
    // Serve him a drink!
    echo 'Have a drink!';
}