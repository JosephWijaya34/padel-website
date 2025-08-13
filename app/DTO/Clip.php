<?php

namespace App\DTO;

use Carbon\CarbonImmutable;

final class Clip
{
    public function __construct(
        public readonly int $id,
        public readonly int $bookingHourId,
        public readonly string $name,
        public readonly string $filePath,
        public readonly CarbonImmutable $createdAtUtc,
        public readonly CarbonImmutable $updatedAtUtc,
    ) {}

    public static function fromArray(array $a): self
    {
        return new self(
            id: (int) $a['id'],
            bookingHourId: (int) $a['bookingHourId'],
            name: (string) $a['name'],
            filePath: (string) $a['filePath'],
            createdAtUtc: new CarbonImmutable($a['createdAt'] ?? $a['created_at']),
            updatedAtUtc: new CarbonImmutable($a['updatedAt'] ?? $a['updated_at']),
        );
    }

    public static function fromEnvelope(array $payload): self
    {
        return self::fromArray($payload['data'] ?? []);
    }

    public function publicUrl(?string $filesBaseUrl = null): ?string
    {
        if (!$filesBaseUrl) return null;
        return rtrim($filesBaseUrl, '/') . '/' . ltrim($this->filePath, '/');
    }

    public function downloadFilename(): string
    {
        return $this->name !== '' ? $this->name : basename($this->filePath);
    }

    public function toArray(): array
    {
        return [
            'id'            => $this->id,
            'bookingHourId' => $this->bookingHourId,
            'name'          => $this->name,
            'filePath'      => $this->filePath,
            'createdAt'     => $this->createdAtUtc->toIso8601String(),
            'updatedAt'     => $this->updatedAtUtc->toIso8601String(),
        ];
    }
}
