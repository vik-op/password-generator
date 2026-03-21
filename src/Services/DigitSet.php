<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\CharacterSetInterface;

class DigitSet implements CharacterSetInterface
{
    public function getCharacters(): string
    {
        return '0123456789';
    }
    public function getForbiddenCharacters(): string
    {
        return '01';
    }
    public function getIdentifier(): string
    {
        return 'digits';
    }
}
