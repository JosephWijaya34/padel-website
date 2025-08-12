<?php

namespace App\Services;

use App\DTO\Court;
use \App\DTO\BookingHour;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ExternalApiClient
{
    /** @return Court[] */
    public function courts(): array
    {
        return Cache::remember('ext:courts', now()->addMinutes(5), function () {
            $res = Http::clipping()->get('/api/v1/courts');

            if ($res->failed()) {
                Log::warning('GET /v1/courts failed', [
                    'status' => $res->status(),
                    'body'   => $res->body(),
                ]);
                $res->throw();
            }

            $rows = $res->json('data') ?? $res->json() ?? [];
            // handle kalau API sewaktu-waktu balikin object tunggal:
            $rows = is_array($rows) && array_is_list($rows) ? $rows : (is_array($rows) ? [$rows] : []);

            return array_map(fn($r) => Court::fromArray($r), $rows);
        });
    }

    public function court(int|string $courtId): ?Court
    {
        $res = Http::clipping()->get("/api/v1/courts/{$courtId}");

        if ($res->status() === 404) {
            return null;
        }

        if ($res->failed()) {
            Log::warning('GET /api/v1/courts/{id} failed', [
                'courtId' => $courtId,
                'status'  => $res->status(),
                'body'    => $res->body(),
            ]);
            $res->throw();
        }

        return Court::fromEnvelope($res->json());
    }

    public function bookingHours(): array
    {
        return Cache::remember('ext:booking-hours', now()->addMinutes(2), function () {
            $res = Http::clipping()->get('/api/v1/booking-hours'); // per body yang kamu kirim

            if ($res->failed()) {
                Log::warning('GET /api/v1/booking-hours failed', [
                    'status' => $res->status(),
                    'body'   => $res->body(),
                ]);
                $res->throw();
            }

            // envelope: { message, data: [...], success }
            $rows = $res->json('data') ?? [];

            // pastikan array list
            if (!is_array($rows)) $rows = [];

            return array_map(fn($r) => BookingHour::fromArray($r), $rows);
        });
    }

    public function bookingHour(int|string $bookingHourId): ?BookingHour
    {
        $res = Http::clipping()->get("/api/v1/booking-hours/{$bookingHourId}");

        if ($res->status() === 404) {
            return null;
        }

        if ($res->failed()) {
            Log::warning('GET /api/v1/booking-hours/{id} failed', [
                'bookingHourId' => $bookingHourId,
                'status'        => $res->status(),
                'body'          => $res->body(),
            ]);
            $res->throw();
        }

        // respons punya envelope {message, data, success}
        return BookingHour::fromEnvelope($res->json());
    }
}
