{{-- filepath: /Users/streynaldo/Documents/Work/WEB/padel-website/resources/views/datelist.blade.php --}}
<x-client.layout>
    <x-slot:title>{{ $courtName ?? 'Court' }}</x-slot:title>
    <div class="mx-auto text-start">
        {{-- Logo --}}
        <div class="mb-4">
            <img src="{{ asset('img/padeluplogodark.png') }}" alt="PadelUp! Logo" class="h-24">
        </div>
        <h1 class="text-xl md:text-4xl font-bold mb-2 text-primary font-sans">Choose Highlight Date</h1>
        <p class="text-sm md:text-lg text-secondary font-sans mb-2">
            Select a date to relive and analyze your best court moments!
        </p>

        {{-- Display error message if any --}}
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- Back Button --}}
    <div class="mt-4">
        <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 bg-secondary hover:bg-green-900 text-white rounded-lg shadow hover:bg-opacity-90 transition">
            &larr; Back to Dashboard
        </a>
    </div>

    {{-- Dynamic Booking Hours List --}}
    <div class="space-y-4 mt-8 w-full mx-auto">
        @forelse($bookingHours ?? [] as $bookingHour)
            <x-core.date-card
                title="{{ $bookingHour->dateStartUtc->format('D, d M Y H:i') }} - {{ $bookingHour->dateEndUtc->format('H:i') }} WIB"
                href="{{ route('clips.by-booking-hour', $bookingHour->id) }}"
                bookingHourId="{{ $bookingHour->id }}"
            />
        @empty
            <div class="text-center py-8">
                <p class="text-gray-500">No booking sessions available for this court.</p>
                <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline mt-2 inline-block">← Back to Courts</a>
            </div>
        @endforelse
    </div>
</x-client.layout>
