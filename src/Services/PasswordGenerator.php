<?php

declare(strict_types=1);

namespace App\Services;

use RuntimeException;

class PasswordGenerator
{
    public function __construct(
        private int $length,
        private array $selectedSets
    ) {
    }

    public function generate(): string
    {
        $password = [];
        $allAllowed = '';
        $allForbidden = '';

        foreach ($this->selectedSets as $set) {
            $allAllowed .= $set->getCharacters();
            $allForbidden .= $set->getForbiddenCharacters();
        }

        $forbiddenArray = str_split($allForbidden);
        foreach ($this->selectedSets as $set) {
            $setChars = array_diff(str_split($set->getCharacters()), $forbiddenArray);
            $setChars = array_values($setChars);
            $password[] = $setChars[random_int(0, count($setChars) - 1)];
        }

        $pool = array_diff(array_unique(str_split($allAllowed)), $forbiddenArray, $password);

        if (count($password) + count($pool) < $this->length) {
            throw new RuntimeException("Not enough unique characters.");
        }

        shuffle($pool);
        $result = array_merge($password, array_slice($pool, 0, $this->length - count($password)));
        shuffle($result);

        return implode('', $result);
    }
}
