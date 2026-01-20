<?php

namespace Wotz\FilamentImageOrVideo\Traits;

use Wotz\MediaLibrary\Models\Attachment;

trait ImageOrVideoUrl
{
    public function imageOrVideoUrlData(
        array $data,
        $prefix = ''
    ): array {
        if (! isset($data[$prefix . 'image_or_video'])) {
            return [
                'type' => null,
                'image' => null,
                'video' => null,
            ];
        }

        if (
            $data[$prefix . 'image_or_video'] === 'image'
            || ($data[$prefix . 'image_or_video'] === 'video' && ! empty($data[$prefix . 'image_id']))
        ) {
            $attachment = Attachment::find($data[$prefix . 'image_id']);
        }

        if ($data[$prefix . 'image_or_video'] === 'video') {
            $video = $data[$prefix . 'video'];
        }

        return [
            'type' => $data[$prefix . 'image_or_video'],
            'image' => $attachment ?? null,
            'video' => $video ?? null,
        ];
    }
}
