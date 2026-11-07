<?php

namespace Coleus\Support;

use Illuminate\Foundation\Vite;
use Illuminate\Support\HtmlString;

class PackageVite
{
    public static function tags(string $package): HtmlString
    {
        // Each package runs its own dev server with its own hot file; the shared Vite singleton outlives the request under Octane, so it is cloned instead of reconfigured.
        $vite = clone app(Vite::class);

        return $vite
            ->useHotFile(public_path("{$package}.hot"))
            ->useBuildDirectory("vendor/{$package}")('resources/js/app.ts');
    }
}
