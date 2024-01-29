<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function show(Article $article)
    {
        abort_unless($article->status == 'published' || auth()->user(), 404);

        return view('article', [
            'article' => $article,
        ]);
    }
}
