# Package to embed an attachment or youtube/vimeo as a Filament field

## Introduction

## Installation

## Usage

```php
use App\Formats\Landscape;
use Wotz\FilamentImageOrVideo\Filament\Components\ImageOrVideoUrl;

ImageOrVideoUrl::make(
    simpleOembed: false,
    attachmentFormats: [Landscape::class],
    prefix: '',
);
```

`attachmentFormats` is passed to `AttachmentInput::allowedFormats()`. It also accepts a closure, so the cropper formats can follow other fields in the same schema (for example in an Architect block where the rendered format depends on an orientation select):

```php
use App\Formats\Landscape;
use App\Formats\Portrait;
use Filament\Schemas\Components\Utilities\Get;

ImageOrVideoUrl::make(
    attachmentFormats: fn (Get $get): array => match ($get('orientation')) {
        'portrait' => [Portrait::class],
        default => [Landscape::class],
    },
);
```
