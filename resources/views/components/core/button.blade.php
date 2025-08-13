<div
    class="btn-primary transform hover:scale-105 transition-transform duration-300 shadow-lg relative w-full bg-secondary border border-gray-300 rounded-lg overflow-hidden">
    <a href="{{ $action }}" class="block relative group">
        <img class="rounded-t-lg w-full h-96 object-cover transition-transform duration-300 group-hover:scale-110"
            src="{{ asset('/img/lapangan.png') }}" alt="Lapangan" />
        <div
            class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent flex items-end justify-start transition-opacity duration-300">
            <h5
                class="text-secondary text-md md:text-xl font-semibold px-4 py-2 bg-background bg-opacity-75 rounded-tr-lg group-hover:bg-opacity-90 font-display">
                {{ $nolapangan }}
            </h5>
        </div>
    </a>
</div>
