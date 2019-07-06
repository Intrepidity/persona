<?php
declare(strict_types=1);

namespace Intrepidity\Persona\Loader;

interface FileLoaderInterface
{
    public function getContents(string $fileName): string;

    public function getJsonContents(string $fileName): array;
}
