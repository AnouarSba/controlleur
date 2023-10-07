<link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">

<div class="col-md-12">
    <div class="row justify-content-center">
        <div class="col-md-12 py-2">
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
                                <label for="exampleFormControlInput1">Date De Debut</label>
                                <input type="datetime-local" class="form-control" id="game-date-time-text"
                                    name="sttart_date" value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                @error('start_date') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-auto">
                                <label for="exampleFormControlInput1">Date de Fin</label>
                                <input type="datetime-local" class="form-control" id="game-date-time-text"
                                    name="endd_date" value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                @error('end_date') <span class="text-danger error">{{ $message }}</span>@enderror
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
                                    <option value="{{$user->id}}">{{$user->username}}</option>
                                    @endforeach
                                </select>
                                @error('type_id') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-auto">
                                <label for="exampleFormControlInput1">Date De Debut</label>
                                <input type="datetime-local" class="form-control" id="game-date-time-text"
                                    name="sttart_date" value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                @error('start_date') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-auto">
                                <label for="exampleFormControlInput1">Date de Fin</label>
                                <input type="datetime-local" class="form-control" id="game-date-time-text"
                                    name="endd_date" value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                @error('end_date') <span class="text-danger error">{{ $message }}</span>@enderror
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
                                <select name="type" class="form-control" required aria-label="Default select example">
                                    <option value="">--Selectioner le Type--</option>
                                    <option value="App\Models\Kabid">Receveur</option>
                                    <option value="App\Models\Control">Chauffeur</option>
                                </select>
                                @error('type') <span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-auto">
                                <label for="exampleFormControlInput1">id conrolleur </label>
                                <input type="number" min="2" class="form-control" id="exampleFormControlInput1"
                                    name="type_id">
                                @error('type_id') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-auto">
                                <label for="exampleFormControlInput1">Date De Debut</label>
                                <input type="datetime-local" class="form-control" id="game-date-time-text"
                                    name="sttart_date" value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                @error('start_date') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-auto">
                                <label for="exampleFormControlInput1">Date de Fin</label>
                                <input type="datetime-local" class="form-control" id="game-date-time-text"
                                    name="endd_date" value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                @error('end_date') <span class="text-danger error">{{ $message }}</span>@enderror
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
                                <input type="number" min="2" class="form-control" id="exampleFormControlInput1"
                                    name="type_id">
                                @error('type_id') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-auto">
                                <label for="exampleFormControlInput1">Date De Debut</label>
                                <input type="datetime-local" class="form-control" id="game-date-time-text"
                                    name="sttart_date" value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                @error('start_date') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-auto">
                                <label for="exampleFormControlInput1">Date de Fin</label>
                                <input type="datetime-local" class="form-control" id="game-date-time-text"
                                    name="endd_date" value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                @error('end_date') <span class="text-danger error">{{ $message }}</span>@enderror
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
                                <input type="number" min="2" class="form-control" id="exampleFormControlInput1"
                                    name="type_id">
                                @error('type_id') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>
                            <div class="col-auto">
                                <label for="exampleFormControlInput1">Date De Debut</label>
                                <input type="datetime-local" class="form-control" id="game-date-time-text"
                                    name="sttart_date" value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                @error('start_date') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-auto">
                                <label for="exampleFormControlInput1">Date de Fin</label>
                                <input type="datetime-local" class="form-control" id="game-date-time-text"
                                    name="endd_date" value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                @error('end_date') <span class="text-danger error">{{ $message }}</span>@enderror
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
                                @error('start_date') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-auto">
                                <label for="exampleFormControlInput1">Date de Fin</label>
                                <input type="datetime-local" class="form-control" id="game-date-time-text"
                                    name="endd_date" value="{{ now()->setTimezone('T')->format('Y-m-d H:m') }}">
                                @error('end_date') <span class="text-danger error">{{ $message }}</span>@enderror
                            </div>

                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2"> Envoyer</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <div class="col-12" style="display: contents;">
            <a href="/"> <button type="button" class="btn btn-primary mb-2"> Retour</button></a>
        </div>
    </div>
</div>