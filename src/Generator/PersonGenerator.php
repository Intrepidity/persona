<?php
declare(strict_types=1);

namespace Intrepidity\Persona\Generator;

use Intrepidity\Persona\DataProvider\DateOfBirthProvider;
use Intrepidity\Persona\DataProvider\DateOfBirthProviderInterface;
use Intrepidity\Persona\DataProvider\EmailProvider;
use Intrepidity\Persona\DataProvider\EmailProviderInterface;
use Intrepidity\Persona\DataProvider\GenderProvider;
use Intrepidity\Persona\DataProvider\GenderProviderInterface;
use Intrepidity\Persona\DataProvider\NameProvider;
use Intrepidity\Persona\DataProvider\NameProviderInterface;
use Intrepidity\Persona\Entity\Person;
use Intrepidity\Persona\Exception\DataProviderException;
use RuntimeException;

class PersonGenerator implements PersonGeneratorInterface
{
    /** @var GenderProviderInterface */
    private $genderProvider;

    /** @var NameProviderInterface */
    private $nameProvider;

    /** @var DateOfBirthProviderInterface */
    private $dateOfBirthProvider;

    /** @var EmailProviderInterface */
    private $emailProvider;

    /**
     * @param GenderProviderInterface|null $genderProvider
     * @param NameProviderInterface|null $nameProvider
     * @param DateOfBirthProviderInterface|null $dateOfBirthProvider
     * @param EmailProviderInterface|null $emailProvider
     */
    public function __construct(
        ?GenderProviderInterface $genderProvider = null,
        ?NameProviderInterface $nameProvider = null,
        ?DateOfBirthProviderInterface $dateOfBirthProvider = null,
        ?EmailProviderInterface $emailProvider = null
    ) {
        $this->genderProvider = $genderProvider ?: new GenderProvider();
        $this->nameProvider = $nameProvider ?: new NameProvider();
        $this->dateOfBirthProvider = $dateOfBirthProvider ?: new DateOfBirthProvider();
        $this->emailProvider = $emailProvider ?: new EmailProvider();
    }

    /**
     * @param string $locale
     * @return Person
     * @throws RuntimeException
     */
    public function generate(string $locale): Person
    {
        $gender = $this->genderProvider->getRandomGender();

        try {
            $name = $this->nameProvider->getRandomNameForLocale($locale, $gender);

            return new Person(
                $gender,
                $name,
                $this->dateOfBirthProvider->getRandomDateOfBirth(),
                $this->emailProvider->getRandomEmailAddress($name, $locale)
            );
        } catch (DataProviderException $exception) {
            throw new RuntimeException("Failed to generate person", 0, $exception);
        }
    }
}
