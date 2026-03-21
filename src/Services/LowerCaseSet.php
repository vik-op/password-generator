<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\CharacterSetInterface;

class LowerCaseSet implements CharacterSetInterface
{
    public function getCharacters(): string
    {
        return 'abcdefghijklmnopqrstuvwxyz';
    }

    public function getForbiddenCharacters(): string
    {
        return 'l';
    }

    public function getIdentifier(): string
    {
        return 'lower';
    }
}
