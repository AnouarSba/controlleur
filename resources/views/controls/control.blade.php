<link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
@if (isset($error) && $error != null)
    <div class="alert alert-warning">
        {{ $error }}
    </div>
@endif
@if (isset($success) && $success != null)
    <div class="alert alert-success">
        {{ $success }}
    </div>
@endif
@if (in_array(Illuminate\Support\Facades\Auth::user()->is_, [1,  6]))
    <div class="col-md-12">
        <div class="row justify-content-center">
            <div class="col-md-12 py-2">

                @if (Illuminate\Support\Facades\Auth::user()->is_ == 6)

                    <div class="card" style="background-color: rgb(120, 144, 230)">
                        <div class="card-header">
                            <h3>{{ __('Attestations de travail') }}</h3>
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('show_attestations') }}">
                                @csrf
                                <div class="form-row align-items-center">


                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">De</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                            value="{{ now()->setTimezone('T')->format('Y-m-d') }}">
                                        @error('start_date')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">A</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date"
                                            value="{{ now()->setTimezone('T')->format('Y-m-d') }}">
                                        @error('end_date')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-2"> Envoyer</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row justify-content-center">
                            <div class="col-md-12 py-2">

                                <div class="card" style="background-color: rgb(120, 144, 230)">
                                    <div class="card-header">
                                        <h3>{{ __('Pointage') }}</h3>
                                    </div>

                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <form method="POST" id="form" action="{{ route('pointage') }}">
                                            @csrf
                                            <div class="form-row align-items-center">


                                                <div class="col-auto">
                                                    <label for="exampleFormControlInput1">De</label>
                                                    <input type="date" class="form-control" id="start_date"
                                                        name="start_date"
                                                        value="{{ now()->setTimezone('T')->format('Y-m-d') }}">
                                                    @error('start_date')
                                                        <span class="text-danger error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-auto">
                                                    <label for="exampleFormControlInput1">A</label>
                                                    <input type="date" class="form-control" id="end_date"
                                                        name="end_date"
                                                        value="{{ now()->setTimezone('T')->format('Y-m-d') }}">
                                                    @error('end_date')
                                                        <span class="text-danger error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <input type="hidden" name="month" id="month">
                                                <input type="hidden" name="day" id="day">
                                                <input type="hidden" name="day2" id="day2">
                                                <input type="hidden" name="year" id="year">

                                                <div class="col-auto">
                                                    <label for="exampleFormControlInput1">&nbsp; </label>
                                                    <br>
                                                    <button type="button" onclick="check()"
                                                        class="btn btn-primary mb-2"> Envoyer</button>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12" style="display: contents;">
                                {{-- <a href="/"> <button type="button" class="btn btn-primary mb-2">
                                    Retour</button></a> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row justify-content-center">
                            <div class="col-md-12 py-2">

                                <div class="card" style="background-color: rgb(120, 144, 230)">
                                    <div class="card-header">
                                        <h3>{{ __('Paie') }}</h3>
                                    </div>

                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <form method="POST" id="form" action="{{ route('import_paie') }}"  enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-row align-items-center">

                                                
                                                <div class="form-group">
                                                    <label for="fileInput">Choose an file:</label>
                                                    <input type="file" accept="file/*" id="fileInput" name="file">
                                                </div>
                                    
                                                <button type="submit" class="btn btn-primary mb-2">Upload</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12" style="display: contents;">
                                {{-- <a href="/"> <button type="button" class="btn btn-primary mb-2">
                                    Retour</button></a> --}}
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card" style="background-color: rgb(120, 144, 230)">
                        <div class="card-header">
                            <h3>{{ __('تقرير المراقبة') }}</h3>
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('location2') }}">
                                @csrf
                                <div class="form-row align-items-center">

                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">id conrolleur </label>
                                        <select class="form-control" id="country-select" name="type_id">
                                            <option value="0">اختر المراقب</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                                            @endforeach
                                        </select>
                                        @error('type_id')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">Date De Debut</label>
                                        <input type="datetime-local" class="form-control" id="game-date-time-text"
                                            name="sttart_date"
                                            value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                        @error('start_date')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">Date de Fin</label>
                                        <input type="datetime-local" class="form-control" id="game-date-time-text"
                                            name="endd_date"
                                            value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                        @error('end_date')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-2"> Envoyer</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="card" style="background-color: rgb(120, 144, 230)">
                        <div class="card-header">
                            <h3>{{ __('أماكن المراقبة') }}</h3>
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('location') }}">
                                @csrf
                                <div class="form-row align-items-center">

                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">id conrolleur </label>
                                        <select class="form-control" id="country-select" required name="type_id">
                                            <option value="">اختر المراقب</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                                            @endforeach
                                        </select>
                                        @error('type_id')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">Date De Debut</label>
                                        <input type="datetime-local" class="form-control" id="game-date-time-text"
                                            name="sttart_date"
                                            value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                        @error('start_date')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">Date de Fin</label>
                                        <input type="datetime-local" class="form-control" id="game-date-time-text"
                                            name="endd_date"
                                            value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                        @error('end_date')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-2"> Envoyer</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                    <div class="card" style="background-color: rgb(120, 144, 230)">
                        <div class="card-header">
                            <h3>{{ __('معالجة المخالفات') }}</h3>
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('Infra_list') }}">
                                @csrf
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">type d'employer</label>
                                        <select name="type" class="form-control" required
                                            aria-label="Default select example">
                                            <option value="">--Selectioner le Type--</option>
                                            <option value="App\Models\Kabid">Receveur</option>
                                            <option value="App\Models\Control">Chauffeur</option>
                                        </select>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">id conrolleur </label>
                                        <input type="number" min="2" class="form-control"
                                            id="exampleFormControlInput1" name="type_id">
                                        @error('type_id')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">Date De Debut</label>
                                        <input type="datetime-local" class="form-control" id="game-date-time-text"
                                            name="sttart_date"
                                            value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                        @error('start_date')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">Date de Fin</label>
                                        <input type="datetime-local" class="form-control" id="game-date-time-text"
                                            name="endd_date"
                                            value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                        @error('end_date')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-2"> Envoyer</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="card" style="background-color: rgb(120, 144, 230)">
                        <div class="card-header">
                            <h3>{{ __('معالجة التبليغات') }}</h3>
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('Alert_list') }}">
                                @csrf
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">id conrolleur </label>
                                        <input type="number" min="2" class="form-control"
                                            id="exampleFormControlInput1" name="type_id">
                                        @error('type_id')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">Date De Debut</label>
                                        <input type="datetime-local" class="form-control" id="game-date-time-text"
                                            name="sttart_date"
                                            value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                        @error('start_date')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">Date de Fin</label>
                                        <input type="datetime-local" class="form-control" id="game-date-time-text"
                                            name="endd_date"
                                            value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                        @error('end_date')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-2"> Envoyer</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>





                    <div class="card" style="background-color: rgb(120, 144, 230)">
                        <div class="card-header">
                            <h3>{{ __('مراقبة الصندوق') }}</h3>
                        </div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('Coffre_list') }}">
                                @csrf
                                <div class="form-row align-items-center">
                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">id conrolleur </label>
                                        <input type="number" min="2" class="form-control"
                                            id="exampleFormControlInput1" name="type_id">
                                        @error('type_id')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">Date De Debut</label>
                                        <input type="datetime-local" class="form-control" id="game-date-time-text"
                                            name="sttart_date"
                                            value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                        @error('start_date')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-auto">
                                        <label for="exampleFormControlInput1">Date de Fin</label>
                                        <input type="datetime-local" class="form-control" id="game-date-time-text"
                                            name="endd_date"
                                            value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                        @error('end_date')
                                            <span class="text-danger error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-primary mb-2"> Envoyer</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                @endif
                @if (Illuminate\Support\Facades\Auth::user()->is_ == 1 && Illuminate\Support\Facades\Auth::user()->id != 1)
                    <div class="col-md-12">
                        <div class="row justify-content-center">
                            <div class="col-md-12 py-2">

                                <div class="card" style="background-color: rgb(120, 144, 230)">
                                    <div class="card-header">
                                        <h3>{{ __('Pointage') }}</h3>
                                    </div>

                                    <div class="card-body">
                                        @if (session('status'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('status') }}
                                            </div>
                                        @endif
                                        <form method="POST" id="form" action="{{ route('pointage') }}">
                                            @csrf
                                            <div class="form-row align-items-center">


                                                <div class="col-auto">
                                                    <label for="exampleFormControlInput1">De</label>
                                                    <input type="date" class="form-control" id="start_date"
                                                        name="start_date"
                                                        value="{{ now()->setTimezone('T')->format('Y-m-d') }}">
                                                    @error('start_date')
                                                        <span class="text-danger error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-auto">
                                                    <label for="exampleFormControlInput1">A</label>
                                                    <input type="date" class="form-control" id="end_date"
                                                        name="end_date"
                                                        value="{{ now()->setTimezone('T')->format('Y-m-d') }}">
                                                    @error('end_date')
                                                        <span class="text-danger error">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <input type="hidden" name="month" id="month">
                                                <input type="hidden" name="day" id="day">
                                                <input type="hidden" name="day2" id="day2">
                                                <input type="hidden" name="year" id="year">

                                                <div class="col-auto">
                                                    <label for="exampleFormControlInput1">&nbsp; </label>
                                                    <br>
                                                    <button type="button" onclick="check()"
                                                        class="btn btn-primary mb-2"> Envoyer</button>
                                                </div>

                                            </div>
                                        </form>
                                        <a class="nav-link {{ str_contains(request()->url(), 'Pointage') == true ? 'active' : '' }}"
                                            href="{{ route('do_pointage') }}">
                                            <button class="btn btn-default">Pointage Chef Station</button>

                                        </a>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12" style="display: contents;">
                                {{-- <a href="/"> <button type="button" class="btn btn-primary mb-2">
                                        Retour</button></a> --}}
                            </div>
                        </div>
                    </div>
                @endif
@endif
@if (in_array(Illuminate\Support\Facades\Auth::user()->is_, [1, 3, 5]))

    <div class="card" style="background-color: rgb(120, 144, 230)">
        <div class="card-header">
            <h3>{{ __('تقرير توقف الحافلات') }}</h3>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('panne') }}">
                @csrf
                <div class="form-row align-items-center">

                    <div class="col-auto">
                        <label for="exampleFormControlInput1">Date De Debut</label>
                        <input type="datetime-local" class="form-control" id="game-date-time-text"
                            name="sttart_date" value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                        @error('start_date')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-auto">
                        <label for="exampleFormControlInput1">Date de Fin</label>
                        <input type="datetime-local" class="form-control" id="game-date-time-text" name="endd_date"
                            value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                        @error('end_date')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-2"> Envoyer</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="card" style="background-color: rgb(120, 144, 230)">
        <div class="card-header">
            <h3>{{ __('تقرير حركة الحافلات') }}</h3>
        </div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('move') }}">
                @csrf
                <div class="form-row align-items-center">

                    <div class="col-auto">
                        <label for="exampleFormControlInput1">Date De Debut</label>
                        <input type="datetime-local" class="form-control" id="game-date-time-text"
                            name="sttart_date" value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                        @error('start_date')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-auto">
                        <label for="exampleFormControlInput1">Date de Fin</label>
                        <input type="datetime-local" class="form-control" id="game-date-time-text" name="endd_date"
                            value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                        @error('end_date')
                            <span class="text-danger error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-2"> Envoyer</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endif
</div>
<div class="col-12" style="display: contents;">
    <a href="/"> <button type="button" class="btn btn-primary mb-2"> Retour</button></a>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    function check() {
        const d = new Date($('#start_date').val());
        const d2 = new Date($('#end_date').val());
        let month = d.getMonth();
        let month2 = d2.getMonth();
        let year = d.getFullYear();
        let year2 = d2.getFullYear();
        let day = d.getDate();
        let day2 = d2.getDate();
        if (month == month2 && year == year2) {
            $('#month').val(month);
            $('#day').val(day);
            $('#day2').val(day2);
            $('#year').val(year);
            $('#form').submit();
        } else {
            alert('يرجى تحديد تواريخ من نفس الشهر')
        }
    }
</script>
