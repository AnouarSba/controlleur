<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Infraction;
use App\Models\Alert;
use App\Models\Coffre;
use App\Models\Bus;
use App\Models\Panne;
use App\Models\Avance;
use App\Models\User;
use App\Models\Pointage;
use App\Models\attestation;

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
       $d = Avance::where('month', date('m'))->where('year', date('Y'))->count();
      $dd = Panne::whereDate('created_at', Carbon::today())->count();

        
      $RJ = User::where('id',  auth()->user()->id)->first()->RJ;
      $R = User::where('id',  auth()->user()->id)->first()->R;
      $RJ_t = 0;
      $R_t = 0;
        $pointage = Pointage::where('emp_id',  auth()->user()->id)->whereDate('date', Carbon::today())->first();
        if ($pointage) {
            if ($pointage->emp_status_id == 1) {
                $R_t = 1;
            }
            elseif ($pointage->emp_status == 9) {
                $RJ_t = 1;
            }
            
        }

        $S = User::where('id',  auth()->user()->id)->first()->salaire;
        $M = User::where('id',  auth()->user()->id)->first()->salaire_mois;
        
        $D = attestation::count();
        $D_t = attestation::whereDate('date', Carbon::today())->count();
        $D_reg = attestation::where('reg',1)->count();

        $tt = Alert::count();
        $rr = Alert::whereDate('created_at', Carbon::today())->count();
        $ttt = Coffre::count();
        $rrr = Coffre::whereDate('created_at', Carbon::today())->count();
         $ttti = Coffre::where('inf', '>=',1)->count();
        $rrri = Coffre::where('inf', '>=',1)->whereDate('created_at', Carbon::today())->count();
        $bus = Bus::get();
        return view('pages.dashboard', ['today_i'=>$r, 'salaire' => $S, 'month'=>$M,  'all_i' => $t, 'today_p'=>$pp, 'all_p' => $p,'today_dmnd'=>$D_t, 'all_dmnd' => $D, 'all_dmnd_reg' => $D_reg,'today_d'=>$dd, 'all_d' => $d, 'today_rj'=>$RJ_t, 'all_rj' => $RJ,'today_recup'=>$R_t, 'all_recup' => $R, 'today_a'=>$rr, 'all_a' => $tt, 'today_c'=>$rrr, 'all_c' => $ttt, 'today_ci'=>$rrri, 'all_ci' => $ttti, 'buses' => $bus]);
    }
}