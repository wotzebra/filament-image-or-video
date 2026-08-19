<?php

namespace Wotz\FilamentImageOrVideo\Tests\Fixtures;

use Spatie\Image\Enums\Fit;
use Wotz\MediaLibrary\Formats\Format;
use Wotz\MediaLibrary\Formats\Manipulations;

class PortraitFormat extends Format
{
    public function definition(): Manipulations
    {
        return $this->manipulations->fit(Fit::Crop, 200, 300);
    }

    public function registerModelsForFormatter(): void {}
}
