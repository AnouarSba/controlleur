<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Infraction;
use App\Models\Chauffeur;
use App\Models\Kabid;
use App\Models\Fkab;
use App\Models\Fchauffeur;
use App\Models\User;
use App\Models\Bus;
use App\Models\Ligne;
use App\Models\Arret;
use App\Models\Alert;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Location\Facades\Location;

use \PhpOffice\PhpWord\TemplateProcessor;

class ControlController extends Controller
{
    public function Infractions()
    {
        return view('pages.Infractions');
    }
    public function Alerts()
    {
        return view('pages.Alerts');
    }
    public function Accidents()
    {
        return view('pages.Accidents');
    }
    public function Declaration_perte()
    {
        return view('pages.Declaration_perte');
    }
    public function Controle_Employer()
    {
        return view('pages.Controle_Employer');
    }
    public function Controle_Bus()
    {
        return view('pages.Controle_Bus');
    }
    public function inf_show(Request $request)

    {

    		
if ($request->id == "0") {

    $emp = Chauffeur::pluck("name","id")->all();
    
}    	else {
    $emp = Kabid::where('id','>','2')->pluck("name","id")->all();

   }
     $data = view('ajax-select',compact('emp'))->render();

    return response()->json(['options'=>$data]);
    
  
}
public function control(Request $request)
{
    return view('controls.control');

}
public function inst(Request $request)
{
    return view('pdf.ta3lima');

}
public function dalil(Request $request)
{
    return view('pdf.dalil');

}
public function emp(Request $request)
{
    return view('pdf.employer');

}
public function nidam(Request $request)
{
    return view('pdf.nidam');

}
public function stop(Request $request)
{
    return view('pdf.stop');

}
public function inf_type(Request $request)

    {

    		
if ($request->id == "0") {

    $emp = DB::table('fchauffeurs')->pluck("name","id")->all();
    
}    	else {
    $emp = DB::table('fkabs')->pluck("name","id")->all();

   }
     $data = view('ajax-select-type',compact('emp'))->render();

    return response()->json(['options'=>$data]);
    
  
}
public function store_infra(Request $request)
{
    $x = $request->x;
    $y = Auth::id();
    $date = $request->date;
    $name = $request->name;
    $bus = $request->bus;
    $ligne = $request->ligne;
    $arret = $request->arret;
    $lat = $request->lat;
    $lang = $request->lang;
    $infra = $request->infra;
    DB::statement("SET SQL_MODE=''");
    $row = Infraction::create(['user_id' => $y, 'emp_type' => $x, 'emp_id' => $name, 'bus_id' => $bus,'lat' => $lat, 'lang' => $lang, 'ligne_id' => $ligne, 'arret_id' => $arret, 'infra_id' => $infra, 'infra_date' => $date ]);
    return view('pages.Infractions');
}
public function store_alert(Request $request)
{
    $x = $request->x;
    $y = Auth::id();
    $date = $request->date;
   // $name = $request->name;
    $bus = $request->bus;
    $ligne = $request->ligne;
    $arret = $request->arret;
    $lat = $request->lat;
    $lang = $request->lang;
    $alert = $request->alrt;
    DB::statement("SET SQL_MODE=''");
    $row = Alert::create(['user_id' => $y, 'alert_type' => $x, 'bus_id' => $bus,'lat' => $lat, 'lang' => $lang, 'ligne_id' => $ligne, 'arret_id' => $arret, 'alert' => $alert, 'alert_date' => $date ]);
    return view('pages.Alerts');
}
public function infra_save(Request $request)
{
    $infra = Infraction::find($request->infra);
    if ($infra) {
       $infra->status = $request->status;
       $infra->save();
     if ($request->status == 2) {
        $templateProcessor = new TemplateProcessor('assets/word/questionnaire_original.docx');
        $emploi = $infra->emp_type;
        if ($emploi == 1) {
            $type = 'قابض';
            $employer = Kabid::find($infra->emp_id);
            if ($employer) {
                $name = $employer->name;
            }
            $inf = Fkab::find($infra->infra_id);
            if ($inf) {
               $infraction = $inf->name;
            }
        }
        else{
            $type = 'سائق';
            $employer = Chauffeur::find($infra->emp_id);
            if ($employer) {
                $name = $employer->name;
            }
            $inf = Fchauffeur::find($infra->infra_id);
            if ($inf) {
               $infraction = $inf->name;
            }
        }
        $templateProcessor->setValue('nom', $name);
        $templateProcessor->setValue('type', $type);
        $templateProcessor->setValue('infraction', $infraction);
        $templateProcessor->setValue('date', $infra->infra_date);
        $templateProcessor->saveAs('assets/word/questionnaire.docx');
        
        // Return a download response to the user
        return response()->download('assets/word/questionnaire.docx');
    

    }
   }
    $kabs = $request->kabs;
    $from = $request->from;
    $to = $request->to;
    $controlleur = $request->controlleur;
    $markers = Infraction::where('infractions.emp_type', '=', 0)
    ->where('user_id', '=', $request->type_id)
    ->whereBetween('created_at', [$from, $to])->get();
  
    return view('admin.infraction', ['kabs'=> $kabs, 'sttart_date'=> $from,  'markers'=> $markers, 'user_id' => $request->type_id, 'endd_date'=> $to, 'controlleur'=> $controlleur]);

}
public function alert_save(Request $request)
{
    $alert = Alert::find($request->alert);
    if ($alert) {
       $alert->status = $request->status;
       $alert->save();
     
   }
    $from = $request->from;
    $to = $request->to;
    $controlleur = $request->controlleur;
    $markers = Alert::where('user_id', '=', $request->type_id)
    ->whereBetween('created_at', [$from, $to])->get();
  
    return view('admin.Alert', [ 'sttart_date'=> $from,  'markers'=> $markers, 'user_id' => $request->type_id, 'endd_date'=> $to, 'controlleur'=> $controlleur]);

}
public function infra_rapport(Request $request)
{
    $infra = Infraction::find($request->infra);
    if ($infra) {
    $templateProcessor = new TemplateProcessor('assets/word/rapport_original.docx');
    $emploi = $infra->emp_type;
    if ($emploi == 1) {
        $type = 'القابض';
        $employer = Kabid::find($infra->emp_id);
        if ($employer) {
            $name = $employer->name;
        }
        $inf = Fkab::find($infra->infra_id);
        if ($inf) {
           $infraction = $inf->name;
           switch ($inf->type) {
            case 1:
                $level = 'الدرجة الأولى';
                break;
                case 2:
                    $level = 'الدرجة الثانية';
                    break;
                    case 3:
                        $level = 'الدرجة الثالثة';
                        break;
            default:
                # code...
                break;
           }
        }
    }
    else{
        $type = 'السائق';
        $employer = Chauffeur::find($infra->emp_id);
        if ($employer) {
            $name = $employer->name;
        }
        $inf = Fchauffeur::find($infra->infra_id);
        if ($inf) {
           $infraction = $inf->name;
           switch ($inf->type) {
            case 1:
                $level = 'الدرجة الأولى';
                break;
                case 2:
                    $level = 'الدرجة الثانية';
                    break;
                    case 3:
                        $level = 'الدرجة الثالثة';
                        break;
            default:
                # code...
                break;
           }
        }
    }
    $ctrl = User::find($infra->user_id);
        if ($ctrl) {
           $ctrl = $ctrl->username;
        }
    $bus = Bus::find($infra->bus_id);
        if ($bus) {
           $bus = $bus->name;
        }
        $ligne = Ligne::find($infra->ligne_id);
        if ($ligne) {
           $ligne = $ligne->name;
        }
        $arret = Arret::find($infra->arret_id);
        if ($arret) {
           $arret = $arret->name;
        }
    $templateProcessor->setValue('c_nom', $ctrl);
    $templateProcessor->setValue('nom', $name);
    $templateProcessor->setValue('type', $type);
    $templateProcessor->setValue('bus', $bus);
    $templateProcessor->setValue('ligne', $ligne);
    $templateProcessor->setValue('arret', $arret);
    $templateProcessor->setValue('infraction', $infraction);
    $templateProcessor->setValue('date', $infra->infra_date);
    $templateProcessor->setValue('level', $level);
    $templateProcessor->setImageValue('logo', 'assets/word/logo.png');
    $templateProcessor->saveAs('assets/word/rapport.docx');

    // Return a download response to the user
    return response()->download('assets/word/rapport.docx');
    }
}
public function alert_rapport(Request $request)
{
    $alert = Alert::find($request->alert);
    if ($alert) {
    $emploi = $alert->alert_type;
    $alrt = $alert->alert;
    if ($emploi == 1) {
        $templateProcessor = new TemplateProcessor('assets/word/Etablissement_alert_original.docx');
        $bus = Bus::find($alert->bus_id);
        if ($bus) {
           $bus = $bus->name;
        }
        $ligne = Ligne::find($alert->ligne_id);
        if ($ligne) {
           $ligne = $ligne->name;
        }
        $arret = Arret::find($alert->arret_id);
        if ($arret) {
           $arret = $arret->name;
        }
        $templateProcessor->setValue('bus', $bus);
        $templateProcessor->setValue('ligne', $ligne);
        $templateProcessor->setValue('arret', $arret);
     
    }
    else{
        $templateProcessor = new TemplateProcessor('assets/word/alert_original.docx');
    }
    $ctrl = User::find($alert->user_id);
        if ($ctrl) {
           $ctrl = $ctrl->username;
        }
    $templateProcessor->setValue('c_nom', $ctrl);
    $templateProcessor->setValue('alert', $alrt);
    $templateProcessor->setValue('date', $alert->alert_date);
    $templateProcessor->setImageValue('logo', 'assets/word/logo.png');
    $templateProcessor->saveAs('assets/word/rapport.docx');

    // Return a download response to the user
    return response()->download('assets/word/rapport.docx');
    }
}
public function infra_trait(Request $request)
{
    $infra = Infraction::find($request->infra);
    if ($infra) {
        if ($request->proces) {
            $infra->proces = $request->proces;
        }
        if ($request->quest) {
            $infra->quest = $request->quest;
        }
       $infra->save();
    }
    $kabs = $request->kabs;
    $from = $request->from;
    $to = $request->to;
    $controlleur = $request->controlleur;
    $markers = Infraction::where('infractions.emp_type', '=', 0)
    ->where('user_id', '=', $request->type_id)
    ->whereBetween('created_at', [$from, $to])->get();
  
    return view('admin.infraction', ['kabs'=> $kabs,  'markers'=> $markers, 'user_id' => $request->type_id, 'sttart_date'=> $from, 'endd_date'=> $to, 'controlleur'=> $controlleur]);

}
public function alert_trait(Request $request)
{
    $alert = Alert::find($request->alert);
    if ($alert) {
        if ($request->proces) {
            $alert->status = 2;
            $alert->proces = $request->proces;
        }
        
       $alert->save();
    }
    $from = $request->from;
    $to = $request->to;
    $controlleur = $request->controlleur;
    $markers = Alert::where('user_id', '=', $request->type_id)
    ->whereBetween('created_at', [$from, $to])->get();
  
    return view('admin.alert', [ 'markers'=> $markers, 'user_id' => $request->type_id, 'sttart_date'=> $from, 'endd_date'=> $to, 'controlleur'=> $controlleur]);

}
public function infra_list(Request $request)
{ 
    
    if ($request->ajax()) {
 info($request->sttart_date)    ;   
 info($request->endd_date)    ;   
        $from= $request->sttart_date;	
    $to= $request->endd_date;
    if ($request->user_id) {
        $query= Infraction::where('user_id', '=',$request->user_id);
    }
    else {
        $query = Infraction::where('infractions.id', '!=', 0);
    }
        if ($request->kabs) {
           
            $data = $query->join('buses','infractions.bus_id','=','buses.id')
        ->join('lignes','infractions.ligne_id','=','lignes.id')
        ->join('arrets','infractions.arret_id','=','arrets.id')
        ->join('fkabs','infractions.infra_id','=','fkabs.id')
       ->Join('kabids', 'infractions.emp_id','=','kabids.id')
       ->Join('users', 'infractions.user_id', '=', 'users.id')
       ->where('infractions.emp_type', '=', 1)
            
            ->whereBetween('infra_date', [$from, $to])
       ->select('infractions.id as id', 'infractions.status as status','quest', 'infractions.proces as proces', 'emp_type','emp_id', 'users.username as ctrl_name', 'buses.name as b_name', 'lignes.name as l_name', 'arrets.name as a_name', 'kabids.name as en', 'fkabs.name as i_name');
      
         }
        else {
            $data = Infraction::join('buses','infractions.bus_id','=','buses.id')
            ->join('lignes','infractions.ligne_id','=','lignes.id')
            ->join('arrets','infractions.arret_id','=','arrets.id')
            ->join('fchauffeurs','infractions.infra_id','=','fchauffeurs.id')
            ->Join('chauffeurs', 'infractions.emp_id', '=', 'chauffeurs.id')
            ->Join('users', 'infractions.user_id', '=', 'users.id')
            ->where('infractions.emp_type', '=',0)
            ->whereBetween('infra_date', [$from, $to])
            ->select('infractions.id as id', 'infractions.status as status', 'quest', 'infractions.proces as proces', 'emp_type','emp_id', 'buses.name as b_name', 'lignes.name as l_name', 'arrets.name as a_name', 'chauffeurs.name as en', 'users.username as ctrl_name', 'fchauffeurs.name as i_name');
         
        }

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $btn = '';
                     
                  /*      $btn = $btn.'
                     <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="put_id2('.$row->id.',`'.$row->proces.'`);" data-target="#exampleModal1">
                     معالجة
                   </button>';*/
                      $btn = $btn.'<a href="'.route('Infra_rapport',$row->id).'" class="btn btn-success btn-sm">تقرير</a>';
                    //   $btn = $btn.'<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">حذف</a>';
                    if($row->status != 1)  $btn .= '
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" onclick="put_id('.$row->id.',1);" data-target="#exampleModal">
                    حفظ
                  </button>
                  
                  ';
                  if($row->status != 2)  $btn .= '
                    <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" onclick="put_id01('.$row->id.',2);" data-target="#exampleModal01">
                       استفسار
                     </button>
                     
                     ';
                     if($row->status == 2)  $btn .= '
                     <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" onclick="put_id2('.$row->id.',`'.$row->quest.'`);"  data-target="#exampleModal2">
                        نتيجة الاستفسار
                      </button>
                      
                      ';
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
    if ($request->type_id) {
        $controlleur = User::find($request->type_id)->username;
    }
    else $controlleur = 'الكل';
    $req = $request->validate([
        'sttart_date' => 'required|date',
        'endd_date' => 'required|date',
       ]);
       if ($request->user_id) {
        $query= Infraction::where('user_id', '=',$request->user_id);
    }
    else {
        $query = Infraction::where('id', '!=', 0);
    }
       if ($request->type == "App\Models\Kabid") {
$markers = $query->where('emp_type', '=', 1)
->whereBetween('created_at', [$req['sttart_date'], $req['endd_date']])->get();
$kabs =  1;
    }
    else {
        $markers = $query->where('infractions.emp_type', '=', 0)
        ->whereBetween('created_at', [$req['sttart_date'], $req['endd_date']])->get();
        $kabs = 0;
    }
    $from= explode('T',$req['sttart_date'])[0];	
   
$to= explode('T',$req['endd_date'])[0];
    return view('admin.infraction', ['kabs'=> $kabs, 'sttart_date'=> $from,  'user_id'=> $request->type_id, 'endd_date'=> $to,  'markers'=> $markers, 'controlleur'=> $controlleur]);
}
public function sstore_alert(Request $request)
{
    $x = $request->x;
    $y = Auth::id();
    $date = $request->date;
    $name = $request->name;
    $bus = $request->bus;
    $ligne = $request->ligne;
    $arret = $request->arret;
    $infra = $request->infra;
    DB::statement("SET SQL_MODE=''");
    $row = Infraction::create(['user_id' => $y, 'emp_type' => $x, 'emp_id' => $name, 'bus_id' => $bus, 'ligne_id' => $ligne, 'arret_id' => $arret, 'infra_id' => $infra, 'infra_date' => $date ]);
    return view('pages.Alerts');
}
public function alert_list(Request $request)
{ 
    info($request->sttart_date)    ;   
    info($request->endd_date)    ;   
           $from= $request->sttart_date;	
       $to= $request->endd_date;
       if ($request->user_id) {
           $query= Alert::where('user_id', '=',$request->user_id);
       }
       else {
           $query = Alert::where('alerts.id', '!=', 0);
       }
    if ($request->ajax()) {
        $data = $query->leftJoin('buses', function($join) {
            $join->on('buses.id', '=', 'alerts.bus_id');
          })
          ->leftJoin('lignes', function($join) {
            $join->on('lignes.id', '=', 'alerts.ligne_id');
          })
          ->leftJoin('arrets', function($join) {
            $join->on('arrets.id', '=', 'alerts.arret_id');
          })
       ->Join('users', 'alerts.user_id', '=', 'users.id')
       ->whereBetween('alert_date', [$from, $to])
       ->select('alerts.id as id', 'alert_type', 'buses.name as b_name', 'users.username as ctrl_name','alert as i_name', 'alerts.status as status',  'lignes.name as l_name', 'arrets.name as a_name', 'alert', 'proces');
      
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '';
                    $btn = $btn.'<a href="'.route('Alert_rapport',$row->id).'" class="btn btn-success btn-sm">تبليغ</a>';

                    if($row->status != 1)  $btn .= '
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" onclick="put_id('.$row->id.',1);" data-target="#exampleModal">
                    حفظ
                  </button>
                  
                  '; 
                  $btn = $btn.'
                  <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" onclick="put_id2('.$row->id.',`'.$row->proces.'`);" data-target="#exampleModal1">
                  معالجة
                </button>';
                  /*                   $btn .= '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">معالجة</a>';
                       $btn .= '<a href="javascript:void(0)" class="edit btn btn-danger btn-sm">حذف</a>';
     */
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
    if ($request->type_id) {
        $controlleur = User::find($request->type_id)->username;
    }
    else $controlleur = 'الكل';
    $req = $request->validate([
        'sttart_date' => 'required|date',
        'endd_date' => 'required|date',
       ]);
       if ($request->user_id) {
        $query= Alert::where('user_id', '=',$request->user_id);
    }
    else {
        $query = Alert::where('id', '!=', 0);
    }
$markers = $query->whereBetween('created_at', [$req['sttart_date'], $req['endd_date']])->get();

$from= explode('T',$req['sttart_date'])[0];	
   
$to= explode('T',$req['endd_date'])[0];
    return view('admin.alert', ['sttart_date'=> $from,  'user_id'=> $request->type_id, 'endd_date'=> $to,  'markers'=> $markers, 'controlleur'=> $controlleur]);

}
}