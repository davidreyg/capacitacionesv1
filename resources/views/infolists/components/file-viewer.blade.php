@php
    $mediaItems = $getMedia();
@endphp
<style>
    /* Puedes seguir utilizando estos estilos si lo deseas, pero Tailwind CSS ya debería cubrir la mayoría de los estilos */
    .file-viewer {
        display: flex;
        flex-wrap: wrap;
    }
</style>
<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div class="file-viewer p-4 space-y-4">
        @foreach ($getState() as $media)
            <div
                class="file-entry flex items-center p-4 border rounded-lg shadow-md bg-white dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                <x-dynamic-component :component="$getFileIcon($media->mime_type)" @class(['file-icon w-12 h-12 mr-4', $getFileColor($media->mime_type)]) />
                <div class="file-info flex flex-col items-start">
                    <strong
                        class="text-lg font-semibold mb-2 text-gray-900 dark:text-gray-100">{{ $media->name }}</strong>
                    <a href="{{ $media->getUrl() }}" target="_blank"
                        class="text-blue-500 dark:text-blue-400 hover:underline">Ver archivo</a>
                </div>
            </div>
        @endforeach
    </div>
</x-dynamic-component>
