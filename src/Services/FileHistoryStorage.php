<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\StorageInterface;

class FileHistoryStorage implements StorageInterface
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
        $directory = dirname($this->filePath);

        if (!is_dir($directory)) {
            mkdir($directory, 0700, true);
        }

        if (!file_exists($this->filePath)) {
            touch($this->filePath);
        }
    }

    public function isUnique(string $password): bool
    {
        $history = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($history === false) {
            return true;
        }

        return !in_array($password, $history, true);
    }

    public function save(string $password): void
    {
        file_put_contents($this->filePath, $password . PHP_EOL, FILE_APPEND);
    }
}
