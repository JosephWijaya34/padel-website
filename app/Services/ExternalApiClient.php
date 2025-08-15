<?php

namespace App\Services;

use App\DTO\Court;
use \App\DTO\BookingHour;
use \App\DTO\Clip;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ExternalApiClient
{
    // get /api/v1/courts untuk ambil semua lapangan
    /** @return Court[] */
    public function courts(): array
    {
        $res = Http::clipping()->get('/api/v1/courts');

        if ($res->failed()) {
            Log::warning('GET /api/v1/courts failed', [
                'status' => $res->status(),
                'body'   => $res->body(),
            ]);
            $res->throw();
        }

        $rows = $res->json('data') ?? $res->json() ?? [];
        // handle kalau API sewaktu-waktu balikin object tunggal:
        $rows = is_array($rows) && array_is_list($rows) ? $rows : (is_array($rows) ? [$rows] : []);

        return array_map(fn($r) => Court::fromArray($r), $rows);
    }

    // get /api/v1/courts/{id} untuk ambil detail lapangan
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

    // get /api/v1/booking-hours untuk ambil semua jam booking
    public function bookingHours(): array
    {
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
    }

    // get /api/v1/booking-hours/{id} untuk ambil detail jam booking
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

    /** GET /api/v1/booking-hours/court/{courtId}
     *  @return BookingHour[]
     */
    public function bookingHoursByCourt(int|string $courtId): array
    {
        $res = Http::clipping()->get("/api/v1/booking-hours/court/{$courtId}");

        if ($res->failed()) {
            Log::warning('GET /api/v1/booking-hours/court/{$courtId} failed', [
                'courtId' => $courtId,
                'status'  => $res->status(),
                'body'    => $res->body(),
            ]);
            $res->throw();
        }

        $rows = $res->json('data') ?? [];
        if (!is_array($rows)) {
            $rows = [];
        }

        return array_map(fn($r) => BookingHour::fromArray($r), $rows);
    }

    /** GET /api/v1/clips/bookingHour/{bookingHourId}
     *  @return Clip[]
     */
    public function clipsByBookingHour(int|string $bookingHourId): array
    {
        // cache singkat karena list clip bisa sering berubah saat upload/processing
        $cacheKey = "ext:clips:bh:{$bookingHourId}";

            $res = Http::clipping()->get("/api/v1/clips/bookingHour/{$bookingHourId}");

            if ($res->failed()) {
                Log::warning('GET clips by bookingHour failed', [
                    'bookingHourId' => $bookingHourId,
                    'status'        => $res->status(),
                    'body'          => $res->body(),
                ]);
                $res->throw();
            }

            $rows = $res->json('data') ?? [];
            if (!is_array($rows)) $rows = [];

            return array_map(fn($r) => Clip::fromArray($r), $rows);
    }

    // get /api/v1/clips/clipp/{id} untuk ambil detail clip
    public function clipById(int|string $clipId): ?Clip
    {
        $res = Http::clipping()->get("/api/v1/clips/clipp/{$clipId}");

        if ($res->status() === 404) {
            return null;
        }

        if ($res->failed()) {
            Log::warning('GET /api/v1/clips/clipp/{id} failed', [
                'clipId' => $clipId,
                'status' => $res->status(),
                'body'   => $res->body(),
            ]);
            $res->throw();
        }

        return Clip::fromEnvelope($res->json());
    }
}
