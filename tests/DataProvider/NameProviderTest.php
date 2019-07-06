<?php
declare(strict_types=1);

namespace Intrepidity\Persona\Tests\DataProvider;

use Intrepidity\Persona\Entity\Name;
use Intrepidity\Persona\Exception\DataProviderException;
use Intrepidity\Persona\Loader\FileLoaderInterface;
use PHPUnit\Framework\TestCase;
use Intrepidity\Persona\DataProvider\NameProvider;
use Prophecy\Argument;

class NameProviderTest extends TestCase
{
    public function testGetRandomNameForLocaleReturnsName()
    {
        $loaderMock = $this->prophesize(FileLoaderInterface::class);
        $loaderMock->getJsonContents(Argument::exact('nl_NL/names.json'))->willReturn([
            'firstNames' => [
                'm' => [
                    'SomeName'
                ],
                'f' => [
                    'SomeOtherName'
                ]
            ],
            'lastNames' => [
                'Tester'
            ]
        ]);

        $sut = new NameProvider($loaderMock->reveal());

        $result = $sut->getRandomNameForLocale('nl_NL', 'm');
        $this->assertInstanceOf(Name::class, $result);
        $this->assertEquals('SomeName', $result->getFirstName());
        $this->assertEquals('Tester', $result->getLastName());

        $result = $sut->getRandomNameForLocale('nl_NL', 'f');
        $this->assertInstanceOf(Name::class, $result);
        $this->assertEquals('SomeOtherName', $result->getFirstName());
        $this->assertEquals('Tester', $result->getLastName());
    }

    public function testGetRandomNameForLocaleThrowsExceptionWhenDataIsMissing()
    {
        $loaderMock = $this->prophesize(FileLoaderInterface::class);
        $loaderMock->getJsonContents(Argument::exact('nl_NL/names.json'))->willReturn([
            'firstNames' => [
                'm' => [],
                'f' => []
            ],
            'lastNames' => []
        ]);
        $sut = new NameProvider();

        $this->expectException(DataProviderException::class);
        $sut->getRandomNameForLocale('nl_NL', 'm');
    }
}
