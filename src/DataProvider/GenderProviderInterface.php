<?php
declare(strict_types=1);

namespace Intrepidity\Persona\DataProvider;

interface GenderProviderInterface
{
    public function getRandomGender(): string;
}
