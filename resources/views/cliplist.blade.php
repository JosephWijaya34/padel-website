{{-- filepath: /Users/streynaldo/Documents/Work/WEB/padel-website/resources/views/cliplist.blade.php --}}
<x-client.layout>
    <x-slot:title>Court 1</x-slot:title>
    {{-- Video List --}}
    <div class="space-y-4 mt-8 w-full mx-auto">
        <x-core.video-item 
            title="Tue, 10 Oct 2023 12:00:00 WIB"
            videoUrl="https://example.com/videos/video1.mp4" 
            downloadUrl="https://example.com/videos/video1.mp4" 
        />
        <x-core.video-item 
            title="Video 2"
            videoUrl="https://example.com/videos/video2.mp4" 
            downloadUrl="https://example.com/videos/video2.mp4" 
        />
        <x-core.video-item 
            title="Video 3"
            videoUrl="https://example.com/videos/video3.mp4" 
            downloadUrl="https://example.com/videos/video3.mp4" 
        />
        <x-core.video-item 
            title="Video 4"
            videoUrl="https://example.com/videos/video4.mp4" 
            downloadUrl="https://example.com/videos/video4.mp4" 
        />
    </div>
</x-client.layout>