<?php

use App\Settings\SitesSettings;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SitemapController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

if (app()->runningInConsole()) {
    $defaultLocale = 'en';
} else {
    $defaultLocale = app(SitesSettings::class)->default_locale ?? 'en';
}

Route::get('sitemap.xml', [SitemapController::class, 'index']);
Route::get('sitemap', [SitemapController::class, 'pretty']);

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['routestatistics', 'firewall.all'],
], function () {
    Route::name('welcome')->get('', [\App\Http\Controllers\PageController::class, 'index']);

    Route::name('service.show')->get('service/{page:slug}', [\App\Http\Controllers\PageController::class, 'service_show']);
    Route::name('article.show')->get('article/{page:slug}', [\App\Http\Controllers\PageController::class, 'article_show']);
    Route::name('post.show')->get('post/{page:slug}', [\App\Http\Controllers\PageController::class, 'post_show']);
    Route::name('topic.show')->get('topic/{page:slug}', [\App\Http\Controllers\PageController::class, 'topic_show']);
    Route::name('quiztopic.show')->get('quiztopic/{page:slug}', [\App\Http\Controllers\PageController::class, 'quiztopic_show']);

    // this needs to be last
    Route::name('pages.show')->get('{page:slug}', [\App\Http\Controllers\PageController::class, 'show']);
});
