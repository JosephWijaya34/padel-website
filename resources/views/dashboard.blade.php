<x-client.layout>
    <x-slot:title>Dashboard</x-slot:title>
    <div class="mx-auto text-start md:px-4">
        {{-- Logo --}}
        <div class="mb-4">
            <img src="{{ asset('img/padeluplogodark.png') }}" alt="PadelUp! Logo" class="h-24">
        </div>
        <h1 class="text-xl md:text-4xl font-bold mb-2 text-primary font-sans">Choose Your Court</h1>
        <p class="text-sm md:text-lg text-secondary font-sans mb-2">
            Relive your best moments on the court! Click on a court number below to watch the recordings and analyze your gameplay.
        </p>

        {{-- Display error message if any --}}
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif
    </div>

    {{-- Dynamic grid based on courts data from API --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8 justify-items-center w-full mx-auto md:px-4">
        @forelse($courts ?? [] as $court)
            <x-core.button>
                <x-slot:nolapangan>{{ $court->name }}</x-slot:nolapangan>
                <x-slot:courtId>{{ $court->id }}</x-slot:courtId>
                <x-slot:gambar>{{ $court->id == 1 ? asset('img/lapaquviva.jpeg') : asset('img/lapisoplus.jpeg') }}</x-slot:gambar>
                <x-slot:action>{{ route('booking-hours.by-court', $court->id) }}</x-slot:action>
            </x-core.button>
        @empty
            {{-- Fallback static courts if API fails or no data --}}
            <x-core.button>
                <x-slot:nolapangan>Court 1 (Static)</x-slot:nolapangan>
            </x-core.button>
            <x-core.button>
                <x-slot:nolapangan>Court 2 (Static)</x-slot:nolapangan>
            </x-core.button>
        @endforelse
    </div>
</x-client.layout>
