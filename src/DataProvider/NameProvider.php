<?php
declare(strict_types=1);

namespace Intrepidity\Persona\DataProvider;

use Intrepidity\Persona\Entity\Name;
use Intrepidity\Persona\Exception\DataProviderException;
use Intrepidity\Persona\Loader\FileLoader;
use Intrepidity\Persona\Loader\FileLoaderInterface;

class NameProvider implements NameProviderInterface
{
    /** @var string */
    const PATH_TO_NAME_DATA = '{locale}/names.json';

    /** @var FileLoaderInterface */
    private $fileLoader;

    /** @param FileLoaderInterface|null $fileLoader */
    public function __construct(?FileLoaderInterface $fileLoader = null)
    {
        $this->fileLoader = $fileLoader ?: new FileLoader();
    }

    /**
     * @param string $locale
     * @param string $gender
     * @return Name
     * @throws DataProviderException
     */
    public function getRandomNameForLocale(string $locale, string $gender): Name
    {
        $fileName = str_replace('{locale}', $locale, self::PATH_TO_NAME_DATA);
        $nameData = $this->fileLoader->getJsonContents($fileName);

        $lastNames = $nameData['lastNames'];
        $firstNames = $nameData['firstNames'][$gender];

        if (count($lastNames) === 0 || count($firstNames) === 0) {
            throw new DataProviderException("Name data not set for {$locale}");
        }

        return new Name(
            'T',
            $firstNames[array_rand($firstNames)],
            $lastNames[array_rand($lastNames)]
        );
    }
}
