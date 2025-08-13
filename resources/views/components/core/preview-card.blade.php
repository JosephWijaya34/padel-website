@props(['jam', 'videoUrl', 'downloadUrl'])

<div class="relative w-full h-auto rounded-lg overflow-hidden shadow-lg group">
    {{-- Video Player --}}
    <video controls class="w-full h-64 object-cover">
        <source src="{{ $videoUrl }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    {{-- Text Content --}}
    <div class="p-4 bg-white flex justify-between items-center">
        {{-- Time --}}
        <p class="text-sm md:text-lg font-semibold text-secondary font-sans">{{ $jam }}</p>
        {{-- Download Button --}}
        <div class="">
            <a href="{{ $downloadUrl }}" class="inline-block px-4 py-2 bg-cta text-white rounded-lg shadow hover:bg-darker-coral transition">
                Download
            </a>
        </div>
    </div>
</div>
