<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Pages;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $article = Article::all()->count();
        $pages = Pages::all()->count();
        $hit = Article::sum('hit');
        $category = Category::all()->count();


        if (Auth::user()) {
            return view('back.dashboard', [

                'article' => $article,
                'pages'  => $pages,
                'hit' => $hit,
                'category' => $category,

            ]);
        }
        return  redirect('/');
    }
}
