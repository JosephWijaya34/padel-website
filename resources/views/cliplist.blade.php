{{-- filepath: /Users/streynaldo/Documents/Work/WEB/padel-website/resources/views/cliplist.blade.php --}}
<x-client.layout>
    <x-slot:title>Court 1</x-slot:title>
    <div class="mx-auto text-start">
        {{-- Logo --}}
        <div class="mb-4">
            <img src="{{ asset('img/padeluplogodark.png') }}" alt="PadelUp! Logo" class="h-24">
        </div>
        <h1 class="text-xl md:text-4xl font-bold mb-2 text-primary font-sans">Choose Your Highlight</h1>
        <p class="text-sm md:text-lg text-secondary font-sans mb-2">
            Relive your best moments by selecting your highlight!
        </p>
    </div>
    {{-- Back Button --}}
    <div class="mt-4">
        <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 bg-secondary hover:bg-green-900 text-white rounded-lg shadow hover:bg-opacity-90 transition">
            &larr; Back to Date
        </a>
    </div>
    {{-- Video List --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8 w-full mx-auto">
        <x-core.preview-card 
            jam="12:12 WIB"
            videoUrl="https://example.com/videos/video1.mp4" 
        />
        <x-core.preview-card 
            jam="12:20 WIB"
            videoUrl="https://example.com/videos/video1.mp4" 
        />
        <x-core.preview-card 
            jam="12:25 WIB"
            videoUrl="https://example.com/videos/video1.mp4" 
        />
        <x-core.preview-card 
            jam="12:40 WIB"
            videoUrl="https://example.com/videos/video1.mp4" 
        />
    </div>
</x-client.layout>