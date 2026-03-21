<?php

declare(strict_types=1);

namespace App\Interfaces;

interface StorageInterface
{
    public function isUnique(string $password): bool;
    public function save(string $password): void;
}
