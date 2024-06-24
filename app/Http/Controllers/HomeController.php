<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\attestation;
use App\Models\Avance;
use App\Models\Bus;
use App\Models\Coffre;
use App\Models\Emp_recup;
use App\Models\Emp_rj;
use App\Models\Event;
use App\Models\Holiday;
use App\Models\Infraction;
use App\Models\Panne;
use App\Models\Pointage;
use App\Models\User;
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

        $emp = User::where('id', auth()->user()->id)->first();
        $R = $emp->R;
        foreach (Holiday::get() as $holiday) {
            $recup = Emp_recup::where('emp_id', $emp->id)->where('holiday_id', $holiday->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
            $R += $recup;
        }
        foreach (Event::get() as $event) {
            $recup = Emp_recup::where('emp_id', $emp->id)->where('event_id', $event->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
            $R += $recup;
        }
        $emp_r = Emp_recup::where('emp_id', $emp->id)->whereYear('date', date('Y'))->where('sign', 0)->count();
        $R -= $emp_r;

        $RJ = $emp->RJ;
        $rj = Emp_rj::where('emp_id', $emp->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
        $RJ += $rj;
        $emp_rj = Emp_rj::where('emp_id', $emp->id)->whereYear('date', date('Y'))->where('sign', 0)->count();
        $RJ = $RJ - $emp_rj;

        $RJ_t = 0;
        $R_t = 0;
        $pointage = Pointage::where('emp_id', auth()->user()->id)->whereDate('date', Carbon::today())->first();
        if ($pointage) {
            if ($pointage->emp_status_id == 1) {
                $R_t = 1;
            } elseif ($pointage->emp_status == 9) {
                $RJ_t = 1;
            }

        }

        $S = User::where('id', auth()->user()->id)->first()->salaire;
        $M = User::where('id', auth()->user()->id)->first()->salaire_mois;

        $D = attestation::count();
        $D_t = attestation::whereDate('date', Carbon::today())->count();
        $D_reg = attestation::where('reg', 1)->count();

        $tt = Alert::count();
        $rr = Alert::whereDate('created_at', Carbon::today())->count();
        $ttt = Coffre::count();
        $rrr = Coffre::whereDate('created_at', Carbon::today())->count();
        $ttti = Coffre::where('inf', '>=', 1)->count();
        $rrri = Coffre::where('inf', '>=', 1)->whereDate('created_at', Carbon::today())->count();
        $bus = Bus::get();
        $avance = Avance::where('emp_id', auth()->user()->id)->where('month', date('m'))->where('year', date('Y'))->first();
        if ($avance) {
            $montant = $avance->avance;
        } else {
            $montant = 0;
        }

        return view('pages.dashboard', ['today_i' => $r, 'salaire' => $S, 'montant' => $montant, 'month' => $M, 'all_i' => $t, 'today_p' => $pp, 'all_p' => $p, 'today_dmnd' => $D_t, 'all_dmnd' => $D, 'all_dmnd_reg' => $D_reg, 'today_d' => $dd, 'all_d' => $d, 'today_rj' => $RJ_t, 'all_rj' => $RJ, 'today_recup' => $R_t, 'all_recup' => $R, 'today_a' => $rr, 'all_a' => $tt, 'today_c' => $rrr, 'all_c' => $ttt, 'today_ci' => $rrri, 'all_ci' => $ttti, 'buses' => $bus]);
    }
}
