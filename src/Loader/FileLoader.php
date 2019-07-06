<?php
declare(strict_types=1);

namespace Intrepidity\Persona\Loader;

class FileLoader implements FileLoaderInterface
{
    /** @var string */
    private $basePath;

    /**
     * @param string|null $basePath
     */
    public function __construct(?string $basePath = null)
    {
        $this->basePath = $basePath ?: __DIR__ . '/../../data/';
    }

    /**
     * @param string $fileName
     * @return string
     */
    public function getContents(string $fileName): string
    {
        return file_get_contents(
            str_replace('//', '/', $this->basePath . $fileName)
        );
    }

    /**
     * @param string $fileName
     * @return array
     */
    public function getJsonContents(string $fileName): array
    {
        return json_decode(
            $this->getContents($fileName),
            true
        );
    }
}
