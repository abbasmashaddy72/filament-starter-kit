<?php

use App\Colors\Color;
use Illuminate\Support\Arr;
use App\Settings\SitesSettings;
use Illuminate\Database\Eloquent\Model;

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

if (!function_exists('getLocales')) {
    function getLocales(): array
    {
        $locales = app(SitesSettings::class)->locales ?? array_keys(config('app.locales'));

        // Remove 'en' if present
        $locales = array_diff($locales, ['en']);

        // Ensure 'en' is the first element
        array_unshift($locales, 'en');

        return $locales;
    }
}

if (!function_exists('getColors')) {
    function getColors($weight)
    {
        $colors = Arr::except(Color::all(), ['gray', 'zinc', 'neutral', 'stone']);
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

        return collect(glob($path))->mapWithKeys(function ($file) use ($excludeModels) {
            $class = sprintf(
                '\%s%s',
                app()->getNamespace(),
                strtr(basename($file, '.php'), '/', '\\')
            );

            return in_array($class, $excludeModels) ? [] : [$class => class_basename($class)];
        })->toArray();
    }
}

// bg-slate-500 bg-slate-200
// bg-red-500 bg-red-200
// bg-orange-500 bg-orange-200
// bg-amber-500 bg-amber-200
// bg-yellow-500 bg-yellow-200
// bg-lime-500 bg-lime-200
// bg-green-500 bg-green-200
// bg-emerald-500 bg-emerald-200
// bg-teal-500 bg-teal-200
// bg-cyan-500 bg-cyan-200
// bg-sky-500 bg-sky-200
// bg-blue-500 bg-blue-200
// bg-indigo-500 bg-indigo-200
// bg-violet-500 bg-violet-200
// bg-purple-500 bg-purple-200
// bg-fuchsia-500 bg-fuchsia-200
// bg-pink-500 bg-pink-200
// bg-rose-500 bg-rose-200
