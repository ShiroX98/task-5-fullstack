<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::with('category', 'user')->orderByDesc('id')->paginate(10);
        return response()->json($articles, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->user_id = Auth::user()->id;
        $article->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('public/images', $filename);
            $article->image = $filename;
        }

        $article->save();

        return response()->json($article, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::where('id', $id)->first();
        return response()->json($article, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article->title = $request->title;
        $article->content = $request->content;
        $article->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            Storage::delete('public/images/' . $article->image);

            $filename = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $path = $request->file('image')->storeAs('public/images', $filename);
            $article->image = $filename;
        }

        $article->save();

        return response()->json($article, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        Storage::delete('public/images/' . $article->image);

        $article->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Delete Berhasil!'
        ]);
    }
}
