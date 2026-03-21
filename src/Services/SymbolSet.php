<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\CharacterSetInterface;

class SymbolSet implements CharacterSetInterface
{
    public function getCharacters(): string
    {
        return '!@#$%^&*';
    }

    public function getForbiddenCharacters(): string
    {
        return '!';
    }

    public function getIdentifier(): string
    {
        return 'symbol';
    }
}
