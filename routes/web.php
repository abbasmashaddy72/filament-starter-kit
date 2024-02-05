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

$default_locale = app(SitesSettings::class)->default_locale ?? 'en';

Route::get('sitemap.xml', [SitemapController::class, 'index']);
Route::get('sitemap', [SitemapController::class, 'pretty']);

// Route::middleware(['routestatistics', 'localizationRedirect', 'localeSessionRedirect', 'localize'])->
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['routestatistics']
    ],
    function () {
        Route::redirect('login', 'admin/login', 301)->name('login');

        Route::middleware('force_trailing_slash')->group(function () {
            Route::name('welcome')->get('', [\App\Http\Controllers\PageController::class, 'index']);

            // this needs to be last
            Route::name('pages.show')->get('{page:slug}', [\App\Http\Controllers\PageController::class, 'show']);
        });
    }
);
