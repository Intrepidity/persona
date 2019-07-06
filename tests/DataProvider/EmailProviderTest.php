<?php
declare(strict_types=1);

namespace Intrepidity\Persona\Tests\DataProvider;

use Intrepidity\Persona\DataProvider\EmailProvider;
use Intrepidity\Persona\Entity\Name;
use Intrepidity\Persona\Exception\DataProviderException;
use Intrepidity\Persona\Loader\FileLoaderInterface;
use PHPUnit\Framework\TestCase;
use Intrepidity\Persona\DataProvider\NameProvider;
use Prophecy\Argument;

class EmailProviderTest extends TestCase
{
    public function testGetRandomNameForLocaleReturnsName()
    {
        $loaderMock = $this->prophesize(FileLoaderInterface::class);
        $loaderMock->getJsonContents(Argument::exact('nl_NL/parameters.json'))->willReturn([
            'tld' => 'nl'
        ]);

        $sut = new EmailProvider($loaderMock->reveal());

        $result = $sut->getRandomEmailAddress(new Name('T', 'Test', 'de Tester'), 'nl_NL');
        $this->assertEquals('test.de-tester@example.nl', $result);
    }
}
