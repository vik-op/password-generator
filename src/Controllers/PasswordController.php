<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\PasswordGenerator;
use App\Services\DigitSet;
use App\Services\UpperCaseSet;
use App\Services\LowerCaseSet;
use App\Services\FileHistoryStorage;
use Throwable;
use RuntimeException;

class PasswordController
{
    public function generate(array $data): string
    {
        $availableSets = [
            new DigitSet(),
            new UpperCaseSet(),
            new LowerCaseSet()
        ];

        $activeSets = [];
        foreach ($availableSets as $set) {
            if (isset($data[$set->getIdentifier()]) && $data[$set->getIdentifier()] === true) {
                $activeSets[] = $set;
            }
        }

        $length = (int)($data['length'] ?? 0);
        $activeSetsCount = count($activeSets);

        if ($length < 1 || $length > 32 || $activeSetsCount === 0) {
            return json_encode([
                'success' => false,
                'message' => 'Invalid parameters: length must be 1-32 and at least one set selected.'
            ]);
        }

        if ($length < $activeSetsCount) {
            return json_encode([
                'success' => false,
                'message' => 'The length is too short to include characters from all selected sets.'
            ]);
        }

        try {
            $generator = new PasswordGenerator($length, $activeSets);
            $storage = new FileHistoryStorage(__DIR__ . '/../../data/passwords.txt');

            $attempts = 0;
            do {
                $password = $generator->generate();
                $attempts++;
                if ($attempts > 100) {
                    throw new RuntimeException("Could not generate a unique password after 100 attempts.");
                }
            } while (!$storage->isUnique($password));

            $storage->save($password);

            return json_encode([
                'success' => true,
                'password' => $password
            ]);
        } catch (Throwable $e) {
            return json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
