<?php

namespace App\Http\Controllers;

use App\Repositories\NewsDataApiRepository;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $cryptoNews = DB::table('articles')->paginate(8);

        return view('welcome', [
            'crypto_news' => $cryptoNews
        ]);
    }
}
