<?php

class PersonFactory
{
    public static function createPerson($firstName, $lastName, $age)
    {
        return new Person($firstName, $lastName, $age);
    }
}