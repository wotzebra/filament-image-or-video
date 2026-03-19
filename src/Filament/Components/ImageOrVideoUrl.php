<?php

namespace Wotz\FilamentImageOrVideo\Filament\Components;

use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use Wotz\MediaLibrary\Filament\AttachmentInput;

class ImageOrVideoUrl
{
    public static function make(
        bool $simpleOembed = false,
        ?array $attachmentFormats = null,
        string $prefix = '',
        bool $noVideo = false
    ): Group {
        $oembedClass = match ($simpleOembed) {
            true => SimpleVideoEmbed::class,
            false => VideoEmbed::class,
        };

        $options = [
            'image' => __('filament-image-or-video::image-or-video.image option'),
            'video' => __('filament-image-or-video::image-or-video.video option'),
        ];

        if ($noVideo) {
            unset($options['video']);
        }

        return Group::make([
            Select::make($prefix . 'image_or_video')
                ->label(__('filament-image-or-video::image-or-video.select label'))
                ->options($options)
                ->default('image')
                ->formatStateUsing(fn ($state) => $state ?? 'image')
                ->reactive(),

            $oembedClass::make($prefix . 'video')
                ->hidden(fn (Get $get) => $get($prefix . 'image_or_video') !== 'video')
                ->label(__('filament-image-or-video::image-or-video.video option')),

            AttachmentInput::make($prefix . 'image_id')
                ->hidden(fn (Get $get) => ! in_array($get($prefix . 'image_or_video'), ['image', 'video']))
                ->allowedFormats($attachmentFormats ?? [])
                ->label(fn (Get $get) => $get($prefix . 'image_or_video') === 'image'
                    ? __('filament-image-or-video::image-or-video.image option')
                    : __('filament-image-or-video::image-or-video.video fallback')
                ),

        ]);
    }
}
