<?php

use App\Colors\Color;
use Illuminate\Support\Arr;
use App\Settings\SitesSettings;
use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (!function_exists('random_password')) {
    function random_password(): string
    {
        $random = str_shuffle('abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');

        return substr($random, 0, 10);
    }
}

if (!function_exists('untrailing_slash_it')) {
    function untrailing_slash_it(string $string): string
    {
        return rtrim($string, '/\\');
    }
}

if (!function_exists('trailing_slash_it')) {
    function trailing_slash_it(string $string): string
    {
        if ($string != config('app.url')) {
            return untrailing_slash_it($string) . '/';
        }

        return $string;
    }
}

if (!function_exists('active_route')) {
    function active_route(string $route, $active = true, $default = false)
    {
        if (
            url()->current() == $route ||
            str(url()->current())->remove(config('app.url')) == untrailing_slash_it($route)
        ) {
            return $active;
        }

        return $default;
    }
}

if (!function_exists('get_route_base')) {
    function get_route_base(string $route_name)
    {
        $routeItem = collect(app(Illuminate\Routing\Router::class)->getRoutes())->filter(function ($route) use ($route_name) {
            return $route->getName() === $route_name;
        })->first();

        if ($routeItem) {
            return $routeItem->uri;
        }

        return '/';
    }
}

if (!function_exists('is_front_page')) {
    function is_front_page(?Model $record)
    {
        if (isset($record['front_page']) && $record['front_page']) {
            return true;
        }

        return false;
    }
}

if (!function_exists('getColors')) {
    function getColors($weight)
    {
        $colors = Color::all();
        $filteredColors = [];

        foreach ($colors as $colorName => $shades) {
            if (isset($shades[$weight])) {
                $filteredColors[ucfirst($colorName)] = "<div class=\"bg-{$colorName}-{$weight} p-2 flex items-center w-full rounded-md\">" . ucfirst($colorName) . "</div>";
            }
        }

        return $filteredColors;
    }
}

if (!function_exists('getAllModels')) {
    function getAllModels(array $excludeModels = []): array
    {
        $path = app_path('Models') . '/*.php';

        $namespace = app()->getNamespace() . 'Models\\';

        return collect(glob($path))->mapWithKeys(function ($file) use ($excludeModels, $namespace) {
            $class = sprintf(
                '%s%s',
                $namespace,
                strtr(basename($file, '.php'), '/', '\\')
            );

            // Use fully qualified class name for comparison
            $fullyQualifiedClass = '\\' . ltrim($class, '\\');

            return in_array($fullyQualifiedClass, $excludeModels) ? [] : [$fullyQualifiedClass => class_basename($class)];
        })->toArray();
    }
}

if (!function_exists('transformSupportedLocales')) {
    function transformSupportedLocales()
    {
        $supportedLocales = LaravelLocalization::getSupportedLocales();
        $transformedArray = [];

        foreach ($supportedLocales as $code => $locale) {
            $transformedArray[$code] = $locale['name'];
        }

        return $transformedArray;
    }
}

if (!function_exists('generateSectionId')) {
    function generateSectionId($title)
    {
        // Convert to lowercase
        $title = strtolower($title);

        // Replace spaces with hyphens
        $title = str_replace(' ', '-', $title);

        // Remove non-alphanumeric characters and trailing hyphens
        $title = preg_replace('/[^a-z0-9-]/', '', $title);
        $title = rtrim($title, '-');

        return $title;
    }
}

// bg-slate-500 bg-slate-100
// bg-red-500 bg-red-100
// bg-orange-500 bg-orange-100
// bg-amber-500 bg-amber-100
// bg-yellow-500 bg-yellow-100
// bg-lime-500 bg-lime-100
// bg-green-500 bg-green-100
// bg-emerald-500 bg-emerald-100
// bg-teal-500 bg-teal-100
// bg-cyan-500 bg-cyan-100
// bg-sky-500 bg-sky-100
// bg-blue-500 bg-blue-100
// bg-indigo-500 bg-indigo-100
// bg-violet-500 bg-violet-100
// bg-purple-500 bg-purple-100
// bg-fuchsia-500 bg-fuchsia-100
// bg-pink-500 bg-pink-100
// bg-rose-500 bg-rose-100
// bg-gray-500 bg-gray-100
// bg-zinc-500 bg-zinc-100
// bg-neutral-500 bg-neutral-100
// bg-stone-500 bg-stone-100
