<?php

use Livewire\Livewire;
use Wotz\FilamentImageOrVideo\Tests\Fixtures\ConditionalFormatsComponent;

it('resolves closure attachment formats against sibling fields', function () {
    Livewire::test(ConditionalFormatsComponent::class)
        ->assertSee('300 × 200 px')
        ->set('data.orientation', 'portrait')
        ->assertSee('200 × 300 px')
        ->assertDontSee('300 × 200 px');
});
