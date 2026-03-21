<?php

declare(strict_types=1);

namespace App\Interfaces;

interface CharacterSetInterface
{
    public function getCharacters(): string;
    public function getForbiddenCharacters(): string;
    public function getIdentifier(): string;
}
