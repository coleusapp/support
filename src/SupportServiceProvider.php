<?php

namespace Coleus\Support;

use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SupportServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('support');
    }

    public function packageBooted(): void
    {
        Blade::directive('packageVite', fn (string $package): string => "<?php echo \Coleus\Support\PackageVite::tags({$package}); ?>");
    }
}
