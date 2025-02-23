<?php

// app/Http/Controllers/ExcelController.php

namespace App\Http\Controllers;

use App\Imports\MyImport;
use App\Models\admin_empInHoliday;
use App\Models\admin_emp_recup; // Import class for parsing
use App\Models\admin_pointage;
use App\Models\admin_validate_pointage;
use App\Models\attestation;
use App\Models\Avance;
use App\Models\DemandeEvent;
use App\Models\EmpInHoliday;
use App\Models\Emp_dj;
use App\Models\Emp_recup;
use App\Models\Emp_rj;
use App\Models\Emp_status;
use App\Models\Event;
use App\Models\Holiday;
use App\Models\Image;
use App\Models\maint_empInHoliday;
use App\Models\maint_emp_recup;
use App\Models\maint_pointage;
use App\Models\maint_validate_pointage;
use App\Models\Pointage;
use App\Models\User;
use App\Models\validate_pointage;
use DataTables;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Mpdf\Mpdf;
// Adjust the namespace and model name as needed
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Exception;

class ExcelController extends Controller
{
    public function generatePDF_repos(Request $request)
    {

        if (in_array(auth()->user()->is_, [1, 6])) {
            $arr = [];
            if ($request->admin) {
                $arr = [1, 3, 5];
            }
            $query1 = User::whereIn('service', $arr)->select('id', 'username', 'service', 'R');
            $query2 = User::where('service', $request->exp ?? 98)->select('id', 'username', 'service', 'R');
            // $query3 = User::where('service', $request->compta ?? 98)->select('id','username', 'service','R');
            $query4 = User::where('service', $request->maint ?? 98)->select('id', 'username', 'service', 'R');
            // $query5 = User::where('service', $request->stock ?? 98)->select('id','username', 'service','R');

            // Combining the two queries using union->union($query3)->union($query5)
            $emps = $query1->union($query2)->union($query4)->get();
        } else {
            $emps = User::where('id', auth()->user()->id)->select('id', 'username', 'service', 'R')->get();
        }
        foreach ($emps as $emp) {
            $new = $emp->R;
            foreach (Holiday::get() as $holiday) {
                if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
                    $recup = admin_emp_recup::where('emp_id', $emp->id)->where('holiday_id', $holiday->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } elseif ($emp->service == 4) {
                    $recup = maint_emp_recup::where('emp_id', $emp->id)->where('holiday_id', $holiday->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } elseif ($emp->service == 2) {
                    $recup = Emp_recup::where('emp_id', $emp->id)->where('holiday_id', $holiday->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } else
                    $recup = 0;

                $emp[$holiday->name] = $recup;
                $new += $recup;
            }
            foreach (Event::get() as $event) {
                if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
                    $recup = admin_emp_recup::where('emp_id', $emp->id)->where('event_id', $event->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } elseif ($emp->service == 4) {
                    $recup = maint_emp_recup::where('emp_id', $emp->id)->where('event_id', $event->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } elseif ($emp->service == 2) {
                    $recup = Emp_recup::where('emp_id', $emp->id)->where('event_id', $event->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } else
                    $recup = 0;

                $emp[$event->name] = $recup;
                $new += $recup;
            }

            if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
                $emp['repos'] = admin_emp_recup::where('emp_id', $emp->id)->whereYear('date', date('Y'))->where('sign', 0)->count();
            } elseif ($emp->service == 4) {
                $emp['repos'] = maint_emp_recup::where('emp_id', $emp->id)->whereYear('date', date('Y'))->where('sign', 0)->count();
            } elseif ($emp->service == 2) {
                $emp['repos'] = Emp_recup::where('emp_id', $emp->id)->whereYear('date', date('Y'))->where('sign', 0)->count();
            } else
                $emp['repos'] = 0;

            $emp['new'] = $new - $emp['repos'];
        }

        $holidays = Holiday::all();
        $events = Event::all();

        $html = view('pdf.repos', compact('emps', 'holidays', 'events'))->render();

        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-L', 'default_font' => 'Amiri']);
        $mpdf->WriteHTML($html);

        return $mpdf->Output('وضعية أيام الراحة العالقة.pdf', 'D'); // Download PDF

    }
    public function generatePDF_repos_j(Request $request)
    {
        if (in_array(auth()->user()->is_, [1, 6])) {
            $arr = [];
            //     if ($request->admin) {
            //         $arr = [1, 3,5];
            //     }
            //         $query1 = User::whereIn('service', $arr)->select('id','username', 'service','R');
            //         $query2 = User::where('service', $request->exp ?? 98)->select('id','username', 'service','R');
            //         // $query3 = User::where('service', $request->compta ?? 98)->select('id','username', 'service','R');
            //         $query4 = User::where('service', $request->maint ?? 98)->select('id','username', 'service','R');
            //         // $query5 = User::where('service', $request->stock ?? 98)->select('id','username', 'service','R');

            // // Combining the two queries using union->union($query3)->union($query5)
            //     $emps = $query1->union($query2)->union($query4)->get();
            $emps = User::where('service', 2)->select('id', 'username', 'service', 'R')->get();
        } else {
            $emps = User::where('id', auth()->user()->id)->select('id', 'username', 'service', 'RJ')->get();
        }
        foreach ($emps as $emp) {
            $new = $emp->RJ;
            $rj = Emp_rj::where('emp_id', $emp->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
            $new += $rj;
            $emp['pj'] = $rj;

            $emp['rj'] = Emp_rj::where('emp_id', $emp->id)->whereYear('date', date('Y'))->where('sign', 0)->count();
            $emp['new'] = $new - $emp['rj'];
        }

        $holidays = Holiday::all();
        $events = Event::all();

        $html = view('pdf.repos_j', compact('emps', 'holidays', 'events'))->render();

        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-L', 'default_font' => 'Amiri']);
        $mpdf->WriteHTML($html);

        return $mpdf->Output('وضعية أيام الراحة الكاملة.pdf', 'D'); // Download PDF

    }
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
            if ((int) $interval->format('%a') < 30) {
                return redirect()->back()->with('date_error', 'Vou avez deja demmander une attestation .');
            }
        }

        return view('pages.attestations');
    }
    public function events()
    {

        return view('pages.events', ['events' => Event::get()]);
    }
    public function recup_edit(Request $request)
    {
        $emp_id = $request->emp_id;

        $emp = User::where('id', $emp_id)->select('id', 'username', 'service', 'R')->first();
        $total_recups = [];
        if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
            admin_emp_recup::whereId($request->id)->update(['emp_status_id' => $request->status]);
            admin_pointage::where('emp_id', $emp_id)->where('date', $request->date)->update(['emp_status_id' => $request->status]);
            $total_recups = admin_emp_recup::where('emp_id', $emp_id)
                ->leftjoin('holidays', 'holidays.id', '=', 'admin_emp_recups.holiday_id')
                ->leftjoin('events', 'events.id', '=', 'admin_emp_recups.event_id')
                ->whereYear('date', date('Y'))
                ->select('admin_emp_recups.*', 'holidays.name as holiday', 'events.name as event');

            // $dj = Emp_dj::where('emp_id', $emp_id)
            //     ->whereYear('date', date('Y'))
            //     ->select('admin_emp_recups.*');

            // $total_recups = $recups->union($dj)->get();

        } elseif ($emp->service == 4) {
            maint_emp_recup::whereId($request->id)->update(['emp_status_id' => $request->status]);
            maint_pointage::where('emp_id', $emp_id)->where('date', $request->date)->update(['emp_status_id' => $request->status]);
            $total_recups = maint_emp_recup::where('emp_id', $emp_id)
                ->leftjoin('holidays', 'holidays.id', '=', 'maint_emp_recups.holiday_id')
                ->leftjoin('events', 'events.id', '=', 'maint_emp_recups.event_id')
                ->whereYear('date', date('Y'))
                ->select('maint_emp_recups.*', 'holidays.name as holiday', 'events.name as event');

            // $dj = Emp_dj::where('emp_id', $emp_id)
            //     ->whereYear('date', date('Y'))
            //     ->select('maint_emp_recups.*');

            // $total_recups = $recups->union($dj)->get();

        } elseif ($emp->service == 2) {
            Emp_recup::whereId($request->id)->update(['emp_status_id' => $request->status]);
            Pointage::where('emp_id', $emp_id)->where('date', $request->date)->update(['emp_status_id' => $request->status]);

            $total_recups = Emp_recup::where('emp_id', $emp_id)
                ->leftjoin('holidays', 'holidays.id', '=', 'emp_recups.holiday_id')
                ->leftjoin('events', 'events.id', '=', 'emp_recups.event_id')
                ->whereYear('date', date('Y'))
                ->select('emp_recups.*', 'holidays.name as holiday', 'events.name as event')->get();
        }

        return view('pages.repos_details', ['emp' => $emp, 'recups' => $total_recups]);
    }
    public function recup_delete(Request $request)
    {
        $emp_id = $request->emp_id;

        $emp = User::where('id', $emp_id)->select('id', 'username', 'service', 'R')->first();
        $total_recups = [];
        if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
            admin_emp_recup::whereId($request->id)->delete();
            $total_recups = admin_emp_recup::where('emp_id', $id)
                ->leftjoin('holidays', 'holidays.id', '=', 'admin_emp_recups.holiday_id')
                ->leftjoin('events', 'events.id', '=', 'admin_emp_recups.event_id')
                ->whereYear('date', date('Y'))
                ->select('admin_emp_recups.*', 'holidays.name as holiday', 'events.name as event');

            // $dj = Emp_dj::where('emp_id', $id)
            //     ->whereYear('date', date('Y'))
            //     ->select('admin_emp_recups.*');

            // $total_recups = $recups->union($dj)->get();

        } elseif ($emp->service == 4) {
            maint_emp_recup::whereId($request->id)->delete();
            $total_recups = maint_emp_recup::where('emp_id', $id)
                ->leftjoin('holidays', 'holidays.id', '=', 'maint_emp_recups.holiday_id')
                ->leftjoin('events', 'events.id', '=', 'maint_emp_recups.event_id')
                ->whereYear('date', date('Y'))
                ->select('maint_emp_recups.*', 'holidays.name as holiday', 'events.name as event');

            // $dj = Emp_dj::where('emp_id', $id)
            //     ->whereYear('date', date('Y'))
            //     ->select('maint_emp_recups.*');

            // $total_recups = $recups->union($dj)->get();

        } elseif ($emp->service == 2) {
            Emp_recup::whereId($request->id)->delete();
            $total_recups = Emp_recup::where('emp_id', $id)
                ->leftjoin('holidays', 'holidays.id', '=', 'emp_recups.holiday_id')
                ->leftjoin('events', 'events.id', '=', 'emp_recups.event_id')
                ->whereYear('date', date('Y'))
                ->select('emp_recups.*', 'holidays.name as holiday', 'events.name as event')->get();
        }

        return view('pages.repos_details', ['emp' => $emp, 'recups' => $total_recups]);
    }
    public function repos()
    {
        if (in_array(auth()->user()->is_, [1, 6])) {
            $emps = User::where('id', '!=', 1)->select('id', 'username', 'service', 'R')->get();
        } else {
            $emps = User::where('id', auth()->user()->id)->select('id', 'username', 'service', 'R')->get();
        }
        foreach ($emps as $emp) {
            $new = $emp->R;
            foreach (Holiday::get() as $holiday) {
                if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
                    $recup = admin_emp_recup::where('emp_id', $emp->id)->where('holiday_id', $holiday->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } elseif ($emp->service == 4) {
                    $recup = maint_emp_recup::where('emp_id', $emp->id)->where('holiday_id', $holiday->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } elseif ($emp->service == 2) {
                    $recup = Emp_recup::where('emp_id', $emp->id)->where('holiday_id', $holiday->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } else
                    $recup = 0;

                $emp[$holiday->name] = $recup;
                $new += $recup;
            }
            foreach (Event::get() as $event) {
                if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
                    $recup = admin_emp_recup::where('emp_id', $emp->id)->where('event_id', $event->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } elseif ($emp->service == 4) {
                    $recup = maint_emp_recup::where('emp_id', $emp->id)->where('event_id', $event->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } elseif ($emp->service == 2) {
                    $recup = Emp_recup::where('emp_id', $emp->id)->where('event_id', $event->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } else
                    $recup = 0;

                $emp[$event->name] = $recup;
                $new += $recup;
            }

            if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
                $emp['repos'] = admin_emp_recup::where('emp_id', $emp->id)->whereYear('date', date('Y'))->where('sign', 0)->count();
            } elseif ($emp->service == 4) {
                $emp['repos'] = maint_emp_recup::where('emp_id', $emp->id)->whereYear('date', date('Y'))->where('sign', 0)->count();
            } elseif ($emp->service == 2) {
                $emp['repos'] = Emp_recup::where('emp_id', $emp->id)->whereYear('date', date('Y'))->where('sign', 0)->count();
            } else
                $emp['repos'] = 0;

            $emp['new'] = $new - $emp['repos'];
        }

        return view('pages.repos', ['events' => Event::get(), 'holidays' => Holiday::get(), 'emps' => $emps]);
    }
    public function update_r()
    {
        $targetyear = now()->year-1;
        //modification R
        // $emps = User::where('id', '!=', 1)->select('id', 'username', 'service', 'R')->get();
        // foreach ($emps as $emp) {
        //     $new = $emp->R;
        //     foreach (Holiday::get() as $holiday) {
        //         if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
        //             $recup = admin_emp_recup::where('emp_id', $emp->id)->where('holiday_id', $holiday->id)->where('sign', 1)->whereYear('date', $targetyear)->count();
        //         } elseif ($emp->service == 4) {
        //             $recup = maint_emp_recup::where('emp_id', $emp->id)->where('holiday_id', $holiday->id)->where('sign', 1)->whereYear('date', $targetyear)->count();
        //         } elseif ($emp->service == 2) {
        //             $recup = Emp_recup::where('emp_id', $emp->id)->where('holiday_id', $holiday->id)->where('sign', 1)->whereYear('date', $targetyear)->count();
        //         } else
        //             $recup = 0;

        //         // $emp[$holiday->name] = $recup;
        //         $new += $recup;

        //     }
        //     foreach (Event::get() as $event) {
        //         if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
        //             $recup = admin_emp_recup::where('emp_id', $emp->id)->where('event_id', $event->id)->where('sign', 1)->whereYear('date', $targetyear)->count();
        //         } elseif ($emp->service == 4) {
        //             $recup = maint_emp_recup::where('emp_id', $emp->id)->where('event_id', $event->id)->where('sign', 1)->whereYear('date', $targetyear)->count();
        //         } elseif ($emp->service == 2) {
        //             $recup = Emp_recup::where('emp_id', $emp->id)->where('event_id', $event->id)->where('sign', 1)->whereYear('date', $targetyear)->count();
        //         } else
        //             $recup = 0;
        //         // $emp[$event->name] = $recup;
        //         $new += $recup;
        //     }

        //     if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
        //         $emprepos = admin_emp_recup::where('emp_id', $emp->id)->whereYear('date', $targetyear)->where('sign', 0)->count();
        //     } elseif ($emp->service == 4) {
        //         $emprepos = maint_emp_recup::where('emp_id', $emp->id)->whereYear('date', $targetyear)->where('sign', 0)->count();
        //     } elseif ($emp->service == 2) {
        //         $emprepos = Emp_recup::where('emp_id', $emp->id)->whereYear('date', $targetyear)->where('sign', 0)->count();
        //     } else
        //         $emprepos = 0;

        //     $empnew = $new - $emprepos;

            // $emp->R = $empnew;
            // $emp->save();
        // }
        //modification RJ       
        // $emps2 = User::where('service', 2)->select('id', 'username', 'service', 'RJ')->get();  
        // foreach ($emps2 as $emp) {
        //     $new = $emp->RJ;
        //     $rj = Emp_rj::where('emp_id', $emp->id)->where('sign', 1)->whereYear('date', $targetyear)->count();
        //     $new += $rj;
        //     // $emp['pj'] = $rj;
            
        //     $emprj = Emp_rj::where('emp_id', $emp->id)->whereYear('date', $targetyear)->where('sign', 0)->count();
        //     $empnew = $new - $emprj;
        //     $emp->RJ = $empnew;
        //     $emp->save();
        // }
        return redirect()->back();
    }

    public function repo(Request $request)
    {
        $arr = [];
        if ($request->admin) {
            $arr = [1, 3, 5];
        }
        $query1 = User::whereIn('service', $arr)->select('id', 'username', 'service', 'R');
        $query2 = User::where('service', $request->exp ?? 98)->select('id', 'username', 'service', 'R');
        // $query3 = User::where('service', $request->compta ?? 98)->select('id','username', 'service','R');
        $query4 = User::where('service', $request->maint ?? 98)->select('id', 'username', 'service', 'R');
        // $query5 = User::where('service', $request->stock ?? 98)->select('id','username', 'service','R');

        // Combining the two queries using union->union($query3)->union($query5)
        $emps = $query1->union($query2)->union($query4)->get();

        foreach ($emps as $emp) {
            $new = $emp->R;
            foreach (Holiday::get() as $holiday) {
                if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
                    $recup = admin_emp_recup::where('emp_id', $emp->id)->where('holiday_id', $holiday->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } elseif ($emp->service == 4) {
                    $recup = maint_emp_recup::where('emp_id', $emp->id)->where('holiday_id', $holiday->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } elseif ($emp->service == 2) {
                    $recup = Emp_recup::where('emp_id', $emp->id)->where('holiday_id', $holiday->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } else
                    $recup = 0;

                $emp[$holiday->name] = $recup;
                $new += $recup;
            }
            foreach (Event::get() as $event) {
                if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
                    $recup = admin_emp_recup::where('emp_id', $emp->id)->where('event_id', $event->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } elseif ($emp->service == 4) {
                    $recup = maint_emp_recup::where('emp_id', $emp->id)->where('event_id', $event->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } elseif ($emp->service == 2) {
                    $recup = Emp_recup::where('emp_id', $emp->id)->where('event_id', $event->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
                } else
                    $recup = 0;

                $emp[$event->name] = $recup;
                $new += $recup;
            }

            if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
                $emp['repos'] = admin_emp_recup::where('emp_id', $emp->id)->whereYear('date', date('Y'))->where('sign', 0)->count();
            } elseif ($emp->service == 4) {
                $emp['repos'] = maint_emp_recup::where('emp_id', $emp->id)->whereYear('date', date('Y'))->where('sign', 0)->count();
            } elseif ($emp->service == 2) {
                $emp['repos'] = Emp_recup::where('emp_id', $emp->id)->whereYear('date', date('Y'))->where('sign', 0)->count();
            } else
                $emp['repos'] = 0;

            $emp['new'] = $new - $emp['repos'];
        }

        return view('pages.repos', ['events' => Event::get(), 'holidays' => Holiday::get(), 'emps' => $emps, 'admin' => ($request->admin) ? 'checked' : '', 'exp' => ($request->exp) ? 'checked' : '', 'compta' => ($request->compta) ? 'checked' : '', 'maint' => ($request->maint) ? 'checked' : '', 'stock' => ($request->stock) ? 'checked' : '']);
    }
    public function repos_j()
    {
        if (in_array(auth()->user()->is_, [1, 6])) {
            // $emps = User::where('id', '!=', 1)->select('id','username', 'service','RJ')->get();
            $emps = User::where('service', 2)->select('id', 'username', 'service', 'RJ')->get();
        } else {
            $emps = User::where('id', auth()->user()->id)->select('id', 'username', 'service', 'RJ')->get();
        }
        foreach ($emps as $emp) {
            $new = $emp->RJ;
            $rj = Emp_rj::where('emp_id', $emp->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
            $new += $rj;
            $emp['pj'] = $rj;

            $emp['rj'] = Emp_rj::where('emp_id', $emp->id)->whereYear('date', date('Y'))->where('sign', 0)->count();
            $emp['new'] = $new - $emp['rj'];
        }

        return view('pages.repos_j', ['emps' => $emps]);
    }
    public function repo_j(Request $request)
    {
        $arr = [];
        if ($request->admin) {
            $arr = [1, 3, 5];
        }
        $query1 = User::whereIn('service', $arr)->select('id', 'username', 'service', 'RJ');
        $query2 = User::where('service', $request->exp ?? 98)->select('id', 'username', 'service', 'RJ');
        // $query3 = User::where('service', $request->compta ?? 98)->select('id','username', 'service','RJ');
        $query4 = User::where('service', $request->maint ?? 98)->select('id', 'username', 'service', 'RJ');
        // $query5 = User::where('service', $request->stock ?? 98)->select('id','username', 'service','RJ');

        // Combining the two queries using union->union($query3)->union($query5)
        $emps = $query1->union($query2)->union($query4)->get();

        foreach ($emps as $emp) {
            $new = $emp->RJ;
            $rj = Emp_rj::where('emp_id', $emp->id)->where('sign', 1)->whereYear('date', date('Y'))->count();
            $new += $rj;
            $emp['pj'] = $rj;

            $emp['rj'] = Emp_rj::where('emp_id', $emp->id)->whereYear('date', date('Y'))->where('sign', 0)->count();
            $emp['new'] = $new - $emp['rj'];
        }

        return view('pages.repos_j', ['emps' => $emps, 'admin' => ($request->admin) ? 'checked' : '', 'exp' => ($request->exp) ? 'checked' : '', 'compta' => ($request->compta) ? 'checked' : '', 'maint' => ($request->maint) ? 'checked' : '', 'stock' => ($request->stock) ? 'checked' : '']);
    }
    public function details($id)
    {

        $emp = User::where('id', $id)->select('id', 'username', 'service', 'R')->first();
        $total_recups = [];
        if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
            $total_recups = admin_emp_recup::where('emp_id', $id)
                ->leftjoin('holidays', 'holidays.id', '=', 'admin_emp_recups.holiday_id')
                ->leftjoin('events', 'events.id', '=', 'admin_emp_recups.event_id')
                ->whereYear('date', date('Y'))
                ->select('admin_emp_recups.*', 'holidays.name as holiday', 'events.name as event');

            // $dj = Emp_dj::where('emp_id', $id)
            //     ->whereYear('date', date('Y'))
            //     ->select('admin_emp_recups.*');

            // $total_recups = $recups->union($dj)->get();

        } elseif ($emp->service == 4) {
            $total_recups = maint_emp_recup::where('emp_id', $id)
                ->leftjoin('holidays', 'holidays.id', '=', 'maint_emp_recups.holiday_id')
                ->leftjoin('events', 'events.id', '=', 'maint_emp_recups.event_id')
                ->whereYear('date', date('Y'))
                ->select('maint_emp_recups.*', 'holidays.name as holiday', 'events.name as event');

            // $dj = Emp_dj::where('emp_id', $id)
            //     ->whereYear('date', date('Y'))
            //     ->select('maint_emp_recups.*');

            // $total_recups = $recups->union($dj)->get();

        } elseif ($emp->service == 2) {
            $total_recups = Emp_recup::where('emp_id', $id)
                ->leftjoin('holidays', 'holidays.id', '=', 'emp_recups.holiday_id')
                ->leftjoin('events', 'events.id', '=', 'emp_recups.event_id')
                ->whereYear('date', date('Y'))
                ->select('emp_recups.*', 'holidays.name as holiday', 'events.name as event')->get();
        }

        return view('pages.repos_details', ['emp' => $emp, 'recups' => $total_recups]);
    }
    public function details_rj($id)
    {

        $emp = User::where('id', $id)->select('id', 'username', 'service', 'RJ')->first();

        $rjs = Emp_rj::where('emp_id', $id)
            ->whereYear('date', date('Y'))
            ->get();

        return view('pages.repos_j_details', ['emp' => $emp, 'rjs' => $rjs]);
    }
    public function demande_attestations(Request $request)
    {

        $attestation = attestation::where('emp_id', auth()->user()->id)->latest()->first();
        if ($attestation) {
            $date1 = new DateTime(date('Y-m-d'));
            $date2 = new DateTime($attestation->date);
            $interval = $date2->diff($date1);
            $interval = $date2->diff($date1);
            if ((int) $interval->format('%a') < 30) {
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
    public function demande_events(Request $request)
    {

        $events = Event::get();
        $event = new DemandeEvent();
        $event->emp_id = auth()->user()->id;
        $event->event_id = $request->event_id;
        $event->date = date('Y-m-d');
        $event->valide = 0;
        $event->nbr_jr = 0;
        $event->save();
        if ($event) {
            return \view('pages.events', ['events' => $events])->with('event', $event);
        } else {
            return \view('pages.events', ['events' => $events])->with('error', $event);
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
                ->select('attestations.id as id', 'attestations.created_at as date', 'attestations.reg as status', 'users.username as username', 'service');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';

                    if ($row->status != 1) {
                        $btn .= '
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" onclick="put_id(' . $row->id . ',1);" data-target="#exampleModal">
                    معالجة الطلب
                  </button>

                  ';
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.attestation', ['sttart_date' => $from, 'endd_date' => $to]);
    }
    public function show_events(Request $request)
    {
        $from = $request->start_date;
        $to = $request->end_date;

        if ($request->ajax()) {

            $data = DemandeEvent::Join('users', 'demande_events.emp_id', '=', 'users.id')
                ->Join('events', 'demande_events.event_id', '=', 'events.id')

                ->whereBetween('demande_events.date', [$from, $to])
                ->select('demande_events.id as id', 'demande_events.created_at as date', 'events.name as name', 'demande_events.valide as status', 'users.username as username', 'service');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';

                    if ($row->status != 1) {
                        $btn .= '
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" onclick="put_id(' . $row->id . ',1);" data-target="#exampleModal">
                    معالجة الطلب
                  </button>

                  ';
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.event', ['sttart_date' => $from, 'endd_date' => $to]);
    }
    public function attestation_reg(Request $request)
    {
        $attestation = Attestation::find($request->attestation);
        $attestation->reg = $request->status;

        $from = $request->from;
        $to = $request->to;
        $attestation->save();
        if ($attestation) {
            return view('admin.attestation', ['sttart_date' => $from, 'endd_date' => $to, 'attestation' => 1]);
        } else {
            return view('admin.attestation', ['sttart_date' => $from, 'endd_date' => $to, 'attestation' => 0]);
        }
    }
    public function event_reg(Request $request)
    {
        $event = DemandeEvent::find($request->event);
        $event->valide = $request->status;
        $event->nbr_jr = $request->nbr_jr;
        $date = date('Y-m-d');

        $from = $request->from;
        $to = $request->to;
        $event->save();
        $emp = User::find($event->emp_id);
        for ($i = 0; $i < $request->nbr_jr; $i++) {

            if ($emp->service == 1 || $emp->service == 3 || $emp->service == 5) {
                admin_emp_recup::create(['date' => $date, 'emp_id' => $event->emp_id, 'emp_status_id' => 1, 'sign' => 1, 'event_id' => $event->event_id]);
            } elseif ($emp->service == 4) {
                maint_emp_recup::create(['date' => $date, 'emp_id' => $event->emp_id, 'emp_status_id' => 1, 'sign' => 1, 'event_id' => $event->event_id]);
            } elseif ($emp->service == 2) {
                Emp_recup::create(['date' => $date, 'emp_id' => $event->emp_id, 'emp_status_id' => 1, 'sign' => 1, 'event_id' => $event->event_id]);
            }
        }
        if ($event) {
            return view('admin.event', ['sttart_date' => $from, 'endd_date' => $to, 'event' => 1]);
        } else {
            return view('admin.event', ['sttart_date' => $from, 'endd_date' => $to, 'event' => 0]);
        }
    }
    public function show_avances(Request $request)
    {
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
            $ctrls = User::whereIn('is_', [2, 3])->get();

            if (isset($_COOKIE['date'])) {
                $date = $_COOKIE['date'];
            } else {
                $date = date('Y-m-d');
            }
            $holiday_id = 0;
            $holiday = EmpInHoliday::where('date', $date)->first();
            if ($holiday) {
                $holiday_id = $holiday->holiday_id;
            } elseif ($request->holiday) {
                $holiday_id = $request->holiday;
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

                    $emps = Pointage::where('date', $date)->get();
                    $arr = [];
                    foreach ($emps as $emp) {
                        if ($holiday_id && ($emp->emp_status_id == 1 || $emp->emp_status_id == 2)) {
                            $arr[] = $emp->emp_id;
                            Emp_recup::create(['date' => $date, 'emp_id' => $emp->emp_id, 'emp_status_id' => $emp->emp_status_id, 'sign' => 1, 'holiday_id' => $holiday_id]);
                        }
                        if ($emp->emp_status_id == 2) {
                            Emp_rj::create(['date' => $date, 'emp_id' => $emp->emp_id, 'emp_status_id' => $emp->emp_status_id, 'sign' => 1]);
                        } elseif ($emp->emp_status_id == 7 || $emp->emp_status_id == 11) {
                            Emp_recup::create(['date' => $date, 'emp_id' => $emp->emp_id, 'emp_status_id' => $emp->emp_status_id, 'sign' => 0, 'holiday_id' => null]);
                        } elseif ($emp->emp_status_id == 8) {
                            Emp_rj::create(['date' => $date, 'emp_id' => $emp->emp_id, 'emp_status_id' => $emp->emp_status_id, 'sign' => 0]);
                        }
                    }
                    if (!$holiday && $holiday_id) {
                        EmpInHoliday::create(['date' => $date, 'emps' => $arr, 'holiday_id' => $holiday_id]);
                    }
                } else {
                    $validate->validation = 1;
                    $validate->save();
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
            $validate = Validate_pointage::where('date', $date)->where('validation', 1)->first();
            if ($validate) {
                return view('pages.pointage', ['today' => $date, 'holidays' => $holidays, 'receveurs' => $receveurs, 'chauffeurs' => $chauffeurs, 'chefs' => $chefs, 'controleurs' => [], 'status' => $status, 'edited' => 0])->with(['error' => 'Deja validée par le chef service.']);
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
            $validate = Validate_pointage::where('date', $date)->where('validation', 1)->first();
            if ($validate) {
                return view('pages.pointage', ['today' => $date, 'holidays' => $holidays, 'receveurs' => $receveurs, 'chauffeurs' => $chauffeurs, 'chefs' => $chefs, 'controleurs' => [], 'status' => $status, 'edited' => 0])->with(['error' => 'Deja validée par le chef service.']);
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
        } elseif (isset($_POST['chef'])) {
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

    public function do_pointage_admin(Request $request)
    {

        $status = Emp_status::get();
        $holidays = Holiday::get();
        $edited = 0;
        if (auth()->user()->is_ == 6) {
            $ctrls = User::where('is_', 10)->whereIn('service', [1, 3, 4])->get();

            if (isset($_COOKIE['date'])) {
                $date = $_COOKIE['date'];
            } else {
                $date = date('Y-m-d');
            }
            $holiday_id = 0;
            $holiday_maint = maint_empInHoliday::where('date', $date)->first();
            $holiday_admin = admin_empInHoliday::where('date', $date)->first();
            if ($holiday_admin) {
                $holiday_id = $holiday_admin->holiday_id;
            }
            if ($holiday_maint) {
                $holiday_id = $holiday_maint->holiday_id;
            }
            if ($request->holiday) {
                $holiday_id = $request->holiday;
            }

            if (isset($_POST['ctrl'])) {

                $edited = 1;
                $validate_admin = admin_validate_pointage::where('date', $date)->first();
                if (!$validate_admin) {
                    admin_validate_pointage::create(['date' => $date, 'validation' => 1]);

                    $emps = admin_pointage::where('date', $date)->get();
                    $arr = [];
                    foreach ($emps as $emp) {
                        if ($holiday_id && ($emp->emp_status_id == 1 || $emp->emp_status_id == 2|| $emp->emp_status_id == 17)) {
                            $arr[] = $emp->emp_id;
                            admin_emp_recup::create(['date' => $date, 'emp_id' => $emp->emp_id, 'emp_status_id' => $emp->emp_status_id, 'sign' => 1, 'holiday_id' => $holiday_id]);
                        } elseif ($emp->emp_status_id == 7 || $emp->emp_status_id == 11) {
                            admin_emp_recup::create(['date' => $date, 'emp_id' => $emp->emp_id, 'emp_status_id' => $emp->emp_status_id, 'sign' => 0, 'holiday_id' => null]);
                        }elseif ($emp->emp_status_id == 14) {
                            $arr[] = $emp->emp_id;
                            admin_emp_recup::create(['date' => $date, 'emp_id' => $emp->emp_id, 'emp_status_id' => $emp->emp_status_id, 'sign' => 1, 'holiday_id' => 11]);
                        }elseif ($emp->emp_status_id == 18) {
                            $arr[] = $emp->emp_id;
                            admin_emp_recup::create(['date' => $date, 'emp_id' => $emp->emp_id, 'emp_status_id' => $emp->emp_status_id, 'sign' => 1, 'holiday_id' => 12]);
                            admin_emp_recup::create(['date' => $date, 'emp_id' => $emp->emp_id, 'emp_status_id' => $emp->emp_status_id, 'sign' => 1, 'holiday_id' => 12]);
                        }

                        if ($emp->emp_status_id == 16) {
                            Emp_dj::create(['date' => $date, 'emp_id' => $emp->emp_id, 'emp_status_id' => $emp->emp_status_id, 'sign' => 0]);
                        }
                    }
                    if (!$holiday_admin && $holiday_id) {
                        admin_empInHoliday::create(['date' => $date, 'emps' => $arr, 'holiday_id' => $holiday_id]);
                    }
                } else {
                    $validate_admin->validation = 1;
                    $validate_admin->save();
                }

                $validate_maint = maint_validate_pointage::where('date', $date)->first();
                if (!$validate_maint) {
                    maint_validate_pointage::create(['date' => $date, 'validation' => 1]);

                    $emps = maint_pointage::where('date', $date)->get();
                    $arr = [];
                    foreach ($emps as $emp) {
                        if ($holiday_id && ($emp->emp_status_id == 1 || $emp->emp_status_id == 2)) {
                            $arr[] = $emp->emp_id;
                            maint_emp_recup::create(['date' => $date, 'emp_id' => $emp->emp_id, 'emp_status_id' => $emp->emp_status_id, 'sign' => 1, 'holiday_id' => $holiday_id]);
                        } elseif ($emp->emp_status_id == 7 || $emp->emp_status_id == 11) {
                            maint_emp_recup::create(['date' => $date, 'emp_id' => $emp->emp_id, 'emp_status_id' => $emp->emp_status_id, 'sign' => 0, 'holiday_id' => null]);
                        }
                    }
                    if (!$holiday_maint && $holiday_id) {
                        maint_empInHoliday::create(['date' => $date, 'emps' => $arr, 'holiday_id' => $holiday_id]);
                    }
                } else {
                    $validate_maint->validation = 1;
                    $validate_maint->save();
                }
            }
            return view('pages.pointage_admin', ['today' => $date, 'holidays' => $holidays, 'holiday_id' => $holiday_id, 'receveurs' => [], 'chauffeurs' => [], 'chefs' => [], 'controleurs' => $ctrls, 'status' => $status, 'edited' => $edited]);
        }
        $receveurs = User::where('is_', 10)->whereIn('service', [1, 3])->get();
        $chauffeurs = User::where('is_', 10)->where('service', 4)->get();

        if (isset($_COOKIE['date'])) {
            $date = $_COOKIE['date'];
        } else {
            $date = date('Y-m-d');
        }
        if (isset($_POST['rec'])) {
            $date = $request->date;
            $validate = admin_Validate_pointage::where('date', $date)->where('validation', 1)->first();
            if ($validate) {
                return view('pages.pointage_admin', ['today' => $date, 'holidays' => $holidays, 'receveurs' => $receveurs, 'chauffeurs' => $chauffeurs, 'controleurs' => [], 'status' => $status, 'edited' => 0])->with(['error' => 'Deja validée par le chef service.']);
            }
            foreach ($receveurs as $key => $value) {
                $row = admin_pointage::where('date', $date)->where('emp_id', $value->id)->first();
                if (!$row) {
                    admin_pointage::create(['emp_id' => $value->id, 'date' => $date, 'emp_status_id' => $request['rec' . $value->id]]);
                } else {
                    $row->emp_status_id = $request['rec' . $value->id];
                    $row->save();
                }
                // Pointage::create(['emp_id'=> $value->id, 'date'=> $date, 'emp_status_id'=> $request->rec.$value->id]);
            }
            $edited = 1;
        } elseif (isset($_POST['ch'])) {
            $date = $request->date;
            $validate = maint_Validate_pointage::where('date', $date)->where('validation', 1)->first();
            if ($validate) {
                return view('pages.pointage_admin', ['today' => $date, 'holidays' => $holidays, 'receveurs' => $receveurs, 'chauffeurs' => $chauffeurs, 'controleurs' => [], 'status' => $status, 'edited' => 0])->with(['error' => 'Deja validée par le chef service.']);
            }
            foreach ($chauffeurs as $key => $value) {
                $row = maint_Pointage::where('date', $date)->where('emp_id', $value->id)->first();
                if (!$row) {
                    maint_Pointage::create(['emp_id' => $value->id, 'date' => $date, 'emp_status_id' => $request['ch' . $value->id]]);
                } else {
                    $row->emp_status_id = $request['ch' . $value->id];
                    $row->save();
                }
                // Pointage::create(['emp_id'=> $value->id, 'date'=> $date, 'emp_status_id'=> $request->ch.$value->id]);
            }
            $edited = 1;
        }
        return view('pages.pointage_admin', ['today' => $date, 'holidays' => $holidays, 'receveurs' => $receveurs, 'chauffeurs' => $chauffeurs, 'controleurs' => [], 'status' => $status, 'edited' => $edited]);
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

    public function ExportExcel_adm($etat_receveur, $etat_chauffeur, $d, $d2, $m, $y)
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

            $spreadSheet = $reader->load('assets/word/Pointage_adm.xlsx');
            $spreadSheet->setActiveSheetIndex(0);

            $spreadSheet->getActiveSheet()->fromArray(['ADMINISTRATION - ' . $month[$m] . ' ' . $y], null, 'I1');
            $spreadSheet->getActiveSheet()->fromArray($etat_receveur, null, 'B7');
            $spreadSheet->setActiveSheetIndex(1);

            $spreadSheet->getActiveSheet()->fromArray(['MAINTENANCE - ' . $month[$m] . ' ' . $y], null, 'I1');
            $spreadSheet->getActiveSheet()->fromArray($etat_chauffeur, null, 'B7');

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            header('Content-Disposition: attachment;filename="pointage_adm ' . $d . '-' . $d2 . ' ' . $month[$m] . ' ' . $y . '.xlsx"');

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

            $spreadSheet->getActiveSheet()->fromArray(['Avance - ' . $month[(int) $m - 1] . ' ' . $y], null, 'D2');
            $spreadSheet->getActiveSheet()->fromArray($etat_avance, null, 'C8');

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

            header('Content-Disposition: attachment;filename="Avance-' . $month[(int) $m - 1] . '-' . $y . '.xlsx"');

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
        $interval = new DateInterval('P1D');

        $period = new DatePeriod($start_date, $interval, $end_date);
        if (auth()->user()->is_ == 6) {

            foreach ($period as $value) {
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
                case 3:
                case 4:
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

    public function exportData_admin(Request $request)
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
        $interval = new DateInterval('P1D');

        $period = new DatePeriod($start_date, $interval, $end_date);
        // if(auth()->user()->is_ == 6){
        // $holidays = Holiday::get();

        // foreach ($period as  $value) {
        //     $date = $value->format('Y-m-d');
        //     $admin_validate_pointage = admin_validate_pointage::where('date', $date)->where('validation', 1)->first();
        //     $maint_validate_pointage = maint_validate_pointage::where('date', $date)->where('validation', 1)->first();
        //     if (!$admin_validate_pointage or !$maint_validate_pointage) {
        //         return view('pages.pointage_admin', ['error' => 'Validation du pointage du ' . $date . ' n\'a pas été effectuée.', 'today' => $date, 'holidays' => $holidays, 'holiday_id' => 0, 'receveurs' => [], 'chauffeurs' => [], 'chefs' => [], 'controleurs' => []]);
        //     }
        // }
        // }

        //  $period = new DatePeriod($current_month_first_day, $interval, $current_month_last_day - 1);
        $date = date('Y-m-d');
        $c_transformedData = [];
        $r_transformedData = [];

        $users_adm = User::whereIn('service', [1, 3, 4])->get();
        foreach ($users_adm as $user) {
            $attendanceData = [];
            foreach ($period as $value) {
                if ($value->format("Y-m-d") <= $date) {
                    // Retrieve the attendance status for the user on the current date
                    if ($user->service == 1 or $user->service == 3) {
                        $attendance = admin_pointage::where('emp_id', $user->id)
                            ->whereDate('date', $value->format("Y-m-d"))
                            ->join('emp_statuses', 'emp_statuses.id', '=', 'admin_pointages.emp_status_id')
                            ->first();
                    }
                    if ($user->service == 4) {
                        $attendance = maint_pointage::where('emp_id', $user->id)
                            ->whereDate('date', $value->format("Y-m-d"))
                            ->join('emp_statuses', 'emp_statuses.id', '=', 'maint_pointages.emp_status_id')
                            ->first();
                    }

                    // Determine the attendance status (default to 'absent' if no record found)
                    $status = $attendance ? $attendance->name : '';

                    // Store the attendance status for the user
                    $attendanceData[$value->format("Y-m-d")] = $status;
                }
            }
            // Add the attendance data for the current date to the transformed data array
            switch ($user->service) {
                case 1:
                case 3:
                    $r_transformedData[$user->username] = $attendanceData;
                    break;
                case 4:
                    $c_transformedData[$user->username] = $attendanceData;
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
        foreach ($c_transformedData as $user => $attendance) {
            // Initialize a row array for the current user
            $rowData = [$user];

            // Append attendance statuses to the row array
            foreach ($attendance as $status) {
                $rowData[] = $status;
            }

            // Add the row data to the matrix
            $ch[] = $rowData;
        }

        return $this->ExportExcel_adm($rec, $ch, $from, $to, $month, $year);
    }

    public function import_paie(Request $request)
    {
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
                'Num' => $key + 1,
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
