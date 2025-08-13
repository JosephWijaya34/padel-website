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
    </div>
    {{-- grid 2 --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8 justify-items-center w-full mx-auto md:px-4">
        <x-core.button>
            <x-slot:nolapangan>1</x-slot:nolapangan>
        </x-core.button>
        <x-core.button>
            <x-slot:nolapangan>2</x-slot:nolapangan>
        </x-core.button>
    </div>
</x-client.layout>
