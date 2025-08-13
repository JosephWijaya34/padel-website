<?php

namespace App\Http\Controllers;

use App\Services\ExternalApiClient;

class ExternalController extends Controller
{
    // constructor untuk dependency injection
    public function __construct(private ExternalApiClient $api) {}

    // COURTS
    public function courtsIndex()
    {
        try {
            $courts = $this->api->courts();
            dd($courts);
            return view('ext.courts-index', compact('courts'));
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load courts');
        }
    }

    // Function get court detail
    public function courtShow(string $id)
    {
        $court = $this->api->court($id);
        dd($court);
        abort_if(!$court, 404);
        return view('ext.court-show', compact('court'));
    }

    //get all BOOKING HOURS
    public function bookingHoursIndex()
    {
        $items = $this->api->bookingHours();
        dd($items);
        return view('ext.booking-hours-index', ['bookingHours' => $items]);
    }

    // Function get Booking Hour by Id
    public function bookingHourShow(string $id)
    {
        $bh = $this->api->bookingHour($id);
        dd($bh);
        abort_if(!$bh, 404);
        return view('ext.booking-hour-show', compact('bh'));
    }

    // Function get Booking Hours by Court Id
    public function bookingHoursByCourt(string $courtId)
    {
        $items = $this->api->bookingHoursByCourt($courtId);
        dd($items);
        return view('ext.booking-hours-by-court', [
            'bookingHours' => $items,
            'courtId'      => $courtId,
        ]);
    }

    // Function get Clip by booking Hour Id
    public function clipsByBookingHour(string $bookingHourId)
    {
        try {
            $clips = $this->api->clipsByBookingHour($bookingHourId);
            dd($clips);
            return view('ext.clips-by-booking-hour', compact('clips', 'bookingHourId'));
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', 'Gagal memuat clips dari API.');
        }
    }

    public function redirectDownload(string $clipId)
    {
        try {
            $clip = $this->api->clipById($clipId);

            // Check if clip exists
            abort_if(!$clip, 404, 'Clip not found');

            // Double-safety: pastikan filePath relatif
            $filePath = ltrim($clip->filePath, '/');
            $base = rtrim((string) config('iot.base_url'), '/');
            abort_if(!$base, 500, 'Files base URL not configured');

            $url = "{$base}/{$filePath}";

            // Debug: lihat URL yang di-generate
            // dd([
            //     'clip' => $clip,
            //     'base_url' => $base,
            //     'file_path' => $filePath,
            //     'final_url' => $url,
            // ]);

            return redirect()->away($url);
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', 'Failed to download clip: ' . $e->getMessage());
        }
    }
}
