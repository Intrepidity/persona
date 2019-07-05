<?php
declare(strict_types=1);

namespace Intrepidity\Persona\Generator;

use Intrepidity\Persona\Entity\Person;

interface PersonGeneratorInterface
{
    public function generate(string $locale): Person;
}
