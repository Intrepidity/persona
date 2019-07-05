<?php
declare(strict_types=1);

namespace Intrepidity\Persona\Entity;

class Name
{
    /** @var string */
    private $initials;

    /** @var string */
    private $firstName;

    /** @var string */
    private $lastNamePrefix;

    /** @var string */
    private $lastName;

    /**
     * @param string $initials
     * @param string $firstName
     * @param string $lastName
     * @param string $lastNamePrefix
     */
    public function __construct(string $initials, string $firstName, string $lastName, string $lastNamePrefix = '')
    {
        $this->initials = $initials;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->lastNamePrefix = $lastNamePrefix;
    }

    /**
     * @return string
     */
    public function getInitials(): string
    {
        return $this->initials;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastNamePrefix(): string
    {
        return $this->lastNamePrefix;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }
}
