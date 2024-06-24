@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
<style>
.news-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-content: space-between;
}

.ribbon {
    position: absolute;
    right: 0;
    top: 0px;
    z-index: 1;
    overflow: hidden;
    width: 100px;
    height: 100px;
    text-align: right;
}

/* card with ribbon */
.ribbon span {
    text-transform: uppercase;
    text-align: center;
    line-height: 25px;
    transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
    width: 115px;
    display: block;
    background: #f5431a;
    box-shadow: 0 0 10px 3px #ff6e4e;
    position: absolute;
    top: 20px;
    right: -25px;
    color: white;
}

.disabled {
    display: none;
}

.article-container {
    text-decoration: none;
    color: black;
    display: flex;
    flex-direction: column;
    width: 28vw;
    /* Increase this value if you want more articles per row, decrease if you want less*/
    min-width: 150px;
    max-width: 700px;
    box-shadow: 2px 2px 25px 2px rgba(0, 0, 0, 0.9);
    margin: 20px;
    transition: 0.3s;
    font-size: 14px;
    font-family: 'Lora', serif;
}

@media only screen and (max-width: 850px) {
    .article-container {
        width: 90vw;
    }
}

.article-container:hover {
    transform: scale(1.02);
    box-shadow: 2px 2px 25px 2px rgba(139, 139, 139, 0.89);

}

.article-image {
    width: 100%;
    max-height: 100%;
    height: 220px
}

.article-title {
    padding: 10px;
}
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'الرئيسية'])
<div class="container-fluid py-4">
    
    @if(session('date_error'))
        <script>
            alert('{{ session('date_error') }}');
        </script>
    @endif
    <div class="row">
        @if(Illuminate\Support\Facades\Auth::user()->is_==9)
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Nombre de demmandeurs/mois</p>
                                <h5 class="font-weight-bolder">
                                    {{$all_d}}
                                </h5>
                                @if (date('d') >10 && date('d') <15)
                                    <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">{{$today_d}}</span>
                                    Aujourd'hui
                                </p>
                                @endif
                                
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif(in_array(Illuminate\Support\Facades\Auth::user()->is_,[2,3,4,7,8,10]))
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Récupérations</p>
                                <h5 class="font-weight-bolder">
                                    {{$all_recup}}
                                </h5>
                                @if ($today_recup)
                                <p class="mb-0">
                                   <span class="text-success text-sm font-weight-bolder">Récupération Aujourd'hui </span>
                                </p>
                                @else
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">&nbsp; </span>
                                 </p>
                                    
                                @endif
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Repos de journée</p>
                                <h5 class="font-weight-bolder">
                                    {{$all_rj}}
                                </h5>
                                @if ($today_rj)
                                <p class="mb-0">
                                   <span class="text-success text-sm font-weight-bolder">Repos Aujourd'hui </span>
                                </p>
                                @else
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">&nbsp; </span>
                                 </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                @php
            $months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"];
                                    
                                @endphp
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Salaire du mois "{{$months[$month -1]}}" </p>
                                <h5 class="font-weight-bolder">
                                    {{$salaire}} DA
                                </h5>
                                
                                {{-- @if ($salaire_p) --}}
                                <p class="mb-0">
                                   <span class="text-danger text-sm font-weight-bolder">{{ ($montant)? 'Avance Salaire : '.$montant. ' DA' : ''}} &nbsp;</span>
                                </p>
                                {{-- @else
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">&nbsp; </span>
                                 </p>
                                @endif --}}
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif(Illuminate\Support\Facades\Auth::user()->is_==5)
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Pannes</p>
                                <h5 class="font-weight-bolder">
                                    {{$all_p}}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">{{$today_p}}</span>
                                    Aujourd'hui
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif(Illuminate\Support\Facades\Auth::user()->is_==6)
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Demmande Attestation / réglée</p>
                                <h5 class="font-weight-bolder">
                                    {{$all_dmnd .' / '.$all_dmnd_reg}}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">{{$today_dmnd}}</span>
                                    Aujourd'hui
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        @elseif(in_array(Illuminate\Support\Facades\Auth::user()->is_ , [12, 13, 14]))
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Cartes vendue</p>
                                <h5 class="font-weight-bolder">
                                    0
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">0</span>
                                    Aujourd'hui
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Flexy</p>
                                <h5 class="font-weight-bolder">
                                    0.00 DA
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">0 DA </span>
                                    Aujourd'hui
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif(Illuminate\Support\Facades\Auth::user()->is_ == 1)
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">عدد المخالفات</p>
                                <h5 class="font-weight-bolder">
                                    {{$all_i}}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">{{$today_i}}</span>
                                    Aujourd'hui
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-single-copy-04 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">عدد التبليغات</p>
                                <h5 class="font-weight-bolder">
                                    {{$all_a}}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">{{$today_a}}</span>
                                    Aujourd'hui
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-single-copy-04 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">عدد حسابات الصندوق</p>
                                <h5 class="font-weight-bolder">
                                    {{$all_c}} <span style="    color: red;
    font-size: 14px;">( {{$all_ci}} مخالفات )</span>
                                </h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">{{$today_c}}</span>&nbsp;<span style="    color: red;
    font-size: 14px;">( {{$today_ci}}  )</span>
                                    Aujourd'hui
                                </p>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-single-copy-04 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @endif
        @if(isset($ctrl_b))
        <script>
        alert('انت تراقب الحافلة {{$buses[$ctrl_b-1]->name}}')
        </script>
        @endif
        <!--
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">New Clients</p>
                                    <h5 class="font-weight-bolder">
                                        +3,462
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-danger text-sm font-weight-bolder">-2%</span>
                                        since last quarter
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Sales</p>
                                    <h5 class="font-weight-bolder">
                                        $103,430
                                    </h5>
                                    <p class="mb-0">
                                        <span class="text-success text-sm font-weight-bolder">+5%</span> than last month
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
    </div>
    <!--
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Sales overview</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">4% more</span> in 2021
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card card-carousel overflow-hidden h-100 p-0">
                    <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                        <div class="carousel-inner border-radius-lg h-100">
                            <div class="carousel-item h-100 active" style="background-image: url('./img/carousel-1.jpg');
            background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-camera-compact text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Get started with Argon</h5>
                                    <p>There’s nothing I really wanted to do in life that I wasn’t able to get good at.</p>
                                </div>
                            </div>
                            <div class="carousel-item h-100" style="background-image: url('./img/carousel-2.jpg');
            background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-bulb-61 text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Faster way to create web pages</h5>
                                    <p>That’s my skill. I’m not really specifically talented at anything except for the
                                        ability to learn.</p>
                                </div>
                            </div>
                            <div class="carousel-item h-100" style="background-image: url('./img/carousel-3.jpg');
            background-size: cover;">
                                <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">
                                    <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                        <i class="ni ni-trophy text-dark opacity-10"></i>
                                    </div>
                                    <h5 class="text-white mb-1">Share with us your design tips!</h5>
                                    <p>Don’t be afraid to be wrong because you can’t learn anything from a compliment.</p>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next w-5 me-3" type="button"
                            data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Sales by Country</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center ">
                            <tbody>
                                <tr>
                                    <td class="w-30">
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div>
                                                <img src="./img/icons/flags/US.png" alt="Country flag">
                                            </div>
                                            <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">Country:</p>
                                                <h6 class="text-sm mb-0">United States</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                            <h6 class="text-sm mb-0">2500</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Value:</p>
                                            <h6 class="text-sm mb-0">$230,900</h6>
                                        </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <div class="col text-center">
                                            <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                            <h6 class="text-sm mb-0">29.9%</h6>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-30">
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div>
                                                <img src="./img/icons/flags/DE.png" alt="Country flag">
                                            </div>
                                            <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">Country:</p>
                                                <h6 class="text-sm mb-0">Germany</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                            <h6 class="text-sm mb-0">3.900</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Value:</p>
                                            <h6 class="text-sm mb-0">$440,000</h6>
                                        </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <div class="col text-center">
                                            <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                            <h6 class="text-sm mb-0">40.22%</h6>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-30">
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div>
                                                <img src="./img/icons/flags/GB.png" alt="Country flag">
                                            </div>
                                            <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">Country:</p>
                                                <h6 class="text-sm mb-0">Great Britain</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                            <h6 class="text-sm mb-0">1.400</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Value:</p>
                                            <h6 class="text-sm mb-0">$190,700</h6>
                                        </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <div class="col text-center">
                                            <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                            <h6 class="text-sm mb-0">23.44%</h6>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-30">
                                        <div class="d-flex px-2 py-1 align-items-center">
                                            <div>
                                                <img src="./img/icons/flags/BR.png" alt="Country flag">
                                            </div>
                                            <div class="ms-4">
                                                <p class="text-xs font-weight-bold mb-0">Country:</p>
                                                <h6 class="text-sm mb-0">Brasil</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Sales:</p>
                                            <h6 class="text-sm mb-0">562</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">Value:</p>
                                            <h6 class="text-sm mb-0">$143,960</h6>
                                        </div>
                                    </td>
                                    <td class="align-middle text-sm">
                                        <div class="col text-center">
                                            <p class="text-xs font-weight-bold mb-0">Bounce:</p>
                                            <h6 class="text-sm mb-0">32.14%</h6>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Categories</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-mobile-button text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Devices</h6>
                                        <span class="text-xs">250 in stock, <span class="font-weight-bold">346+
                                                sold</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-tag text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Tickets</h6>
                                        <span class="text-xs">123 closed, <span class="font-weight-bold">15
                                                open</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-box-2 text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Error logs</h6>
                                        <span class="text-xs">1 is active, <span class="font-weight-bold">40
                                                closed</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                            </li>
                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                        <i class="ni ni-satisfied text-white opacity-10"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Happy users</h6>
                                        <span class="text-xs font-weight-bold">+ 430</span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->
    <!--Copy this into your website or website generator, in the HTML section.-->
    @if(Illuminate\Support\Facades\Auth::user()->is_ == 2 )
    <form action="{{ route('pos') }}" id="myform1" style="margin-left:10px; margin-top:10px;
    z-index: 99;
    position: relative;
    font-size: 25px;">

        <select class="" id="country-select" style="width:150px" required name="ligne">
            <option value="">اختر الخط</option>
            @foreach (App\Models\Ligne::get() as $ligne)
            <option value="{{$ligne->id}}">{{$ligne->name}}</option>
            @endforeach
        </select>
        <select class="" id="country-select" style="width:150px" required name="bus">
            <option value="">اختر الحافلة</option>
            @foreach (App\Models\Bus::get() as $bus)
            <option value="{{$bus->id}}">{{$bus->name}}</option>
            @endforeach
        </select>
        <select class="" id="country-select" style="width:150px" required name="kabid">
            <option value="">اختر القابض</option>
            @foreach (App\Models\Kabid::get() as $kabid)
            <option value="{{$kabid->id}}">{{$kabid->name}}</option>
            @endforeach
        </select>
        <select class="" id="country-select" style="width:150px" required name="chauff">
            <option value="">اختر السائق</option>
            @foreach (App\Models\Chauffeur::get() as $Chauffeur)
            <option value="{{$Chauffeur->id}}">{{$Chauffeur->name}}</option>
            @endforeach
        </select>
        <input type="text" required placeholder="الرقم التسلسلي" name="num" id="num">

        <textarea name="place" required placeholder="المكان" id="place" cols="25" rows="1"></textarea>

        <input type="hidden" name="lang" id="lang">
        <input type="hidden" name="lat" id="lat">
        <button class="bg-gradient-secondary" style="text-align: center; color:white;
margin-right: 0%;
" onclick="getLocation();" type="button">مراقبة</button>
    </form>
    @endif
@php
$p = Illuminate\Support\Facades\Auth::user()->is_;
@endphp
    <div id='imageGalleryWithTitle' class="news-container" style="position: relative"></div>
    <button type="button" class="btn btn-primary btn-sm" id="btnn" hidden data-toggle="modal"
        data-target="#exampleModal3">
        تقرير
    </button>
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تقرير توقف الحافلات</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('panne')}}" method="post">
                        @csrf

                        <input type="hidden" name="infra" id="infra_q2">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">من</label>
                            <input type="datetime-local" required name="sttart_date" id="sttart_date">
                            <br>
                            <label for="message-text" style="position:absolute" class="col-form-label">الى</label>
                            <input type="datetime-local" required name="endd_date" id="endd_date">

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <input type="submit" class="btn btn-primary" value="تاكيد">
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
</div>

@endsection

@push('js')
<script>
// Add, remove, modify your articles here
document.addEventListener("DOMContentLoaded", function() {
    var articles = [{
            class: 'Ribbon',
            onClickLink: '{{route("panne")}}',
            imgageSource: 'https://static.vecteezy.com/ti/vecteur-libre/p3/8874518-fast-time-logo-stop-clock-speed-concept-fast-delivery-services-express-et-urgents-delai-et-retard-vectoriel.jpg',
            title: 'تقرير توقف الحافلات'
        },
        {
            class: 'disabled',
            onClickLink: '{{route("int")}}',
            imgageSource: 'https://blog.emploitic.com/wp-content/uploads/2023/02/reglement-interieur-1000x500-1.png',
            title: 'النظام الداخلي'
        },
        {
            class: 'disabled',
            onClickLink: '{{route("inst")}}',
            imgageSource: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4ypHZCDAquTsVoFoTgS51QypyVIo4fBwt9Q&usqp=CAU',
            title: 'التعليمات'
        },
        {
            class: 'disabled',
            onClickLink: '{{route("pub")}}',
            imgageSource: 'https://fa.qu.edu.iq/wp-content/uploads/2018/09/%D8%A7%D8%B9%D9%84%D8%A7%D9%86.jpg',
            title: 'الاعلانات'
        },


        {
            class: 'disabled',
            onClickLink: '{{route("emp")}}',
            imgageSource: 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoHCBIWFRgVEhURGBIYGhUVEhIRERESERgSGBgZGRgUGBgcIS4lHB4rHxgYJjgmKy8xNTU1GiQ7QDs0Py40NTEBDAwMEA8QHhISHDEhGiE0MTQ0NDE0NDQxNDE0NDQ0NDQ0NDQ0NDQ0NDQxNDE0NDQ0MUA0NDQ/Pz8xNDE/NDE/Mf/AABEIAKMBNQMBIgACEQEDEQH/xAAbAAACAgMBAAAAAAAAAAAAAAAEBQMGAAECB//EAD0QAAIBAgMECAQEBAYDAQAAAAECAAMRBAUhEiIxQQYyUWFxgZGhE3KxwSOC0fAzQsLxByQ0YrLhQ1KSFP/EABgBAQEBAQEAAAAAAAAAAAAAAAECAAME/8QAHhEBAQACAwEBAQEAAAAAAAAAAAECESExQQMSYVH/2gAMAwEAAhEDEQA/ALbjF3TBcGdYdmRskW4NxcxTQON6zeBlcyYaP8xljxnFvAyvZGNH+YyvUGYWNOjx338vpF4EOyTrt5fSasf4brGEvBcJxMLaZcB1hK/mSSx1ZX8zEyarGOERV4/xwiGuNYGBGEkRb2nDQrAJeog7WEmqFUcnc62ndTCleU9Cw+BUINOUr2a4MltlFJY6BVFyTHSVYoUGdwqAlmNlVRcknkJ6j0WyL/8AMhaoQargbVtQijggPPXif0nPRjo6uHXbqWauw1PEID/Kvf2mPXPvGQ6aYzTcbzbdkgxL2vKhcPUvpOKVXZaRK/Ewdn4n0ik/GonNoNleI20vrpprCzJU4M4admRtFnDNbjMQ38JywkicJkocRTBVlPAgqfA6febVbcJziXsPzIPVhJLxZw8GqGEOYLWjDQtRovxDcfO0KrtFmKqWEUgcYRfXlwinE1uP78oViqsVYg3kWqgHF1dDN5NiDsE/+rr7KP1geYJUIsug7bzWRAgOhvfRvt9pMamWdD4dZuxwrD01mQvMaPxVpNzClT5GZKL0jO33IowzmN83S6xbSQCRJanKoMVwbwMQ5CN1vmMfY3g3yn6RFkA3W+YyvUm9oVlHXMGtCcrG+Yg+wXEw1oFgOcNaC4FrCJMevGPa0R5gsRVWzCIsQNY+zARFiOMmmAmh2VD8ZPmEF2Y16PYNqmIpovEtx5AAEk+gknx6Yh3BGtDC00F1UA834t5mbw9BUUBeXPme8zVZ9CBx7DLCQmR318IPh63Ll2c1MnJmU1tc4rxeIuxA84Vja4VTEy1hx5878JUFoovpqbCR9bwg6ttGG01k3L/E7HZSdWHcD6f3jJoswGjjvBH79I0MIqIzOSJ2ZyREoXE2vCdTarpFITGpcKP9y38rn7TpmJNhIsyqWNNebOfQKf1EJWwEWchIJiWCqWPAawlWveLc4eyNMxXUxe1w4RZmjnZB5XA9ZxRqkcYTXQPTZe6/nM2iCs0DcQkqdQePCRFJKgVVIv8AifDrAnqkbDefP1jz4N9Iox1Hae3Mm3mTMKseVAMhU/ysSPBgP0mRc7NSOyvCwGvdMjuJ29Hx+KFoAKhJ0kjULg37ZJRpCMiLdhMVwPyn6RLkI3G+Yx7iR1vAxNko3W+Yw9M6MxCss65/fKDCEZabOYtT7A84Y0DwHOGsJK50GrRNjo6rcImxkRVXzISv1xrLFmYlfrDWTTAtpdv8PctZqpr8EQFOHWdhwHgD7iU3ZnqnQZAmEUkjed2Hk2z/AEwnalgqMBAcS8nKE63PnB8R2aXHp4TpBQtZ7bw/N4ds7w2K1Kt4qe7snCUy5KAG59I0w2XIgFwGYcWYc+4cprY0IsRTq1ahRF3V1ubhded52Mhe286g9gUkeptf0li4TVWTaLFZfLaiGwsw7Rp7GSClUXrKR7j2jeq0xak2h+YgytLtfsH1/ZjQwSi6i9gBfjaStVE2jOHZmnmB7mY0ynAWbaaZptpmLccl6tLuDn/gJPUawkGIf8dR2Jf1Y/pMrNrLS7pHdv4mAYsbSsDDm0S0Wl5o1V16NjbsnVIkcIXjEs9+2DVKgXXlNpg2Iwu0bgf3gb4YgkEaiV+r0ncYkttH4OiFb6CxO8B23PpLCru+9fQ8+0Sa0RCnreCZdg9uut/5bufy8Pe0YVEM7ySkS7vyC282IP2hTegWaJvzJ3m435kzktZxQ2fOc0q94vWpuecmw7i8phdQXv8AKYmycbrfMY8FtflMS5Vwb5jD1XhiJmFezzBIkezxTVoyw6RgYuyo6RiZLpOg9aJcedI6qxLjxEVWMwiCvxlix6xBXGsmtBOR5f8AHrJSvYMd4/7QLm3fYG09ew2GVQEQBaaAKigaACeMYXFNTdXTRkYMviDeey4PMab0lrKfw2AOmp2jps2/9r6W7ZoqJKqacTftgVYHjJnru3BAB3tvedhaaDrcA6cL3jMo1xorB0Qq3tvHU9vcJOZsTUxRmafhOjOWmYHXGkGVtIZUgNXSMTW1ec4nEbI2uVwD68ZAryHMbtScL1th9n5rEj3tKgNcPWvreFB5U8hzLbRTfiJYqVSawyil7ZtjI9vQyRpKiuqf8we6mv8AyadHjI2b8d+5UHtf7yQdYCUlmMew9osWS5vV3gJEvKLBMaNbys53irI2ugBJ9JacSmhlH6VqVoE3ABcUgNbsbFmt3AfUQoUg68eJ1PiZaOi2aX/Bc6j+GTzHNPLlKyRNISCCpIYEEEcQRwMlMel1zumNstwuxT1G8283nwHkPvKvkmY/FS7ddeuO/kR3GXQtdQe0A+omOV4VPNuvMnOcdf1mQSZoDsDxk1G95iEbHnJUYXiwlntf5T9IsyZrq3zGHYg8flP0gGR9Q/MZvT4ZwVh+JCrwdBd4haMn6sZtFuVdWMWkuk6QVRFOMEbVYoxh4yoKrOZRBiDrH2YmIK51kVoGYy9/4fVywemSSEb4ijkGK7P6yguZav8AD/FbGJ2DwdSv5hqPv7QXHoOLxKoVDEBWOztHgCeF+z+0WZygVWAazOCqt2MdAfIyfpDQDoVPCxvK9l1cV0FNyfi0dwqTqyDRH15cAfCcrlZdPRjhLjtdcrxW2isdGtZxe9nHEQyVvo/tI7I3MX59YaH2+ksc6y7m3LPH83TTSJ5JfUjznDSkB3EBxAjB1g1amYilet5jwpKZVgSNNb+ekCqk9/nGJVfo+nwnNLauBZlNrbpJsPKxlww1SUepW2MXbmym35WY/wBQlrwFS9oy8NT0HdMlJg5OgEnJmpK20rP3hPpaThd8eBMArP8A5l+zZT6Ro3b3TMRZi1385lCpvWkWJ65uecjoPvRA3EjSebdNMR+NTpcRSQO68jVqkOwP5Ag9Z6LXa4tcDQ3Y8AoBLMfBQT5Txd6hYl2YszEsWN7kk3vCsjrMCzEKFBJIUahQTcKD3DTykc205JkpF4DFNTcOv5h2rzE9ay+qHoI6m4ZFIPlPHFMtXQ/PfhN8CofwnO4x4I5/pPsbdpmammbjfmSXN0O3MgDqnTGwfGYiC8IoJuHxka8ZTI8UdD8p+kAyI7h+Yw3HHj8p+kX5A24fmM3p8NiZJgqd3JkMNyrrGIOstGkPaA5fzhzSHSIKsT46OKpifHnQxgqrZhziHER7j4hxEK0COY26MVLYmmexgYoeMej3+oTxkK8er4lwzFSJUc0yWoj/ABaRIdDtoVNmvzXvBFxYxn0kxT09ioocdrKu0veCOybp53ReizhgGQXdTxHeO0Tjl3z3Hrx6mvTbo24qUkrMDtkXJta/K9o9nkh6aVx/DdlQaAbKMvuJa+j74utSFWtVc7ZvTRCqgINNdkcSb+0645S8Rxzxs5t2truBxIHnIHxKd58AYtUMvYe83J+sw1H7vICdHLYxsX2IfMgfSQPiz2L/APRP2g7XPEk+c6RNZg1VxjD+RfUxRmmc7Cg/DDE8g1redoxzPhsrx5xZUy7bQX43JN+/+0Lb4dQrqYinU3/hoHtba4sAY6yvhcyCnlqiFUqZXQcI42+tZBrV7sIW9bsi+musLRDOnYJ3BbEt2bKE+kdq1wYoquqYkqx1ZEYd+rD7RkraTMUZpSI3hF6PreP66XFooqYax7owUt6S4z4eDrNfee2Hp663fVyPBAfWeWky3dPqq7dOmvEAvUtzudlL94G36yrYmszuXa20dkaAAWVQo0Gg0AkXsUO0jJnbGQsYBKhkg7IMrQhDCla8nz2mU2cS1mSwRiGYsnK9uYta/PTvmSspQd77IJtx2Re1+F/SZNpuHsFM7h8ZEDrO0bcPjOecpIXHnQ+B+kX9HzuH5jDcedD4GA5Cdw/MZvW8N7wrKn32gV4Rlrb5mrLHl54w8iLst4RiYV0iCrE2P5xxWibHRgqr5gdYhxEe5jEGIMnJoFeMOjn+oTxi1zGXRw/5hPGSrx6ticIlWmUqC6keYPaJS8f0VRLkVqnPTZUC3Z3y90juxJnbbplXGXtv1cZxVAOFO1sFyy3G6eBAPCei5XmN0VRTCBQAqodwAcABylBpvarLzljrsiGMkFyypqHvM2ZF8QTYqRZKKYkiEDUcYN8SZ8SZg+OrhN6pvJrtMBYrroCOfjNYLG0KotTdCeaXs479k6274vxme4cu+HdgriwVn0ps1tU2uR4cZSczy8o+mljcA6WPapGoPeJFtxvLpjjMp/XpxozBTnmGG6YYuhUFIur09NMQrVHU2uAHBDWOnG5lowHTmmf49Mp/upsai+JBAYe8r9QfnLyLWiATbNraQ0sxoOQFqU9ohWCswV7Hgdk68j6SfEkX/ThLlRSDPcK7V6T0+IVwR2gEH7mG4V20VtPGSY0gBW5qw9G3be4mmrrbWVAFxWbU1JVVdyNDsLpfsvAHzGqTphnsebuq+fOT4vMaaC7Gmo7WIUSu5r01ohHVH26myyoEVioYiwJbhxhaymZ3ijWr1HPNtlRe4CrugD0v5xe02CLaSF3kyiuXkLTpnnGp5HymtaRgjDAYV6rBKYux9AO0nkIvA58paui+eU8Pu1Ke6x3qqXLjsuvMDu9DCa3ydVd8iyZKFPZFix1djxLTIcuMQqrIylGF1YHQjtEydtxCKkd0+M4PGdUOqZppAoDMG0PgfpA8gO4fEwnMTofAwTIjueZh6fDdReEYBbOYOjQrA9czVj/KzpGRMWZYdIyMK6ToPWMUY46RrXifGmKarGYnjEGJj3MIhxJk0wG5jLo5/qEipzGXRs/jpBXj2Cmd0RFnrbpjqm27K90gfdMtFUh335acqrNaVNDepLplWH3ZHqhyVTJBUM2KM6+HNpttBzB8zzAUabOeIFlHa50UesKFKVLpnXu6U76LZ28W0HsPeOM3WtVXM2JBLG5OrE8STqfeQYLM69PRXug4U3HxEtwsL6jyInWMbaIHLn43g9UWueWn79p0ykvaJbOgeJxQasz1FsWYEhL2UaaAeQj+lXRwdh0OnU/m8bHWV+sATe3f7kSJl14dvtOWfyldcPtcfNvQelVNSU2QN6nTe/EbJXT3BijLc4xNFSlNgEJ2rMAdeG7rw0EBw3SBwiJVTbCJsIwfYf4d7hSdlr2va9uExM3w5/8AHXDdu3TqAeyTn+MpeHbH6fOyTIzxPSnGAFdqly12OzW+p7oBmeeYxigaqyh1BKoFpgXUHQgX59sTY3MCzHYF10sWXZbv0DED1nGIxzuUOyt1AUXuRoAL+0ZM05X586ZWLM12Yse1mLH1MGqLZ+/T3mziHv8Ay37l/WRu7MbsdRwNgPpLkvrnbj4Or4VlG2Bu/wAw/qEBqOOU6avUOhdyOws1vSTZZlz16i06YJY6k8lUcWPd9yJpLJyLrK8OMFg3qHQHYHWa2ngO+WKllyqosbDsj/E4elhsOUOyCByNx4xNkTNVZnIOwOoP6j3zjc7efHpnyk4vYdsNs3BAtzFhr4iLMwwyrvU+oeK36p7u6P8AG22iBEuPBCEDW/AC/G+gEcbtOWMjnLM7r0FK07bJN9lhtAHmR2X+0yN8vyGi9JHqK+0wud++p14abI4C2vAm+syX+nLUXai42D4yPb1kFBtw+M52p1eeocyOh8DBciO55mT5kdD4GDZEdzzM3p8NgYRl77584LeS4HrmastGVNpGRMVZR1Y0MFzoNXMS446GOMQYlx50MRVWzFjeJKxjnMDElYyaYEqQzIqoWspMBqGd4BSXAHGBevUcwXYGvKVzP8aCCBNYbDVCBxndTJ2bjKu0qbRrWqXl6yjGjZEXN0b1vaF4fLWSTqnZ6uIBkyuIrpU2ELS8Rsas816T4jar1GHDbKj8ihftPRUJnlWOJLsDxBe/zE6zpiMgYXUevvOapAXXmfp/eSvx8B9ZBiBoPE/aUAbKNq3gPUTS2ue3X9+8xDd/MD0sJ2q6H98xJZEw3SfD7yFOf77P1hFZd3z+0hC6H195mQoOM2v/AHMXh4/9zFH0+0IzltJGJ1VOs0qwLSrcy/8A+G2GYJXqKVDErTBYXA2RtG3fvj0lGI2Zaeh2NPwKtMVFRg6uoYHeDKFOo+QTn9eMXb485HeN6NPUcGrUDIOCKLAkkm57dSY5GBp0qeyCqqo4kgE90Tv8QnWvSXvF2PvaFJldN1u1dnPaWUD2nk509tu7tWMU422I4X0i3HsuydrmQBbx4/WN81w9NH2abXA4njK7mVW7bI4Lx+Y8Z3wm3m+uWtnB6XVAqrTp00CqFN9qpe2l+VvCZK5aZO35jzbr03DvuHxmg2s4w53D4zkNrKiXGYnQ+EhyM7nmZ1mB3T4GQ5IdzzMzTo3vJsA2+3nBQ0Iy+203nMyz5SdIzMUZOdI1YwXOguIiXHnSOMSYjx3OKarOYNEldo4zAxHWMmqgaoYVkv8AFWBOYbkv8VYGvUsHbZEKDiB4QHZEKCS0O9sTRExUnYWYoykxVnTTFgzaieaZ1hSmIrX51CR4GzfeemrKf04oKHRxozqwfv2dmx8dbekrHsZKbV4nyH0kVbq37FJ+s6rNqfH9ZG5uj95VR/yP0lgvoX4+J+8npHj++cwU9NPD9+hnG2B++z+8lnbDT1+0hK8vC/uZOW4SOrptfl+n/czBBovfqJoGygzZ6p8f1/ScVOqo/fb94Fwq3MnZbe02oCqCez7mQO5aZmVmuT4mdYPENTdXQ2ZDdTa47wR2EaecjrCxnKybyqcLTg+kKuGFb4SN/Kfg7YIPG5vpDEzOhw28Kw7tqmZSpozlfli7T7ZRaMZiqYuV+GNDYI+2SfGIG4+8HRraiEK4PD9mVjj+XPPK5NEzIZgMuqVtr4djs22vO9voZkpC94bqHxmhxmTJSUOY8D4H6QfJOp5mbmTGGMIwHWbzmTJgsuT8I0aZMgudBMTwiPHTJkU1V8w5xHXmTJNVAVSMMh/irMmQNeo4bqjwhKzJk6IbMwTJkCwzQmTIMlWVbpx/4vz/AFSZMlY9telCq/rBX6i/P/RNTJdS5rOdg68x94I3KZMkslH6fSS1OJ8/qZkyZgVXh5/rMbh++yZMgXFczKfCZMm9bxzW63kv0E4mTJJ8ZNGZMgWo3rUlGHw72G0wrbTczsubekyZMfFh6CdSqee0ov3AG31MyZMgH//Z',
            title: 'مهن عمال الاستغلال'
        },
        {
            class: 'disabled',
            onClickLink: '{{route("dalil")}}',
            imgageSource: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTV6j2fKlS0qO5VjA4dE8BEn7imveBM2wJhYid-x6zNqacR20-Qrpw2kZ2MyG0uDA4FxlY&usqp=CAU',
            title: 'دليل المراقب'
        },
        {
            class: 'disabled',
            onClickLink: '{{route("nidam")}}',
            imgageSource: 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTGDrgVdbq8FsWWybpS1644kt9rG3_SayAP1w&usqp=CAU',
            title: 'نظام الاستغلال'
        },
        {
            class: 'disabled',
            onClickLink: '{{route("stop")}}',
            imgageSource: 'data:image/png;base64,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',
            title: 'نقاط توقف الحافلات عبر مختلف المسارات'
        }
    ]

    var rootElement = document.getElementById("imageGalleryWithTitle");
    var p = {{ $p }};
    for (let i = 0; i < articles.length; i++) {
        //Create the container
        if (i > 0) {
            var itemContainer = document.createElement("a");
            itemContainer.classList.add("article-container");
            var href = document.createAttribute("href");
            href.value = articles[i].onClickLink;
            if ([3,4,5,6,7,8,9,10].includes(p) && i==5 ) 
            itemContainer.style.display = "none";
            itemContainer.setAttributeNode(href);
            var target = document.createAttribute("target");
            target.value = '_blank';
            itemContainer.setAttributeNode(target);
             if([5,6,9,10].includes(p) && i>=3 )
            itemContainer.style.display = "none";
            itemContainer.setAttributeNode(href);
            var target = document.createAttribute("target");
            target.value = '_blank';
            itemContainer.setAttributeNode(target);
        } else {
            var itemContainer = document.createElement("div");
            if([6,7,8,9,10].includes(p) )
            itemContainer.style.display = "none";
            itemContainer.classList.add("article-container");
            itemContainer.classList.add("date");

        }
        //Create Image
        var div = document.createElement("div");
        div.classList.add(articles[i].class);
        var mySpan = document.createElement("span");
        mySpan.innerHTML = "New";
        div.appendChild(mySpan);
        var image = document.createElement("img");
        image.classList.add("article-image");
        var src = document.createAttribute("src");
        src.value = articles[i].imgageSource;
        image.setAttributeNode(src);
        var alt = document.createAttribute("alt");
        alt.value = articles[i].title;
        image.setAttributeNode(alt);

        //Create title
        var h3 = document.createElement("h3");
        h3.classList.add("article-title");
        var h3Text = document.createTextNode(articles[i].title);
        h3.appendChild(h3Text);

        //Atach image and title to container
        itemContainer.appendChild(div);
        itemContainer.appendChild(image);
        itemContainer.appendChild(h3);

        //Attach element to root div
        rootElement.appendChild(itemContainer);
    }
});
window.onload = function() {
    document.getElementsByClassName("date")[0].onclick = function() {
        document.getElementById("btnn").click();
    } // your code 
};
</script>
<script src="./assets/js/plugins/chartjs.min.js"></script>

<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by this browser.");
    }
}

function showPosition(position) {
    var a = position.coords.latitude + ',' + position.coords.longitude;

    document.getElementById("lang").value = position.coords.longitude;
    document.getElementById("lat").value = position.coords.latitude;
    let applyForm = document.getElementById('myform1');

    if (!applyForm.checkValidity()) {
        if (applyForm.reportValidity) {
            applyForm.reportValidity();
        } else {
            alert(msg.ieErrorForm);
        }
    } else {
        document.getElementById("myform1").submit();
    }
}
</script>
<script>
var ctx1 = document.getElementById("chart-line").getContext("2d");

var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

gradientStroke1.addColorStop(1, 'rgba(251, 99, 64, 0.2)');
gradientStroke1.addColorStop(0.2, 'rgba(251, 99, 64, 0.0)');
gradientStroke1.addColorStop(0, 'rgba(251, 99, 64, 0)');
new Chart(ctx1, {
    type: "line",
    data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "Mobile apps",
            tension: 0.4,
            borderWidth: 0,
            pointRadius: 0,
            borderColor: "#fb6340",
            backgroundColor: gradientStroke1,
            borderWidth: 3,
            fill: true,
            data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
            maxBarThickness: 6

        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            }
        },
        interaction: {
            intersect: false,
            mode: 'index',
        },
        scales: {
            y: {
                grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    padding: 10,
                    color: '#fbfbfb',
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
            x: {
                grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                    borderDash: [5, 5]
                },
                ticks: {
                    display: true,
                    color: '#ccc',
                    padding: 20,
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                }
            },
        },
    },
});
</script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
@endpush