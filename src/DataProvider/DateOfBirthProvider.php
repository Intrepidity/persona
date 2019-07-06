<?php
declare(strict_types=1);

namespace Intrepidity\Persona\DataProvider;

use Exception;
use DateTime;
use Intrepidity\Persona\Exception\DataProviderException;

class DateOfBirthProvider implements DateOfBirthProviderInterface
{
    /**
     * @param int $minimumAge
     * @param int $maximumAge
     * @return DateTime
     * @throws DataProviderException
     */
    public function getRandomDateOfBirth(int $minimumAge = 18, int $maximumAge = 100): DateTime
    {
        try {
            $age = random_int($minimumAge, $maximumAge);
            $latestDayOfBirth = (new DateTime('now'))->modify("-{$age} years");
            $substractedDays = random_int(1, 365);

            return $latestDayOfBirth->modify("-{$substractedDays} days");
        } catch (Exception $exception) {
            throw new DataProviderException('Failed generating random DoB', 0, $exception);
        }
    }
}
