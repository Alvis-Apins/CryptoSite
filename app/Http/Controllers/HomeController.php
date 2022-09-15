<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $cryptoNews = DB::table('articles')->paginate(8);

        return view('welcome', [
            'crypto_news' => $cryptoNews
        ]);
    }
}
