<?php

class Person
{
    /**
     * @var string
     */
    private $firstName;
    private $lastName;

    /**
     * @var int
     */
    private $age;

    /**
     * Person constructor.
     * @param  string  $firstName
     * @param  string  $lastName
     * @param  int     $age
     */
    public function __construct(
        $firstName,
        $lastName,
        $age
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return bool
     */
    public function isOfLegalDrinkingAge()
    {
        return $this->age >= 18;
    }

    /**
     * @return PersonBuilder
     */
    public static function getBuilder()
    {
        return new PersonBuilder();
    }
}