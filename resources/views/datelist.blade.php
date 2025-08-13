{{-- filepath: /Users/streynaldo/Documents/Work/WEB/padel-website/resources/views/cliplist.blade.php --}}
<x-client.layout>
    <x-slot:title>Court 1</x-slot:title>
    <div class="mx-auto text-start">
        {{-- Logo --}}
        <div class="mb-4">
            <img src="{{ asset('img/padeluplogodark.png') }}" alt="PadelUp! Logo" class="h-24">
        </div>
        <h1 class="text-xl md:text-4xl font-bold mb-2 text-primary font-sans">Choose Highlight Date</h1>
        <p class="text-sm md:text-lg text-secondary font-sans mb-2">
            Select a date to relive and analyze your best court moments!
        </p>
    </div>
    {{-- Back Button --}}
    <div class="mt-4">
        <a href="{{ route('dashboard') }}" class="inline-block px-4 py-2 bg-secondary hover:bg-green-900 text-white rounded-lg shadow hover:bg-opacity-90 transition">
            &larr; Back to Dashboard
        </a>
    </div>
    {{-- Video List --}}
    <div class="space-y-4 mt-8 w-full mx-auto">
        <x-core.date-card 
            title="Tue, 10 Oct 2023 12:00 - 13.00 WIB"
            href="https://example.com/videos/video1.mp4" 
        />
        <x-core.date-card 
            title="Tue, 10 Oct 2023 11:00 - 12.00 WIB"
            href="https://example.com/videos/video1.mp4" 
        />
        <x-core.date-card 
            title="Tue, 10 Oct 2023 10:00 - 11.00 WIB"
            href="https://example.com/videos/video1.mp4" 
        />
        <x-core.date-card 
            title="Tue, 10 Oct 2023 09:00 - 10.00 WIB"
            href="https://example.com/videos/video1.mp4" 
        />
    </div>
</x-client.layout>