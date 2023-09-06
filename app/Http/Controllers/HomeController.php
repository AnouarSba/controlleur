<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infraction;
use App\Models\Bus;

use Carbon\carbon;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $t = Infraction::count();
        $r = Infraction::whereDate('created_at', Carbon::today())->count();
        $bus = Bus::get();
        return view('pages.dashboard', ['today'=>$r, 'all' => $t, 'buses' => $bus]);
    }
}