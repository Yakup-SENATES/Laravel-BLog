<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories =  Category::all();
        // dd($categories);
        $articles = Article::orderBy('created_at', 'DESC')->get();


        return view('front.index', [
            'categories' => $categories,
            'articles' => $articles,
        ]);
    }


    public function show($category, $slug)
    {
        $category = Category::whereSlug($category)->first() ??  abort(403, 'Böyle bir Kategory bulunamadı');


        $article = Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403, 'There is no such a blog');
        // her gösterdiğinde hit bir artacak 

        $article->increment('hit');

        $categories =  Category::all();
        return view('front.post', [
            'categories' => $categories,
            'article' => $article,
        ]);
    }


    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ??  abort(403, 'Bu kategory boş veya değiştirilmiş.');

        $articles = Article::where('category_id', $category->id)->orderBy('created_at', 'DESC')->get();

        $categories = Category::All();
        return view('front.category', [
            'category' => $category,
            'categories' => $categories,
            'articles' => $articles,
        ]);
    }
}
