@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'الأعطاب'])
@if(isset($lpanne))
<script>
alert('لقد قمت بتسجيل العطب')
</script>
@endif
<div class="container-fluid py-4">
    <form class="form main__form" id="myform" action="/add_panne" style="    z-index: 9;
    position: relative;
    border: black;
    border-radius: 9px;
    background-color: navajowhite;" method="POST" dir="rtl">
        @csrf
       
        <div class="form__linput">
            <label class="form__label" for="name">نوع العطب</label>

            <select class="form__select" id="name" required name="type">
                <option value="" required>--- اختر العطب ---</option>
                @foreach (App\Models\Tpanne::where('id','>','1')->where('id','<','5')->get() as $k)
                <option value="{{$k->id}}">{{$k->name}}</option>
                @endforeach
            </select>
            <input type='text' id='lpanne' name='name'>
        </div>
       
        <button class="primary-btn form__btn" style="text-align: center;
    margin-right: 0%;
    font-size: 18px;
    background-color: greenyellow;
    margin-top: 5px;
    margin-bottom: 5px;
    color: darkblue;"  type="submit">تأكيد</button>
    </form>
    @include('layouts.footers.auth.footer')
</div>
@endsection

@push('js')
<script src="./assets/js/plugins/chartjs.min.js"></script>

<script>
</script>
@endpush