<?php

namespace App\Http\Controllers;

use App\Services\ExternalApiClient;
use Illuminate\Pagination\LengthAwarePaginator;

class ExternalController extends Controller
{
    // constructor untuk dependency injection
    public function __construct(private ExternalApiClient $api) {}

    // COURTS
    public function courtsIndex()
    {
        try {
            $courts = $this->api->courts();

            // Sort courts berdasarkan ID (ascending) agar dimulai dari ID 1
            $courts = collect($courts)->sortBy('id')->values()->all();

            return view('dashboard', compact('courts'));
        } catch (\Exception $e) {
            // Jika API gagal, tetap tampilkan dashboard dengan array kosong dan error message
            $courts = [];
            return view('dashboard', compact('courts'))->with('error', 'Failed to load courts from API');
        }
    }

    // Function get court detail
    // public function courtShow(string $id)
    // {
    //     $court = $this->api->court($id);
    //     dd($court);
    //     abort_if(!$court, 404);
    //     return view('ext.court-show', compact('court'));
    // }

    //get all BOOKING HOURS
    // public function bookingHoursIndex()
    // {
    //     $items = $this->api->bookingHours();
    //     dd($items);
    //     return view('ext.booking-hours-index', ['bookingHours' => $items]);
    // }

    // Function get Booking Hour by Id
    // public function bookingHourShow(string $id)
    // {
    //     $bh = $this->api->bookingHour($id);
    //     dd($bh);
    //     abort_if(!$bh, 404);
    //     return view('ext.booking-hour-show', compact('bh'));
    // }

    // Function get Booking Hours by Court Id
    public function bookingHoursByCourt(string $courtId)
    {
        try {
            $items = $this->api->bookingHoursByCourt($courtId);

            // Sort booking hours berdasarkan tanggal dan waktu start (ascending)
            $bookingHours = collect($items)->sortBy('dateStartUtc')->values();

            // Get court info from first booking hour or use courtId as fallback
            $courtName = !empty($bookingHours) && $bookingHours->first()->court
                ? $bookingHours->first()->court->name
                : "Court $courtId";

            // Pagination logic
            $perPage = 10; // Jumlah item per halaman
            $currentPage = request()->get('page', 1); // Halaman saat ini
            $currentItems = $bookingHours->slice(($currentPage - 1) * $perPage, $perPage)->values(); // Data untuk halaman saat ini

            // Buat paginator manual
            $paginatedBookingHours = new LengthAwarePaginator(
                $currentItems, // Data untuk halaman saat ini
                $bookingHours->count(), // Total item
                $perPage, // Jumlah item per halaman
                $currentPage, // Halaman saat ini
                ['path' => request()->url(), 'query' => request()->query()] // URL dan query string
            );

            return view('datelist', [
                'bookingHours' => $paginatedBookingHours,
                'courtId' => $courtId,
                'courtName' => $courtName
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to load booking hours for this court');
        }
    }

    // Function get Clip by booking Hour Id
    public function clipsByBookingHour(string $bookingHourId)
    {
        try {
            $clips = $this->api->clipsByBookingHour($bookingHourId);

            // Get booking hour info untuk context
            $bookingHour = $this->api->bookingHour($bookingHourId);

            // Create context untuk cliplist view
            $timeSlot = $bookingHour
                ? $bookingHour->dateStartUtc->format('D, d M Y H:i') . ' - ' . $bookingHour->dateEndUtc->format('H:i') . ' WIB'
                : "Time Slot $bookingHourId";

            // Generate streaming URLs untuk setiap clip
            $streamingBaseUrl = config('iot.streaming_url');
            $clipsWithStreamUrl = collect($clips)->map(function ($clip) use ($streamingBaseUrl) {
                // Generate full streaming URL dengan menggabungkan base URL + file path
                $streamUrl = $streamingBaseUrl && $clip->filePath
                    ? rtrim($streamingBaseUrl, '/') . '/' . ltrim($clip->filePath, '/')
                    : null;

                // Convert clip object to array untuk modifikasi
                $clipArray = $clip->toArray();
                $clipArray['streamUrl'] = $streamUrl;

                return (object) $clipArray;
            });

            // Pagination logic
            $perPage = 10; // Jumlah item per halaman
            $currentPage = request()->get('page', 1); // Halaman saat ini
            $currentItems = $clipsWithStreamUrl->slice(($currentPage - 1) * $perPage, $perPage)->values(); // Data untuk halaman saat ini

            // Buat paginator manual
            $paginatedClips = new LengthAwarePaginator(
                $currentItems, // Data untuk halaman saat ini
                $clipsWithStreamUrl->count(), // Total item
                $perPage, // Jumlah item per halaman
                $currentPage, // Halaman saat ini
                ['path' => request()->url(), 'query' => request()->query()] // URL dan query string
            );

            return view('cliplist', [
                'clips' => $paginatedClips,
                'bookingHourId' => $bookingHourId,
                'timeSlot' => $timeSlot,
                'bookingHour' => $bookingHour
            ]);
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
