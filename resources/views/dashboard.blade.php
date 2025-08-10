<x-client.layout>
    <x-slot:title>Dashboard</x-slot:title>
    <div class="container mx-auto text-center px-4 py-8">
        <h1 class="text-4xl font-bold mb-4">Pilih Court</h1>
    </div>
    {{-- grid 2 --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8 justify-items-center w-full mx-auto">
        <x-core.button>
            <x-slot:nolapangan>1</x-slot:nolapangan>
        </x-core.button>
        <x-core.button>
            <x-slot:nolapangan>2</x-slot:nolapangan>
        </x-core.button>
        <x-core.button>
            <x-slot:nolapangan>3</x-slot:nolapangan>
        </x-core.button>
        <x-core.button>
            <x-slot:nolapangan>4</x-slot:nolapangan>
        </x-core.button>
    </div>
</x-client.layout>
