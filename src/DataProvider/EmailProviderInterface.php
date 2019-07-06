<?php
declare(strict_types=1);

namespace Intrepidity\Persona\DataProvider;

use Intrepidity\Persona\Entity\Name;

interface EmailProviderInterface
{
    public function getRandomEmailAddress(Name $name, string $locale): string;
}
