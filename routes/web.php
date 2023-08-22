<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $articles = Article::paginate(4);

    $categories = Category::all();

    $tags = Tag::all();

    return view('landing', [
        'articles' => $articles,
        'categories' => $categories,
        'tags' => $tags,
    ]);
});

Route::get('/dashboard', function () {
    $count_article = Article::where('author_id', Auth::id())->get()->count();

    return view('dashboard', [
        'count_article' => $count_article,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('about-me', function (): View {

    return view('about-me', [
        'categories' => Category::all(),
        'tags' => Tag::all()
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(ArticleController::class)->group(function () {
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index')->middleware('auth');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create')->middleware('auth');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store')->middleware('auth');
    Route::get('/articles/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::patch('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update')->middleware('auth');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy')->middleware('auth');
    Route::get('/articles/{article}/preview', [ArticleController::class, 'showPreview'])->name('articles.preview');
});

Route::controller(CategoryController::class)->group(function () {
    Route::post('/categories', 'store')->name('categories.store');
    Route::get('/categories', 'index')->name('categories.index');
    Route::get('/categories/{category}', 'edit')->name('categories.edit');
    Route::patch('/categories/{category}', 'update')->name('categories.update');
    Route::delete('/categories/{category}', 'destroy')->name('categories.destroy');
});

require __DIR__ . '/auth.php';
