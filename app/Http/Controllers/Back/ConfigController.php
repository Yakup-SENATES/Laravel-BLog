<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
    public function index()
    {
        $config = Config::findOrFail(1);
        return view('back.config.index', [
            'config' => $config
        ]);
    }

    public function update(Request $request)
    {
        $new_config = Config::findOrFail(1);

        $new_config->title = $request->title;
        $new_config->active = $request->active;
        if ($request->hasFile('logo')) {

            $logoSlug = Str::slug($request->title) . '-logo.' . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads'), $logoSlug);
            $new_config->logo = '/uploads/' . $logoSlug;
        }

        $new_config->facebook = $request->facebook;
        $new_config->twitter = $request->twitter;
        $new_config->instagram = $request->instagram;

        $new_config->github = $request->github;
        $new_config->linkedin = $request->linkedin;
        if ($request->hasFile('favicon')) {

            $faviconSlug = Str::slug($request->title) . '-favicon.' . $request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads'), $faviconSlug);


            $new_config->favicon = '/uploads/' . $faviconSlug;
        }
        $new_config->save();
        toastr()->success('Başarıla Ayarlar Kaydedildi');

        return back();
    }
}
