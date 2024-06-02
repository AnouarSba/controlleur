<?php

// app/Http/Controllers/ExcelController.php

namespace App\Http\Controllers;

use App\Imports\MyImport;
use App\Models\attestation;
use App\Models\Avance; // Import class for parsing
use App\Models\Emp_status;
use App\Models\Image;
use App\Models\Pointage;
use App\Models\User;
use App\Models\validate_pointage;
use App\Models\Holiday;
use App\Models\EmpInHoliday;
use DateInterval;
use DatePeriod;
use DateTime;
use DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
// Adjust the namespace and model name as needed
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class ExcelController extends Controller
{
    public function upload(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|mimes:xlsx,xls|max:2048', // Excel file validation
        // ]);

        // // Store uploaded file in storage/app/uploads
        // $filePath = $request->file('file')->store('uploads');

        // // Process the Excel file using Laravel Excel package
        // $import = new MyImport();
        // Excel::import($import, storage_path('app/' . $filePath));

        // // Retrieve imported data
        // $data = $import->getData();

        // // Optionally, you can save the data to database or perform additional processing
        // return view('pages.view_planing', ['data' => $data]);

        // //  return response()->json($data);

        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
            'date' => 'required|date',
        ]);
        if ($request->hasFile('image')) {
            $image_file = $request->file('image');
            $imageName = $request->date . '.' . $image_file->getClientOriginalExtension();
            $existingImagePath = storage_path('app/public/images') . '/' . $imageName;
            if (File::exists($existingImagePath)) {
                File::delete($existingImagePath);
            } else {
                $Image = new Image(); // Adjust the model name as needed
                // You may want to save the image path to the database or perform any other operations here

                $Image->path = 'images/' . $imageName;
                $Image->date = $request->date;
                $Image->save();
            }
            $image_file->move(storage_path('app/public/images'), $imageName);

            return redirect()->back()->with('success', 'Image uploaded successfully.');
        }

        return redirect()->back()->with('error', 'Failed to upload image.');
    }
    public function show_planing(Request $request)
    {
        // Assuming you want to retrieve the latest uploaded image
        if ($request->has('date')) {
            $date = $request->date;
        } else {
            $date = date('Y-m-d');
        }

        $image = Image::where('date', $date)->first();

        if (!$image) {
            return view('pages.view_planing', ['date' => $date, 'imagePath' => null, 'error' => 'Pas de planing pour cette date.']);
        }

        // Pass the image path to the view
        return view('pages.view_planing', ['imagePath' => $image->path, 'date' => $image->date]);
    }
    public function avances()
    {
        if (date('d') < 8 || date('d') > 13) {
            return redirect()->back()->with('date_error', 'Date de demande refusée.');
        }

        return view('pages.avances');
    }
    public function attestations()
    {

        $attestation = attestation::where('emp_id', auth()->user()->id)->first();
        if ($attestation) {
            $date1 = new DateTime(date('Y-m-d'));
            $date2 = new DateTime($attestation->date);

            $interval = $date2->diff($date1);
            
            $interval = $date2->diff($date1);
            if ((int)$interval->format('%a') < 30) {
                return redirect()->back()->with('date_error', 'Vou avez deja demmander une attestation .');
            }
        } 

        return view('pages.attestations');
    }
    public function events()
    {

        

        return view('pages.events');
    }
    public function demande_attestations(Request $request){

        $attestation = attestation::where('emp_id', auth()->user()->id)->latest()->first();
        if ($attestation) {
            $date1 = new DateTime(date('Y-m-d'));
            $date2 = new DateTime($attestation->date);
            $interval = $date2->diff($date1);
            $interval = $date2->diff($date1);
            if ((int)$interval->format('%a') < 30) {
                return \view('pages.attestations')->with('deja_demmander', $attestation);
            }

        } 
            $attestation = new attestation();
            $attestation->emp_id = auth()->user()->id;
            $attestation->date = date('Y-m-d');
            $attestation->reg = 0;
            $attestation->save();
            if ($attestation) {
                return \view('pages.attestations')->with('attestation', $attestation);
            } else {
                return \view('pages.attestations')->with('error', $attestation);
            }
    }
    public function demande_avances(Request $request)
    {
        $request->validate([
            'avance' => 'required|integer|between:0,8000',
        ], [
            'avance.required' => 'Le champ montant est obligatoire.',
            'avance.integer' => 'L\'avance doit être un entier.',
            'avance.between' => 'L\'avance doit être comprise entre 0 et 8000 DA.',
        ]);
        $avance = Avance::where('emp_id', auth()->user()->id)->where('month', date('m'))->where('year', date('Y'))->first();
        if ($avance) {
            if (date('d') >= 14) {
                return \view('pages.avances')->with('date_error', 'Vous pouvez pas changer l\'avance de ce mois aujourd\'hui.');
            }

            $avance->avance = $request->avance;
        } else {
            $avance = new Avance();
            $avance->avance = $request->avance;
            $avance->month = date('m');
            $avance->year = date('Y');
            $avance->emp_id = auth()->user()->id;
        }
        $avance->save();
        if ($avance) {
            return \view('pages.avances')->with('success', 'Operation effectuee avec succes.');
        } else {
            return \view('pages.avances')->with('error', 'Operation echoue. Veuillez reessayer.');
        }
        
    }
    public function show_attestations(Request $request)
    {
    $from = $request->start_date;
    $to = $request->end_date; 
    if ($request->ajax()) {

  $data = Attestation::Join('users', 'attestations.emp_id', '=', 'users.id')
            
            ->whereBetween('attestations.date', [$from, $to])
       ->select('attestations.id as id', 'attestations.created_at as date', 'attestations.reg as status', 'users.username as username');
      
        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '';

                    if($row->status != 1)  $btn .= '
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" onclick="put_id('.$row->id.',1);" data-target="#exampleModal">
                    معالجة الطلب
                  </button>
                  
                  '; 
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);    }
    return view('admin.attestation', ['sttart_date'=> $from,   'endd_date'=> $to]);

    }
    public function attestation_reg(Request $request){
        $attestation = Attestation::find($request->attestation);
        $attestation->reg = $request->status;
        
    $from = $request->from;
    $to = $request->to; 
        $attestation->save();
        if ($attestation) {
            return view('admin.attestation',  ['sttart_date'=> $from,   'endd_date'=> $to, 'attestation'=>1]);
        } else {
            return view('admin.attestation',  ['sttart_date'=> $from,   'endd_date'=> $to, 'attestation'=>0]);
        }
        
    }
    public function show_avances(Request $request){
        if ($request->has('month')) {
            $date_month = $request->month;
        } else {
            $date_month = date('m');
        }
        if ($request->has('year')) {
            $date_year = $request->year;
        } else {
            $date_year = date('Y');
        }
        $employeesWithAvances = Avance::with('users')->where('month', $date_month)->where('year', $date_year)->get();
        return view('pages.show_avances', compact('employeesWithAvances', 'date_month', 'date_year'));
    }
    public function getExcelData(Request $request)
    {
        // $request->validate([
        //     'file' => 'required|mimes:xlsx,xls|max:2048', // Excel file validation
        // ]);

        // // Store uploaded file in storage/app/uploads
        // $filePath = $request->file('file')->store('uploads');

        // // Process the Excel file using Laravel Excel package
        $filePath = storage_path('app/aaa.xlsx');
        $import = new MyImport();
        Excel::import($import, $filePath);

        // Retrieve imported data
        $data = $import->getData();

        // Optionally, you can save the data to database or perform additional processing
        return response()->json($data);
    }
    public function do_pointage(Request $request)
    {
        $status = Emp_status::get();
        $holidays = Holiday::get();
        $edited = 0;
        if (auth()->user()->is_ == 1) {
            $ctrls = User::whereIn('is_', [2,3])->get();
        
        if (isset($_COOKIE['date'])) {
            $date = $_COOKIE['date'];
        } else {
            $date = date('Y-m-d');
        }
        $holiday_id=0;
        $holiday = EmpInHoliday::where('date', $date)->first();
        if ($holiday) {
            $holiday_id = $holiday->holiday_id;
        }

        if (isset($_POST['ctrl'])) {
            $date = $request->date;
            foreach ($ctrls as $key => $ctrl) {
                $row = Pointage::where('date', $date)->where('emp_id', $ctrl->id)->first();
                if (!$row) {
                    Pointage::create(['emp_id' => $ctrl->id, 'date' => $date, 'emp_status_id' => $request['ctrl' . $ctrl->id]]);
                } else {
                    $row->emp_status_id = $request['ctrl' . $ctrl->id];
                    $row->save();
                    
                }
            }
            $edited = 1;
            $validate = Validate_pointage::where('date', $date)->first();
                    if (!$validate) {
                        Validate_pointage::create(['date' => $date, 'validation' => 1]);
                    }
                    else {
                        $validate->validation = 1;
                        $validate->save();
                    }
            $emps = Pointage::where('date', $date)->where('emp_status_id', 1)->get();
            $arr = [];
            foreach ($emps as $emp) {
                $arr[] = $emp->emp_id;
            }
            if ($request->holiday) {
                $holiday_id = $request->holiday;
                EmpInHoliday::create(['date' => $date, 'emps' => $arr, 'holiday_id' => $holiday_id]);
            }

        } 
        return view('pages.pointage', ['today' => $date, 'holidays' => $holidays, 'holiday_id' => $holiday_id, 'receveurs' => [], 'chauffeurs' => [], 'chefs' => [], 'controleurs' => $ctrls, 'status' => $status, 'edited' => $edited]);

        }
        $receveurs = User::where('is_', 7)->get();
        $chauffeurs = User::where('is_', 8)->get();
        $chefs = User::where('is_', 4)->get();
        if (isset($_COOKIE['date'])) {
            $date = $_COOKIE['date'];
        } else {
            $date = date('Y-m-d');
        }
        if (isset($_POST['rec'])) {
            $date = $request->date;
            $validate = Validate_pointage::where('date', $date)->first();
                    if ($validate) {
        return view('pages.pointage', ['today' => $date, 'holidays' => $holidays, 'receveurs' => [], 'chauffeurs' => [], 'chefs' => [], 'controleurs' => $ctrls, 'status' => $status, 'edited' => 0])->with(['error' => 'Deja validée par le chef service.']);

                    }
            foreach ($receveurs as $key => $value) {
                $row = Pointage::where('date', $date)->where('emp_id', $value->id)->first();
                if (!$row) {
                    Pointage::create(['emp_id' => $value->id, 'date' => $date, 'emp_status_id' => $request['rec' . $value->id]]);
                } else {
                    $row->emp_status_id = $request['rec' . $value->id];
                    $row->save();
                }
                // Pointage::create(['emp_id'=> $value->id, 'date'=> $date, 'emp_status_id'=> $request->rec.$value->id]);
            }
            $edited = 1;
        } elseif (isset($_POST['ch'])) {
            $date = $request->date;
            $validate = Validate_pointage::where('date', $date)->first();
                    if ($validate) {
        return view('pages.pointage', ['today' => $date, 'holidays' => $holidays, 'receveurs' => [], 'chauffeurs' => [], 'chefs' => [], 'controleurs' => $ctrls, 'status' => $status, 'edited' => 0])->with(['error' => 'Deja validée par le chef service.']);

                    }
            foreach ($chauffeurs as $key => $value) {
                $row = Pointage::where('date', $date)->where('emp_id', $value->id)->first();
                if (!$row) {
                    Pointage::create(['emp_id' => $value->id, 'date' => $date, 'emp_status_id' => $request['ch' . $value->id]]);
                } else {
                    $row->emp_status_id = $request['ch' . $value->id];
                    $row->save();
                }
                // Pointage::create(['emp_id'=> $value->id, 'date'=> $date, 'emp_status_id'=> $request->ch.$value->id]);
            }
            $edited = 1;
        }elseif (isset($_POST['chef'])) {
            $date = $request->date;
            foreach ($chefs as $key => $value) {
                $row = Pointage::where('date', $date)->where('emp_id', $value->id)->first();
                if (!$row) {
                    Pointage::create(['emp_id' => $value->id, 'date' => $date, 'emp_status_id' => $request['chef' . $value->id]]);
                } else {
                    $row->emp_status_id = $request['chef' . $value->id];
                    $row->save();
                }
                // Pointage::create(['emp_id'=> $value->id, 'date'=> $date, 'emp_status_id'=> $request->ch.$value->id]);
            }
            $edited = 1;
        }

        return view('pages.pointage', ['today' => $date, 'holidays' => $holidays, 'receveurs' => $receveurs, 'chauffeurs' => $chauffeurs, 'chefs' => $chefs, 'controleurs' => [], 'status' => $status, 'edited' => $edited]);
    }
    public function ExportExcel($etat_receveur, $etat_chauffeur, $etat_cs, $d, $d2, $m, $y)
    {
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', '40000M');
        try {

            $inputFileType = 'Xlsx';
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            $reader->setIncludeCharts(true);
            

            $month = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"];
            $month_ar = ["جانفي", "فيفري", "مارس", "أفريل", "ماي", "جوان", "جويلية", "أوت", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"];
            $month_abrv = ["Janv", "Févr", "Mars", "Avr", "Mai", "Juin", "Juil", "Août", "Sept", "Oct", "Nov", "Dec"];

            $spreadSheet = $reader->load('assets/word/Pointage.xlsx');
            $spreadSheet->setActiveSheetIndex(0);

            $spreadSheet->getActiveSheet()->fromArray(['RECEVEUR - ' . $month[$m] . ' ' . $y], null, 'I1');
            $spreadSheet->getActiveSheet()->fromArray($etat_receveur, null, 'B7');
            $spreadSheet->setActiveSheetIndex(1);

            $spreadSheet->getActiveSheet()->fromArray(['CHAUFFEUR - ' . $month[$m] . ' ' . $y], null, 'I1');
            $spreadSheet->getActiveSheet()->fromArray($etat_chauffeur, null, 'B7');

            $spreadSheet->setActiveSheetIndex(2);

            $spreadSheet->getActiveSheet()->fromArray(['CONTROLEUR - ' . $month[$m] . ' ' . $y], null, 'I1');
            $spreadSheet->getActiveSheet()->fromArray($etat_cs, null, 'B7');


            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            header('Content-Disposition: attachment;filename="pointage ' . $d . '-' . $d2 . ' ' . $month[$m] . ' ' . $y . '.xlsx"');

            $writer = IOFactory::createWriter($spreadSheet, 'Xlsx');
            $writer->setIncludeCharts(true);

            //save into php output
            $writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
    public function ExportExcelAvance($etat_avance, $m, $y)
    {
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', '40000M');
        try {

            $inputFileType = 'Xlsx';
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            $reader->setIncludeCharts(true);
            

            $month = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"];
            $month_ar = ["جانفي", "فيفري", "مارس", "أفريل", "ماي", "جوان", "جويلية", "أوت", "سبتمبر", "أكتوبر", "نوفمبر", "ديسمبر"];
            $month_abrv = ["Janv", "Févr", "Mars", "Avr", "Mai", "Juin", "Juil", "Août", "Sept", "Oct", "Nov", "Dec"];

            $spreadSheet = $reader->load('assets/word/Avance.xlsx');
            $spreadSheet->setActiveSheetIndex(0);

            $spreadSheet->getActiveSheet()->fromArray(['Avance - ' . $month[(int)$m -1] . ' ' . $y], null, 'D2');
            $spreadSheet->getActiveSheet()->fromArray($etat_avance, null, 'C8');

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            header('Content-Disposition: attachment;filename="Avance-'. $month[(int)$m -1] . '-' . $y . '.xlsx"');

            $writer = IOFactory::createWriter($spreadSheet, 'Xlsx');
            $writer->setIncludeCharts(true);

            //save into php output
            $writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
    }
    public function exportData(Request $request)
    {
        $req = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        $from = $req['start_date'];
        $to = $req['end_date'];

        $month = $request->month;
        $year = $request->year;
        /*    $current_month_first_day = new DateTime('first day of this month'); // first day of the current month
        $current_month_last_day  = date('t');  // last day of the current month
        $interval = new DateInterval('P1D');*/
        // Step 1: Setting the Start and End Dates
        $start_date = date_create($from);
        $end_date = date_create($to);

        $end_date = $end_date->add(DateInterval::createFromDateString('tomorrow'));
// Step 2: Defining the Date Interval
        $interval = new DateInterval('P1D');

// Step 3: Creating the Date Range
        $period = new DatePeriod($start_date, $interval, $end_date);
        if(auth()->user()->is_ == 6){
            
        foreach ($period as  $value) {
            $date = $value->format('Y-m-d');
            $validate_pointage = validate_pointage::where('date', $date)->where('validation', 1)->first();
            if (!$validate_pointage) {
                return view('controls.control')->with(['error' => 'Validation du pointage du ' . $date . ' n\'a pas été effectuée.']);
            }
        }
        }

        //  $period = new DatePeriod($current_month_first_day, $interval, $current_month_last_day - 1);
        $date = date('Y-m-d');
        $c_transformedData = [];
        $r_transformedData = [];
        $ch_transformedData = [];

        $users = User::get();
        foreach ($users as $user) {
            $attendanceData = [];
            foreach ($period as $value) {
                if ($value->format("Y-m-d") <= $date) {
                    // Retrieve the attendance status for the user on the current date
                    $attendance = Pointage::where('emp_id', $user->id)
                        ->whereDate('date', $value->format("Y-m-d"))
                        ->join('emp_statuses', 'emp_statuses.id', '=', 'pointages.emp_status_id')
                        ->first();

                    // Determine the attendance status (default to 'absent' if no record found)
                    $status = $attendance ? $attendance->name : '';

                    // Store the attendance status for the user
                    $attendanceData[$value->format("Y-m-d")] = $status;
                }
            }
            // Add the attendance data for the current date to the transformed data array
            switch ($user->is_) {
                case 2:
                    $c_transformedData[$user->username] = $attendanceData;
                    break;
                case 7:
                    $r_transformedData[$user->username] = $attendanceData;
                    break;
                case 8:
                    $ch_transformedData[$user->username] = $attendanceData;
                    break;
                default:
                    # code...
                    break;
            }

        }
        // Output the transformed data (days as rows, users as columns)

        //   return response()->json(['data' => $transformedData]);

        $rec = [];
        $ch = [];
        // Initialize the matrix array
        $controleur = [];

        // Loop through each user
        foreach ($r_transformedData as $user => $attendance) {
            // Initialize a row array for the current user
            $rowData = [$user];

            // Append attendance statuses to the row array
            foreach ($attendance as $status) {
                $rowData[] = $status;
            }

            // Add the row data to the matrix
            $rec[] = $rowData;
        }
        foreach ($ch_transformedData as $user => $attendance) {
            // Initialize a row array for the current user
            $rowData = [$user];

            // Append attendance statuses to the row array
            foreach ($attendance as $status) {
                $rowData[] = $status;
            }

            // Add the row data to the matrix
            $ch[] = $rowData;
        }
        foreach ($c_transformedData as $user => $attendance) {
            // Initialize a row array for the current user
            $rowData = [$user];

            // Append attendance statuses to the row array
            foreach ($attendance as $status) {
                $rowData[] = $status;
            }

            // Add the row data to the matrix
            $controleur[] = $rowData;
        }

        return $this->ExportExcel($rec, $ch, $controleur, $from, $to, $month, $year);
    }
    public function import_paie(Request $request){
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls|max:4096', // Adjust the validation rules as needed
        ]);
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = 'paie-' . date('Y-m') . '.' . $file->getClientOriginalExtension();
            $existingFilePath = storage_path('app/public/files') . '/' . $fileName;
            if (File::exists($existingFilePath)) {
                File::delete($existingFilePath);
            }        
    // Parse the Excel file to extract matricule and salary
    $excelData = Excel::toCollection([], $file)[0]; // Assuming first sheet is used
            $file->move(storage_path('app/public/files'), $fileName);
     
    foreach ($excelData as $row) {
        // Assuming the first column contains matricule and the second column contains salary
        $matricule = $row[0];
        $salary = $row[3];
        
        // Find the user by matricule and update salary
        $user = User::where('matricule', $matricule)->first();
        if ($user) {
            $user->salaire = $salary;
            $user->salaire_mois = date('m') - 1;
            $user->save();
        }
    }
                return view('controls.control')->with(['success' => 'Fichier uploadé avec succès.']);
        }
            return view('controls.control')->with('error', 'Échec d\'uploader le fichier. Veuillez réessayer.');

    }
    public function exportDataAvance(Request $request)
    {
                $etat_avance = [];

        
        if ($request->has('month')) {
            $date_month = $request->month;
        } else {
            $date_month = date('m');
        }
        if ($request->has('year')) {
            $date_year = $request->year;
        } else {
            $date_year = date('Y');
        }
        $employeesWithAvances = Avance::with('users')->where('month', $date_month)->where('year', $date_year)->get();
       $total = 0;
        foreach ($employeesWithAvances as $key => $employee) {
            $arr = array(
                'Num' => $key +1,
                'user' => $employee->users->username,
                'amount' => $employee->avance,
            );
            $total += $employee->avance;
            array_push($etat_avance, $arr);
        }
        $arr = array(
            'Num' => '',
            'user' => '',
            'amount' => $total,
        );
        array_push($etat_avance, $arr);


        return $this->ExportExcelAvance($etat_avance, $date_month, $date_year);
    }
}
