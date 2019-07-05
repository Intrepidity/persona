<?php
declare(strict_types=1);

namespace Intrepidity\Persona\Entity;

class Address
{
    /** @var string */
    private $streetName;

    /** @var string */
    private $houseNumber;

    /** @var string|null */
    private $houseNumberAddition;

    /** @var string */
    private $postalCode;

    /** @var string */
    private $city;

    /** @var string|null */
    private $state;

    /** @var string */
    private $country;

    /**
     * @param string $streetName
     * @param string $houseNumber
     * @param string $postalCode
     * @param string $city
     * @param string $country
     * @param string|null $houseNumberAddition
     * @param string|null $state
     */
    public function __construct(string $streetName, string $houseNumber, string $postalCode, string $city, string $country, ?string $houseNumberAddition, ?string $state)
    {
        $this->streetName = $streetName;
        $this->houseNumber = $houseNumber;
        $this->houseNumberAddition = $houseNumberAddition;
        $this->postalCode = $postalCode;
        $this->city = $city;
        $this->state = $state;
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getStreetName(): string
    {
        return $this->streetName;
    }

    /**
     * @return string
     */
    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    /**
     * @return string|null
     */
    public function getHouseNumberAddition(): ?string
    {
        return $this->houseNumberAddition;
    }

    /**
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string|null
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }
}
