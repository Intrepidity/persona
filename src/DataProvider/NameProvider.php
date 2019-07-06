<?php
declare(strict_types=1);

namespace Intrepidity\Persona\DataProvider;

use Intrepidity\Persona\Entity\Name;
use Intrepidity\Persona\Exception\DataProviderException;
use Intrepidity\Persona\Loader\FileLoader;
use Intrepidity\Persona\Loader\FileLoaderInterface;

class NameProvider implements NameProviderInterface
{
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
        $fileName = "{$locale}/names.json";
        $nameData = $this->fileLoader->getJsonContents($fileName);

        $lastNames = $nameData['lastNames'];
        $firstNames = $nameData['firstNames'][$gender];

        if (count($lastNames) === 0 || count($firstNames) === 0) {
            throw new DataProviderException("Name data not set for {$locale}");
        }

        $firstName = $firstNames[array_rand($firstNames)];
        $parsedLastName = $this->parseLastName(
            $locale,
            $lastNames[array_rand($lastNames)]
        );

        return new Name(
            strtoupper(substr($firstName, 0, 1)),
            $firstName,
            $parsedLastName['lastName'],
            $parsedLastName['lastNamePrefixes']
        );
    }

    private function parseLastName(string $locale, string $lastName): array
    {
        $parameters = $this->fileLoader->getJsonContents("{$locale}/parameters.json");

        if (array_key_exists('name', $parameters) &&
            array_key_exists('lastName', $parameters['name']) &&
            array_key_exists('format', $parameters['name']['lastName']) &&
            array_key_exists('formatGroupDefinition', $parameters['name']['lastName'])
        ) {
            preg_match(
                $parameters['name']['lastName']['format'],
                $lastName,
                $output
            );

            $parsedName = [];
            foreach ($parameters['name']['lastName']['formatGroupDefinition'] as $key => $position) {
                $parsedName[$key] = $output[$position] ?: '';
            }

            return $parsedName;
        } else {
            return [
                "lastName" => $lastName,
                "lastNamePrefixes" => ""
            ];
        }
    }
}
