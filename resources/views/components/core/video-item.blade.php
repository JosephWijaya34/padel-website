{{-- filepath: /Users/streynaldo/Documents/Work/WEB/padel-website/resources/views/components/core/video-item.blade.php --}}
<div class="flex flex-col md:flex-row justify-between md:items-center bg-card shadow-md rounded-lg p-4 w-full gap-2">
    <div class="text-normal md:text-lg font-medium text-text text-start">
        {{ $title ?? 'Video Title' }}
    </div>
    <div class="flex space-x-4">
        <a href="{{ $videoUrl }}" target="_blank" class="bg-lime-400 text-white px-4 py-2 rounded hover:bg-lime-600">
            Preview
        </a>
        <a href="{{ $downloadUrl }}" download class="bg-match-coral text-white px-4 py-2 rounded hover:bg-darker-coral">
            Download
        </a>
    </div>
</div>