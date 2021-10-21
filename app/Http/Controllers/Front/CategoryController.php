<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Config;
use App\Models\Contact;
use App\Models\Pages;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CategoryController extends Controller
{
    public function __construct()
    {
        if (Config::find(1)->active == 0) {
            //to kullandık sürekli sayfa yüklenrken loop a girmesin diye
            return redirect()->to('sayfa-bakimda')->send();
        }

        view()->share('pages', Pages::where('status', 'aktif')->orderBy('order', 'ASC')->whereStatus('aktif')->get());
        view()->share('categories', Category::All());
    }


    public function index()
    {

        $articles = Article::with('getCategory')->whereStatus('aktif')->whereHas('getCategory', function ($query) {
            $query->whereStatus('aktif');
        })->orderBy('created_at', 'DESC')->paginate(10);

        //BU kısım kategoriye status eklenirse statusu false olan kategoory den aktif olan makale varsa da göstermez  
        //$articles = Article::with('getCategory')->whereStatus('aktif')->whereHas('getCategory', function ($query) {
        //    $query->whereStatus('aktif');
        //})->orderBy('created_at', 'DESC')->paginate(10);
        //dd($articles);

        $articles->withPath(url('yazilar/sayfa'));

        //$pages = Pages::orderBy('order', 'ASC')->get();

        return view('front.index', [

            'articles' => $articles,
        ]);
    }


    public function show($category, $slug)
    {
        $category = Category::whereSlug($category)->first() ??  abort(403, 'Böyle bir Kategory bulunamadı');


        $article = Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403, 'There is no such a blog');
        // her gösterdiğinde hit bir artacak 

        $article->increment('hit');

        //$pages = Pages::orderBy('order', 'ASC')->get();


        return view('front.post', [

            'article' => $article,

        ]);
    }


    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ??  abort(403, 'Bu kategory boş veya değiştirilmiş.');

        $articles = Article::where('category_id', $category->id)->whereStatus('aktif')->orderBy('created_at', 'DESC')->whereStatus('aktif')->paginate(10);
        $articles->withPath(url('yazilar/sayfa'));

        //$pages = Pages::orderBy('order', 'ASC')->get();


        return view('front.category', [
            'category' => $category,

            'articles' => $articles,

        ]);
    }


    public function page($slug)
    {
        $page = Pages::whereSlug($slug)->first()  ??  abort(403, 'Böyle bir sayfa daha tasarlanmadı');

        return view(
            'front\page',
            [
                'page' => $page,

            ]
        );
    }

    public function contact()
    {
        return view('front.contact',);
    }


    public function contactPost(Request $request)
    {

        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'topic' => 'required',
            'message' => 'required|min:',
        ];


        //Mailtrap

        Mail::send([], [], function ($message) use ($request) {

            $message->from("cihangir@hanzade.com", 'Cihangir Hanzade Dergisi');
            $message->to('yakuppsenates@gmail.com');
            $message->setBody('Mesaj Gönderen : ' . $request->name . '<br>
                           Mesaj Gönderen Mail: ' . $request->email . ' <br>
                           Mesaj Konusu: ' . $request->topic . ' <br>
                           Mesaj : ' . $request->message . '<br> <br>
                           Mesaj Tarihi :' . now() . '', 'text/html');
            $message->subject($request->name . ' Mesaj Bıraktı');
        });


        $validate = Validator::make($request->post(), $rules);


        if ($validate->fails()) {
            //print_r($validate->errors()->first('message'));
            return redirect()->route('contact')->withErrors($validate)->withInput();
        } else {

            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->topic = $request->topic;
            $contact->message = $request->message;
            $contact->save();
            return redirect()->route('contact')->with('success', 'Mesajınız Başarıyla  İletilmiştir');
        }

        return back();
    }
}
