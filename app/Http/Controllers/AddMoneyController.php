<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AddMoneyController extends Controller
{
    public function index(): View
    {
        return view('add-money');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'amount' => ['min:0', 'numeric']
        ]);

        $moneyInValet = DB::table('users')
            ->select('valet')
            ->where('id', Auth::user()->getAuthIdentifier())
            ->get();

        $updatedValue = $moneyInValet->toArray()[0]->valet + (float)$request->get('amount');
        DB::update('update users set valet =' . $updatedValue . ' where id = ' . Auth::user()->getAuthIdentifier());

        return redirect('/my-wallet');
    }
}
