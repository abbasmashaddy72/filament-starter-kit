<?php

use App\Settings\SitesSettings;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SitemapController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

if (app()->runningInConsole()) {
    $default_locale = 'en';
} else {
    $default_locale = app(SitesSettings::class)->default_locale ?? 'en';
}

Route::get('sitemap.xml', [SitemapController::class, 'index']);
Route::get('sitemap', [SitemapController::class, 'pretty']);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['routestatistics', 'firewall.all']
    ],
    function () {
        Route::middleware('force_trailing_slash')->group(function () {
            Route::name('welcome')->get('', [\App\Http\Controllers\PageController::class, 'index']);

            Route::name('service.show')->get('service/{page:slug}', [\App\Http\Controllers\PageController::class, 'service_show']);
            Route::name('article.show')->get('article/{page:slug}', [\App\Http\Controllers\PageController::class, 'article_show']);
            Route::name('post.show')->get('post/{page:slug}', [\App\Http\Controllers\PageController::class, 'post_show']);
            Route::name('topic.show')->get('topic/{page:slug}', [\App\Http\Controllers\PageController::class, 'topic_show']);

            // this needs to be last
            Route::name('pages.show')->get('{page:slug}', [\App\Http\Controllers\PageController::class, 'show']);
        });
    }
);
