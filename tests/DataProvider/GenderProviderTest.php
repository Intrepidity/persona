<?php
declare(strict_types=1);

namespace Intrepidity\Persona\Tests\DataProvider;

use Intrepidity\Persona\DataProvider\GenderProvider;
use PHPUnit\Framework\TestCase;

class GenderProviderTest extends TestCase
{
    public function testGetRandomGenderReturnsValidValue()
    {
        $sut = new GenderProvider();

        for ($i = 0; $i < 10; $i++)
        {
            $result = $sut->getRandomGender();
            $this->assertContains($result, ['m', 'f']);
        }
    }
}
