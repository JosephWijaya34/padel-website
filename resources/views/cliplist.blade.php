<x-client.layout>
    <x-slot:title>{{ $courtName ?? 'Court' }}</x-slot:title>
    <div class="mx-auto text-start">
        {{-- Logo --}}
        <div class="mb-4">
            <img src="{{ asset('img/padeluplogodark.png') }}" alt="PadelUp! Logo" class="h-24">
        </div>
        <h1 class="text-xl md:text-4xl font-bold mb-2 text-primary font-sans">Choose Your Highlight</h1>
        <p class="text-sm md:text-lg text-secondary font-sans mb-2">
            {{ $timeSlot ?? 'Session' }} - Relive your best moments by selecting your highlight!
        </p>

        {{-- Display error message if any --}}
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- Back Button --}}
    <div class="mt-4">
        @if (isset($bookingHour) && isset($bookingHour->courtId))
            <a href="/booking-hours/court/{{ $bookingHour->courtId }}"
                class="inline-block px-4 py-2 bg-secondary hover:bg-green-900 text-white rounded-lg shadow hover:bg-opacity-90 transition">
                &larr; Back to Date List
            </a>
        @else
            <a href="{{ route('dashboard') }}"
                class="inline-block px-4 py-2 bg-secondary hover:bg-green-900 text-white rounded-lg shadow hover:bg-opacity-90 transition">
                &larr; Back to Dashboard
            </a>
        @endif
    </div>

    {{-- Dynamic Video List from API --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8 w-full mx-auto">
        @forelse($clips ?? [] as $clip)
            <x-core.preview-card
                jam="{{ \Carbon\Carbon::parse($clip->createdAtUtc ?? $clip->createdAt)->format('H:i') }} WIB"
                videoUrl="{{ $clip->streamUrl ?? '#' }}"
                downloadUrl="{{ route('clips.download', $clip->id) }}" />
        @empty
            {{-- Empty state jika tidak ada clips --}}
            <div class="col-span-full text-center py-12">
                <div class="text-6xl text-gray-300 mb-4">🎥</div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">No Highlights Available</h3>
                <p class="text-gray-500 mb-4">There are no video clips for this time slot yet.</p>
                @if (isset($bookingHour) && isset($bookingHour->courtId))
                    <a href="/booking-hours/court/{{ $bookingHour->courtId }}" class="text-blue-500 hover:underline">←
                        Back to Date List</a>
                @else
                    <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">← Back to Dashboard</a>
                @endif
            </div>
        @endforelse
    </div>

    {{-- Pagination Links --}}
    <div class="mt-4 {{ $clips->isEmpty() ? 'hidden' : '' }}">
        {{-- Ensure links are only shown if there are booking hours --}}
        {{ $clips->links() }}
    </div>
</x-client.layout>
