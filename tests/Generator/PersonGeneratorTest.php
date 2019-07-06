<?php
declare(strict_types=1);

namespace Intrepidity\Persona\Tests\Generator;

use Intrepidity\Persona\DataProvider\DateOfBirthProviderInterface;
use Intrepidity\Persona\DataProvider\EmailProviderInterface;
use Intrepidity\Persona\DataProvider\GenderProviderInterface;
use Intrepidity\Persona\DataProvider\NameProviderInterface;
use Intrepidity\Persona\Entity\Name;
use Intrepidity\Persona\Exception\DataProviderException;
use Intrepidity\Persona\Generator\PersonGenerator;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use DateTime;

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

        $dateOfBirthProviderMock = $this->prophesize(DateOfBirthProviderInterface::class);
        $dateOfBirthProviderMock->getRandomDateOfBirth()->willReturn(
            new DateTime("03-02-1991")
        );

        $emailProviderMock = $this->prophesize(EmailProviderInterface::class);
        $emailProviderMock->getRandomEmailAddress(Argument::cetera())->willReturn('test.tester@example.com');

        $sut = new PersonGenerator(
            $genderProviderMock->reveal(),
            $nameProviderMock->reveal(),
            $dateOfBirthProviderMock->reveal(),
            $emailProviderMock->reveal()
        );

        $result = $sut->generate('nl_NL');
        $this->assertEquals('f', $result->getGender());
        $this->assertEquals('Test', $result->getName()->getFirstName());
        $this->assertEquals('Tester', $result->getName()->getLastName());
        $this->assertEquals('03-02-1991', $result->getDateOfBirth()->format('d-m-Y'));
        $this->assertEquals('test.tester@example.com', $result->getEmailAddress());
    }

    public function testGenerateHandlesDataProviderException()
    {
        $nameProviderMock = $this->prophesize(NameProviderInterface::class);
        $nameProviderMock->getRandomNameForLocale(Argument::exact('nl_NL'), Argument::exact('f'))->willThrow(
            new DataProviderException("Oops!")
        );

        $sut = new PersonGenerator(
            null,
            $nameProviderMock->reveal()
        );

        $this->expectException(\RuntimeException::class);
        $sut->generate('nl_NL');
    }
}
