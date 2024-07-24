<?php

namespace App\Infolists\Components;

use Filament\Infolists\Components\Entry;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

class FileViewer extends Entry
{
    protected string $view = 'infolists.components.file-viewer';

    protected ?string $collection = null;

    function setUp(): void
    {
        parent::setUp();
        $this->collection = $this->getCollection() ?? 'default';
    }

    function getState(): mixed
    {
        $this->collection = $this->getCollection() ?? 'default';
        return $this->getMedia();
    }

    public function collection(string $collection): static
    {
        $this->collection = $collection;

        return $this;
    }
    public function getCollection(): string|null
    {
        return $this->evaluate($this->collection);
    }

    public function getMedia(): MediaCollection
    {
        return $this->getRecord()->getMedia($this->getCollection());
    }

    public function getFileIcon(string $mimeType): string
    {
        return match ($mimeType) {
            'application/pdf' => 'far-file-pdf',
            'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'far-file-word',
            'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'far-file-excel',
            default => 'far-file',
        };
    }

    public function getFileColor(string $mimeType): string
    {
        return match ($mimeType) {
            'application/pdf' => 'text-red-500',
            'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'text-blue-500',
            'application/vnd.ms-excel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'text-green-500',
            default => 'text-gray-500',
        };
    }
}
