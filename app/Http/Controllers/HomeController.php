<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infraction;
use App\Models\Alert;
use App\Models\Coffre;
use App\Models\Bus;
use App\Models\Panne;

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
         $p = Panne::count();
        $pp = Panne::whereDate('created_at', Carbon::today())->count();
        $tt = Alert::count();
        $rr = Alert::whereDate('created_at', Carbon::today())->count();
        $ttt = Coffre::count();
        $rrr = Coffre::whereDate('created_at', Carbon::today())->count();
         $ttti = Coffre::where('inf', '>=',1)->count();
        $rrri = Coffre::where('inf', '>=',1)->whereDate('created_at', Carbon::today())->count();
        $bus = Bus::get();
        return view('pages.dashboard', ['today_i'=>$r, 'all_i' => $t, 'today_p'=>$pp, 'all_p' => $p,'today_a'=>$rr, 'all_a' => $tt, 'today_c'=>$rrr, 'all_c' => $ttt, 'today_ci'=>$rrri, 'all_ci' => $ttti, 'buses' => $bus]);
    }
}