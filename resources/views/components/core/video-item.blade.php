{{-- filepath: /Users/streynaldo/Documents/Work/WEB/padel-website/resources/views/components/core/video-item.blade.php --}}
<div class="flex flex-col md:flex-row justify-between md:items-center bg-white shadow-md rounded-lg p-4 w-full gap-2">
    <div class="text-normal md:text-lg font-medium text-gray-800 text-start">
        {{ $title ?? 'Video Title' }}
    </div>
    <div class="flex space-x-4">
        <a href="{{ $videoUrl }}" target="_blank" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Preview
        </a>
        <a href="{{ $downloadUrl }}" download class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Download
        </a>
    </div>
</div>