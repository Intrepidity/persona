<?php
declare(strict_types=1);

namespace Intrepidity\Persona\Entity;

class Person
{
    /** @var Name */
    private $name;

    /** @var string|null */
    private $emailAddress;

    /** @var string|null */
    private $phoneNumber;

    /** @var Address|null */
    private $address;

    /**
     * @param Name $name
     * @param string $emailAddress
     * @param string $phoneNumber
     * @param Address|null $address
     */
    public function __construct(Name $name, ?string $emailAddress, ?string $phoneNumber, ?Address $address)
    {
        $this->name = $name;
        $this->emailAddress = $emailAddress;
        $this->phoneNumber = $phoneNumber;
        $this->address = $address;
    }

    /**
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @param Name $name
     * @return Person
     */
    public function withName(Name $name): Person
    {
        $person = clone $this;
        $person->name = $name;

        return  $person;
    }

    /**
     * @return string
     */
    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    /**
     * @param string $emailAddress
     * @return Person
     */
    public function withEmailAddress(string $emailAddress): Person
    {
        $person = clone $this;
        $person->emailAddress = $emailAddress;

        return $person;
    }

    /**
     * @return string
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     * @return Person
     */
    public function withPhoneNumber(string $phoneNumber): Person
    {
        $person = clone $this;
        $person->phoneNumber = $phoneNumber;

        return $person;
    }

    /**
     * @return Address|null
     */
    public function getAddress(): ?Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return Person
     */
    public function withAddress(Address $address): Person
    {
        $person = clone $this;
        $person->address = $address;

        return $person;
    }
}
