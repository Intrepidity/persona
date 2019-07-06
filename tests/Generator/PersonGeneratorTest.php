<?php
declare(strict_types=1);

namespace Intrepidity\Persona\Tests\Generator;

use Intrepidity\Persona\DataProvider\GenderProviderInterface;
use Intrepidity\Persona\DataProvider\NameProviderInterface;
use Intrepidity\Persona\Entity\Name;
use Intrepidity\Persona\Entity\Person;
use Intrepidity\Persona\Exception\DataProviderException;
use Intrepidity\Persona\Generator\PersonGenerator;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

class PersonGeneratorTest extends TestCase
{
    public function testGenerateReturnsPerson()
    {
        $genderProviderMock = $this->prophesize(GenderProviderInterface::class);
        $genderProviderMock->getRandomGender()->willReturn('f');

        $nameProviderMock = $this->prophesize(NameProviderInterface::class);
        $nameProviderMock->getRandomNameForLocale(Argument::exact('nl_NL'), Argument::exact('f'))->willReturn(
            new Name('T', 'Test', 'Tester')
        );

        $sut = new PersonGenerator(
            $genderProviderMock->reveal(),
            $nameProviderMock->reveal()
        );

        $result = $sut->generate('nl_NL');
        $this->assertEquals('f', $result->getGender());
        $this->assertEquals('Test', $result->getName()->getFirstName());
        $this->assertEquals('Tester', $result->getName()->getLastName());
    }

    public function testGenerateHandlesDataProviderException()
    {
        $genderProviderMock = $this->prophesize(GenderProviderInterface::class);
        $genderProviderMock->getRandomGender()->willReturn('f');

        $nameProviderMock = $this->prophesize(NameProviderInterface::class);
        $nameProviderMock->getRandomNameForLocale(Argument::exact('nl_NL'), Argument::exact('f'))->willThrow(
            new DataProviderException("Oops!")
        );

        $sut = new PersonGenerator(
            $genderProviderMock->reveal(),
            $nameProviderMock->reveal()
        );

        $this->expectException(\RuntimeException::class);
        $sut->generate('nl_NL');
    }
}
