<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        if (Auth::user()) {
            return view('back.dashboard');
        }
        return  redirect('/');
    }
}
