<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = category::all();

        return view('back.categories.index', ['categories' => $categories]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'category' => 'min:4',
            ]
        );

        $new_category = new category();
        $new_category->name = $request->category;
        $new_category->slug = Str::slug($request->category);

        if (category::whereSlug($new_category->slug)->first()) {
            toastr()->error('Bu  ALan Zaten Mevcut');
            return back();
        } else {
            $new_category->save();
            toastr()->success('Kaydedildi');
            return back();
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(category $category)
    {
        return view('back.categories.edit');
    }


    public function deleteCategory($id)
    {

        $articles[] = Article::whereCategory_id($id)->get();

        for ($i = 0; $i < count($articles[0]); $i++) {

            Article::whereId($articles[0][$i]->id)->ForceDelete();
        }
        //return back();
        //die();

        if (category::findOrFail($id)->delete()) {
            toastr()->success('Kategory Başarıyla Kaldırıldı');
        }
        return back();
    }

    public function editCategory(Request $request)
    {
        $category =  category::findOrFail($request->id);

        return $category;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $new_category edit label  text (Category name atama için kullanılacak)
     * @param  $find selected item  (seçilen category içiin database ye sorgu da  bulunacak )
     * @return \Illuminate\Http\Request
     */

    public function updateCategory(Request $request)
    {

        $new_category = $request->category_edit;

        $find = $request->category_id;

        //  dd($find);
        $category =  category::whereId($find)->first();

        //dd($category);

        $category->name = $new_category;
        $category->slug = Str::slug($new_category);

        if (category::whereName($category->name)->whereNotIn('id', [$category->id])->first()) {
            toastr()->error('Bu  Alan Zaten Mevcut');
            return back();
        } else {
            $category->save();
            toastr()->success('Kaydedildi');
            return back();
        }
    }
}
