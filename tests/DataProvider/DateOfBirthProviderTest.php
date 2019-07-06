<?php
declare(strict_types=1);

namespace Intrepidity\Persona\Tests\DataProvider;

use Intrepidity\Persona\DataProvider\DateOfBirthProvider;
use PHPUnit\Framework\TestCase;
use DateTime;

class DateOfBirthProviderTest extends TestCase
{
    public function testGetRandomDateOfBirthReturnsValidAge()
    {
        $sut = new DateOfBirthProvider();

        $result = $sut->getRandomDateOfBirth(18, 18);

        $this->assertEquals(
            18,
            $result->diff(new DateTime('now'))->y
        );
    }
}
