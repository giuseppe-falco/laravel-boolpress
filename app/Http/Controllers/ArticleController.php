<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all();

        return view('guest.posts.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->get()->first();

        return view('guest.posts.show', compact('article'));
    }

}
