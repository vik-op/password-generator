<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\CharacterSetInterface;

class UpperCaseSet implements CharacterSetInterface
{
    public function getCharacters(): string
    {
        return 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    }

    public function getForbiddenCharacters(): string
    {
        return 'oO';
    }

    public function getIdentifier(): string
    {
        return 'upper';
    }
}
