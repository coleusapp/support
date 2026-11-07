<?php

namespace Coleus\Support\Http\Middleware;

// use App\Settings\GeneralSettings;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    protected string $package;

    public function rootView(Request $request): string
    {
        return "{$this->package}::app";
    }

    /**
     * Every package is its own Vite bundle, so the version must differ between packages: Inertia then answers a
     * visit into another package with a full page load instead of rendering that package's page in this bundle.
     */
    public function version(Request $request): ?string
    {
        $manifest = public_path("vendor/{$this->package}/manifest.json");

        $build = is_file($manifest)
            ? hash_file('xxh128', $manifest)
            : '';

        return hash('xxh128', "{$this->package}:{$build}");
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'config' => [
                'timezone' => config('app.timezone', 'UTC'), // app(GeneralSettings::class)?->timezone ??
            ],
            'auth' => [
                'user' => $request->user(),
            ],
            'ziggy' => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
        ];
    }
}
