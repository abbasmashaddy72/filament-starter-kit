<?php

namespace App\Http\Controllers;

use App\Models\Topic;

class TopicController extends Controller
{
    public function show(Topic $topic)
    {
        abort_unless($topic->status == 'published' || auth()->user(), 404);

        return view('topic', [
            'topic' => $topic,
        ]);
    }
}
