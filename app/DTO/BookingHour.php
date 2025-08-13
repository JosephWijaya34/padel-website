<?php

namespace App\DTO;

use Carbon\CarbonImmutable;

final class BookingHour
{
    public function __construct(
        public readonly int $id,
        public readonly int $courtId,
        public readonly CarbonImmutable $dateStartUtc,
        public readonly CarbonImmutable $dateEndUtc,
        public readonly CarbonImmutable $createdAtUtc,
        public readonly CarbonImmutable $updatedAtUtc,
        public readonly ?Court $court, // nested court (opsional)
    ) {}

    /** payload: objek booking hour langsung */
    public static function fromArray(array $a): self
    {
        // handle nested court kalau ada
        $court = null;
        if (!empty($a['court']) && is_array($a['court'])) {
            $court = Court::fromArray($a['court']);
        }

        return new self(
            id:        (int) $a['id'],
            courtId:   (int) ($a['courtId'] ?? $a['court_id']),
            dateStartUtc: new CarbonImmutable($a['dateStart']),
            dateEndUtc:   new CarbonImmutable($a['dateEnd']),
            createdAtUtc: new CarbonImmutable($a['createdAt'] ?? $a['created_at']),
            updatedAtUtc: new CarbonImmutable($a['updatedAt'] ?? $a['updated_at']),
            court:     $court,
        );
    }

    /** payload: envelope { message, data, success } */
    public static function fromEnvelope(array $payload): self
    {
        return self::fromArray($payload['data'] ?? []);
    }

    /** (opsional) untuk dipakai ulang di view/json internal */
    public function toArray(): array
    {
        return [
            'id'         => $this->id,
            'courtId'    => $this->courtId,
            'dateStart'  => $this->dateStartUtc->toIso8601String(),
            'dateEnd'    => $this->dateEndUtc->toIso8601String(),
            'createdAt'  => $this->createdAtUtc->toIso8601String(),
            'updatedAt'  => $this->updatedAtUtc->toIso8601String(),
            'court'      => $this->court ? [
                'id'        => $this->court->id,
                'name'      => $this->court->name,
                'createdAt' => $this->court->createdAtUtc->toIso8601String(),
                'updatedAt' => $this->court->updatedAtUtc->toIso8601String(),
            ] : null,
        ];
    }
}
