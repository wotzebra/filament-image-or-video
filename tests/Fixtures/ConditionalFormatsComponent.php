<?php

namespace Wotz\FilamentImageOrVideo\Tests\Fixtures;

use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Livewire\Component;
use Wotz\FilamentImageOrVideo\Filament\Components\ImageOrVideoUrl;

/**
 * Hosts an ImageOrVideoUrl whose cropper formats follow a sibling select.
 */
class ConditionalFormatsComponent extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    /** @var array<string, mixed> */
    public array $data = [];

    public function mount(): void
    {
        $this->form->fill(['orientation' => 'landscape', 'image_or_video' => 'image', 'image_id' => null]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('orientation')
                    ->options(['landscape' => 'Landscape', 'portrait' => 'Portrait'])
                    ->live(),

                ImageOrVideoUrl::make(
                    attachmentFormats: fn (Get $get): array => match ($get('orientation')) {
                        'portrait' => [PortraitFormat::class],
                        default => [LandscapeFormat::class],
                    },
                ),
            ])
            ->statePath('data');
    }

    public function render(): string
    {
        return '<div>{{ $this->form }}<x-filament-actions::modals /></div>';
    }
}
