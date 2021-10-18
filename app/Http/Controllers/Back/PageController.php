<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class PageController extends Controller
{
    public function index()
    {
        $pages = Pages::orderBy('order', 'Asc')->get();

        return view('back.pages.index', ['pages' => $pages]);
    }
    public function edit($id)
    {
        $page = Pages::whereId($id)->first();

        return view('back.pages.edit', ['page' => $page]);
    }

    public function create()
    {
        $page = Pages::all();
        return view('back.pages.create', [
            'pages' => $page,

        ]);
    }


    public function update(Request $request)
    {

        $request->validate([
            'title' => 'min:3',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $page = Pages::whereTitle($request->title)->first();
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->content = $request->content;

        if ($request->hasFile('image')) {
            $imageSlug = Str::slug($page->title . '-' . $request->image->getClientOriginalExtension());
            $request->image->move(public_path('uploads'), $imageSlug);
            $page->image = '/uploads/' . $imageSlug;
        }
        $page->save();
        toastr()->success('Başarıyla Kaydedildi');
        return redirect()->route('pages.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'content' => 'required|min:50',

        ]);

        $new_page = new Pages();
        $new_page->title = $request->title;
        $new_page->slug = Str::slug($request->title);
        $new_page->content = $request->content;

        if ($request->hasFile('image')) {

            $imageSlug = Str::slug($request->title) . '-' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageSlug);
            $new_page->image = '/uploads/' . $imageSlug;
        } else {
            toastr()->warning('Fotograf Hatası');
        }
        $new_page->save();
        toastr()->success('Başarıyla kaydedildi');
        return back();
    }

    public function destroy($id)
    {
        Pages::findOrFail($id)->delete();
        toastr()->success('Başarıyla Kaldırıldı');
        return back();
    }

    public function deleted()
    {
        $pages = Pages::onlyTrashed()->orderBy('deleted_at', 'Desc')->get();

        return view('back.pages.trashed', [
            'pages' => $pages
        ]);
    }

    public function recovery($id)
    {
        Pages::onlyTrashed()->find($id)->restore();
        toastr()->success('Geri Döbüşüm başarılı');
        return back();
    }

    public function hardDelete($id)
    {
        $page = Pages::onlyTrashed()->find($id);
        $image = $page->image;

        if (File::exists($image)) {

            File::delete($image);
        }
        $page->forceDelete();
        toastr()->success('Tüm kalıntılar Temizlendi');
        return back();
    }

    public function switch(Request $request)
    {
        $page = Pages::findOrFail($request->id);
        $page->status = $request->_status;
        $page->save();
        toastr()->success('Başarıyla durum değiştirildi');
        return $request->id;
    }
    public function order(Request $request)
    {
        foreach ($request->page as $key => $order) {

            Pages::where('id', $order)->update(['order' => $key]);
        }
    }
}
