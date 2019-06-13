# Builders

### What are Builders?
Builders are a way of creating new objects from classes that maybe have a lot of
parameters to initialise in the constructor, in a readable manner. They allow you
to create new objects without the use of the `new` keyword or a Factory.

### Why use Builders?
They offer the following pros:
- Easy object immutability
- Readable instantiation of classes
- Classes with a large number of instantiatable properties are far more maintainable
- Constructor order handled by builder so setup can be done in any order

### Examples

Given the following file structure:

```
|-- src
    |-- DataModels
        |-- Person.php
        |-- Builders
            |-- PersonBuilder.php
```

__src/DataModels/Person.php__
```php
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
```

__src/DataModels/Builders/PersonBuilder.php__
```php
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
```

__Usage__
```php
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
```

---

There is a very small, unrealistic example of a Builder pattern in-use, but there
are some things to note.

- Builders are only really useful with classes that have very large constructors.
- The primary reason for using a Builder over Setters is immutability.

---

Using Setters would look like so:

```php
$person = new Person();
$person->setFirstName("John");
$person->setLastName("Doe");
$person->setAge(97);
```

Setters are the way of getting around having `public` properties, so with them
we can still have `private` properties, however they are _mutable_ (changeable).

A Builder is essentially a mutable "middleman" between the user and the intended class
which allows you to have both immutability _and_ private properties without using
the `new` keyword and without using large constructors in order to achieve it.

---

With smaller classes you can achieve this with a Factory.

__src/DataModels/Factories__
```php
<?php

class PersonFactory
{
    public static function createPerson($firstName, $lastName, $age)
    {
        return new Person($firstName, $lastName, $age);
    }
}
```

__Usage__
```php
$person = PersonFactory::createPerson("John", "Doe", 97);
```

This achieves the same result with a smaller constructor and makes it quite clear what
the advantages of Builders are when you have 4+ constructor parameters.

---

### Side note

Ideally when using a Factory you can make them non-static and add them to the
ServiceProvider. That isn't as practical with a Builder as you ideally
want to couple them together and "get" the builder statically from the
intended Class.