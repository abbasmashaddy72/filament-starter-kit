<?php

namespace App\Http\Controllers;

use App\Models\Topic;

class CenterController extends Controller
{
    public function index()
    {
        return view('index', [
            'topics' => Topic::orderBy('title')->where('status', 'Published')->get(),
            'meta' => (object) [
                'title' => 'Center',
                'description' => 'A curated list of things we find interesting.',
                'robots' => 'index,follow',
                'ogImage' => null,
            ],
        ]);
    }
}
