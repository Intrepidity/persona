<?php
declare(strict_types=1);

namespace Intrepidity\Persona\DataProvider;

use Intrepidity\Persona\Entity\Name;

interface NameProviderInterface
{
    public function getRandomNameForLocale(string $locale, string $gender): Name;
}
