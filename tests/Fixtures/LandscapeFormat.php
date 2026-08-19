<?php

namespace Wotz\FilamentImageOrVideo\Tests\Fixtures;

use Spatie\Image\Enums\Fit;
use Wotz\MediaLibrary\Formats\Format;
use Wotz\MediaLibrary\Formats\Manipulations;

class LandscapeFormat extends Format
{
    public function definition(): Manipulations
    {
        return $this->manipulations->fit(Fit::Crop, 300, 200);
    }

    public function registerModelsForFormatter(): void {}
}
