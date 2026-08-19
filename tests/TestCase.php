<?php

namespace Wotz\FilamentImageOrVideo\Tests;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Filament\Actions\ActionsServiceProvider;
use Filament\Facades\Filament;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Infolists\InfolistsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Panel;
use Filament\Schemas\SchemasServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Filament\Widgets\WidgetsServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use Spatie\Translatable\TranslatableServiceProvider;
use Wotz\FilamentImageOrVideo\Providers\FilamentImageOrVideoServiceProvider;
use Wotz\MediaLibrary\Filament\MediaLibraryPlugin;
use Wotz\MediaLibrary\Providers\MediaLibraryServiceProvider;
use Wotz\TranslatableTabs\Providers\TranslatableTabsServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Wotz\\FilamentImageOrVideo\\Database\\Factories\\' . class_basename($modelName) . 'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        // Sorted: Livewire must boot before the Filament providers, otherwise the
        // component error bag is never initialised and rendering fails.
        $providers = [
            LivewireServiceProvider::class,
            TranslatableTabsServiceProvider::class,
            ActionsServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            BladeIconsServiceProvider::class,
            FilamentServiceProvider::class,
            FormsServiceProvider::class,
            InfolistsServiceProvider::class,
            NotificationsServiceProvider::class,
            SchemasServiceProvider::class,
            SupportServiceProvider::class,
            TablesServiceProvider::class,
            WidgetsServiceProvider::class,
            TranslatableServiceProvider::class,
            MediaLibraryServiceProvider::class,
            FilamentImageOrVideoServiceProvider::class,
        ];

        sort($providers);

        return $providers;
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        $panel = new Panel;
        $panel
            ->id('test')
            ->default(true)
            ->plugin(MediaLibraryPlugin::make());

        Filament::registerPanel($panel);
    }
}
