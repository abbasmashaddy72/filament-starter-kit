<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SitemapController;
use App\Settings\SitesSettings;

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

Route::prefix('{locale?}')->where(['locale' => '[a-zA-Z]{2}'])->middleware(['routestatistics', 'setlocale:' . $default_locale])->group(function () {
    Route::get('sitemap.xml', [SitemapController::class, 'index']);
    Route::get('sitemap', [SitemapController::class, 'pretty']);

    Route::redirect('login', 'admin/login', 301)->name('login');

    Route::middleware('force_trailing_slash')->group(function () {
        Route::name('welcome')->get('', [\App\Http\Controllers\PageController::class, 'index']);

        Route::name('discoveries')->get('center', [\App\Http\Controllers\CenterController::class, 'index']);
        Route::name('topics.show')->get('center/topics/{topic:slug}', [\App\Http\Controllers\TopicController::class, 'show']);
        Route::name('articles.show')->get('center/articles/{article:slug}', [\App\Http\Controllers\ArticleController::class, 'show']);

        Route::name('blog.index')->get('blogs', [\App\Http\Controllers\PostController::class, 'index']);
        Route::name('blog.show')->get('blogs/{post:slug}', [\App\Http\Controllers\PostController::class, 'show']);

        Route::name('faqs.index')->get('faqs', [\App\Http\Controllers\FaqController::class, 'index']);

        // this needs to be last
        Route::name('pages.show')->get('{page:slug}', [\App\Http\Controllers\PageController::class, 'show']);
    });
});
