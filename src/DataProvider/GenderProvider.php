<?php
declare(strict_types=1);

namespace Intrepidity\Persona\DataProvider;

use Intrepidity\Persona\Entity\Person;

class GenderProvider implements GenderProviderInterface
{
    /**
     * @return string
     */
    public function getRandomGender(): string
    {
        $genders = [
            Person::GENDER_MALE,
            Person::GENDER_FEMALE
        ];

        return $genders[array_rand($genders)];
    }
}
