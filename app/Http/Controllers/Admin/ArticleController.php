<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();
        $articles = Article::where('user_id', $user_id)->get();

        return view('admin.posts.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $tags = Tag::all();

        return view('admin.posts.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $request->validate(
            [
                'title' => 'required',
                'slug' => 'required|unique:articles',
                'content' => 'required',
                'image' => 'image'
            ]
        );

        // $path = Storage::disk('public')->put('images', $data['image']);
        $newArticle = new Article;

        if(isset($data['image']))
        {
            $imageOriginalName = $data["image"]->getClientOriginalName();
            $path = Storage::disk("public")->putFileAs("images", $data["image"], rand(1,10).$imageOriginalName);

            $newArticle->image = $path;

        }

        $newArticle->user_id = Auth::id();
        $newArticle->title = $data["title"];
        $newArticle->slug = $data["slug"];
        $newArticle->content = $data["content"];

        $newArticle->save();
        
        if(isset($data['tags'])){
            $newArticle->tags()->sync($data["tags"]);
        }
        
        Mail::to($newArticle->user->email)->send(new SendNewMail($newArticle));

        return redirect()->route("admin.posts.show", $newArticle->slug);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->get()->first();
        $tags = $article->tags;

        return view('admin.posts.show', compact('article', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $article = Article::where('slug', $slug)->first();

        return view('admin.posts.edit', ['article'=>$article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $data = $request->all();

        $request->validate([
            "title" => "required",
            "slug" => "required",
            "content" => "required",
            'image' => 'image'

        ]);

        $article = Article::where('slug', $slug)->get()->first();

        $article->user_id = Auth::id();
        $article->title = $data["title"];
        $article->slug = $data["slug"];
        $article->content = $data["content"];

        
        $article->update();

        return redirect()->route("admin.posts.show", $slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $article = Article::where('slug', $slug)->get()->first()->delete();

        return redirect()->route('admin.posts.index');
    }
}
