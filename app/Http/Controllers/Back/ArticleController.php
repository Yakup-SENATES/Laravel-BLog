<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'DESC')->get();

        return view('back.articles.index', [
            'articles' => $articles,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('back.articles.create', [
            'categories' => $category,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->slug = Str::slug($request->title);
        $article->content = $request->content;

        if ($request->hasFile(('image'))) {

            $imageSlug = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();

            $request->image->move(public_path('uploads'), $imageSlug);
            $article->image = '/uploads/' . $imageSlug;
        } else {
            toastr()->warning('Hata ~foto!');
        }

        $article->save();
        //resim oluştuktan sonra hata mesajı versin

        toastr()->success('Başarıyla kaydedildi');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $article = Article::findOrFail($id);

        return view('back.articles.edit', [
            'categories' => $category,
            'article' => $article,

        ]);

        // return 'edit' . ' => ' . $id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->post());

        $request->validate([
            'title' => 'min:3',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->category_id = $request->category;
        $article->slug = Str::slug($request->title);
        $article->content = $request->content;

        if ($request->hasFile(('image'))) {

            $imageSlug = Str::slug($request->title) . '.' . $request->image->getClientOriginalExtension();

            $request->image->move(public_path('uploads'), $imageSlug);
            $article->image = '/uploads/' . $imageSlug;
        }

        $article->save();
        //resim oluştuktan sonra hata mesajı versin

        toastr()->success('Başarıyla kaydedildi');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //yukarıdaki metodalar resource controller de var bunu özel tasarladık bu sebeple route yazmalıyız 
    public function switch(Request $request)
    {
        //$article = Article::findOrFail($request->id);
        //$article->status = $request->_status;
        //$article->save();

        return $request->id;
    }
}
