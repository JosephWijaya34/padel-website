<?php

namespace App\DTO;

use Carbon\CarbonImmutable;

final class Court
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly CarbonImmutable $createdAtUtc,
        public readonly CarbonImmutable $updatedAtUtc,
    ) {}

    /** Map objek court mentah → DTO */
    public static function fromArray(array $a): self
    {
        return new self(
            id: (int) $a['id'],
            name: (string) $a['name'],
            createdAtUtc: new CarbonImmutable($a['createdAt'] ?? $a['created_at']),
            updatedAtUtc: new CarbonImmutable($a['updatedAt'] ?? $a['updated_at']),
        );
    }

    /**
     * Kalau API bungkus di envelope {"message","data","success"},
     * pakai helper ini biar aman.
     */
    public static function fromEnvelope(array $payload): self
    {
        return self::fromArray($payload['data'] ?? $payload);
    }

    public function toArray(): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'createdAt' => $this->createdAtUtc->toIso8601String(),
            'updatedAt' => $this->updatedAtUtc->toIso8601String(),
        ];
    }
}
