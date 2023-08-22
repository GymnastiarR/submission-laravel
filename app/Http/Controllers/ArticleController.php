<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $articles = Article::with('category')->where('author_id', Auth::id())->paginate(5);

        return \view('articles', [
            'articles' => $articles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();

        $tags = Tag::all();

        return view('create-article', [
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $cleanContent = strip_tags($request->content, '<p><strong><em><br>');

        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $cleanContent,
            'category_id' => $request->category,
            'author_id' => Auth::id(),
        ];

        if ($request->has('publish')) {
            $data['posted_at'] = \now();
        }

        if ($request->hasFile('thumbnail')) {
            $path = $request->thumbnail->store('public');
            $data['thumbnail'] = \explode('/', $path)[1];
        }

        DB::transaction(function () use ($data, $request) {
            $article = Article::create($data);
            foreach ($request->tags as $tag) {
                $article->tags()->attach($tag);
            }
        });

        return redirect()->route('articles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article): View
    {
        if ($article->posted_at == null) {
            abort(404);
        }

        $categories = Category::all();

        $tags = Tag::all();

        return view('article', [
            'article' => $article,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article): View
    {
        if (!Gate::allows('edit-post', $article)) {
            abort(403);
        }

        return \view('create-article', [
            'article' => $article,
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article): RedirectResponse
    {
        $cleanContent = strip_tags($request->content, '<p><strong><em><br>');

        $isExist = Article::where('slug', $request->slug)->first();

        if ($isExist && $isExist->id != $article->id) {
            return Redirect::back()->withErrors(['slug' => 'Slug already exist']);
        }

        $data = [
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $cleanContent,
            'category_id' => $request->category,
        ];

        if ($request->has('publish')) {
            $data['posted_at'] = \now();
        }

        $article->update($data);

        $article->save();

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        Storage::delete('public/' . $article->thumbnail);

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully');
    }

    public function showPreview(Article $article): View
    {
        if (!Gate::allows('edit-post', $article)) {
            abort(403);
        }

        $categories = Category::all();

        $tags = Tag::all();

        return \view('article', [
            'article' => $article,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }
}
