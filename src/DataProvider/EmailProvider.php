<?php
declare(strict_types=1);

namespace Intrepidity\Persona\DataProvider;

use Intrepidity\Persona\Entity\Name;
use Intrepidity\Persona\Loader\FileLoader;
use Intrepidity\Persona\Loader\FileLoaderInterface;

class EmailProvider implements EmailProviderInterface
{
    /** @var FileLoaderInterface */
    private $fileLoader;

    /**
     * @param FileLoaderInterface|null $fileLoader
     */
    public function __construct(?FileLoaderInterface $fileLoader = null)
    {
        $this->fileLoader = $fileLoader ?: new FileLoader();
    }

    /**
     * @param Name $name
     * @param string $locale
     * @return string
     */
    public function getRandomEmailAddress(Name $name, string $locale): string
    {
        $parameters = $this->fileLoader->getJsonContents("{$locale}/parameters.json");

        return str_replace('..', '.', sprintf(
            '%s.%s.%s@example.%s',
            strtolower($name->getFirstName()),
            str_replace(' ', '-', strtolower($name->getLastNamePrefix())),
            str_replace(' ', '-', strtolower($name->getLastName())),
            $parameters['tld']
        ));
    }
}
