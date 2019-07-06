<?php
declare(strict_types=1);

namespace Intrepidity\Persona\DataProvider;

use DateTime;

interface DateOfBirthProviderInterface
{
    public function getRandomDateOfBirth(int $minimumAge = 18, int $maximumAge = 100): DateTime;
}
