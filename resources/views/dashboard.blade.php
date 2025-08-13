<x-client.layout>
    <x-slot:title>Dashboard</x-slot:title>
    <div class="mx-auto text-start md:px-4 py-8 bg-cover bg-center">
        <h1 class="text-4xl font-bold mb-4 text-primary font-sans">Choose Your Court</h1>
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
