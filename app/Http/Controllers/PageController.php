<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use App\Models\Topic;
use App\Models\Article;
use App\Models\Service;
use App\Models\QuizTopic;

class PageController extends Controller
{
    public function index()
    {
        abort_unless($page = Page::where('front_page', true)->first(), 404);

        return view('welcome', [
            'page' => $page,
        ]);
    }

    public function show(Page $page)
    {
        abort_unless($page->status == 'Published' || auth()->user(), 404);

        return view('page', [
            'page' => $page,
        ]);
    }

    public function service_show(Service $page)
    {
        abort_unless($page->status == 'Published' || auth()->user(), 404);

        return view('page', [
            'page' => $page,
        ]);
    }

    public function article_show(Article $page)
    {
        abort_unless($page->status == 'Published' || auth()->user(), 404);

        return view('page', [
            'page' => $page,
        ]);
    }

    public function post_show(Post $page)
    {
        abort_unless($page->status == 'Published' || auth()->user(), 404);

        return view('page', [
            'page' => $page,
        ]);
    }

    public function topic_show(Topic $page)
    {
        abort_unless($page->status == 'Published' || auth()->user(), 404);

        return view('page', [
            'page' => $page,
        ]);
    }

    public function quiztopic_show(QuizTopic $page)
    {
        abort_unless($page->status == 'Published' || auth()->user(), 404);

        return view('page', [
            'page' => $page,
        ]);
    }
}
