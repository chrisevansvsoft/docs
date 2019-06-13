<?php

class PersonBuilder
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
     * @param  string  $firstName
     * @return $this
     */
    public function withFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @param  string  $lastName
     * @return $this
     */
    public function withLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @param  int  $age
     * @return $this
     */
    public function withAge($age)
    {
        $this->age = $age;
        return $this;
    }

    /**
     * @return Person
     */
    public function build()
    {
        return new Person(
            $this->firstName,
            $this->lastName,
            $this->age
        );
    }
}