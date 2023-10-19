@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'توقف الحافلة'])
@if(isset($cs))
<script>
alert('لقد قمت بالتبليغ عن توقف الحافلة')
</script>
@endif
<div class="container-fluid py-4">
    <form class="form main__form" id="myform" action="/store_panne" style="    z-index: 9;
    position: relative;
    border: black;
    border-radius: 9px;
    background-color: navajowhite;" method="POST" dir="rtl">
        @csrf
        <div class="form__linput">
            <label class="form__label" for="ligne">الخط</label>
            <select class="form__select" id="ligne" required name="ligne">
                <option value="" required>اختر الخط</option>
                @foreach (App\Models\Ligne::get() as $l)
                <option value="{{$l->id}}">{{$l->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form__linput">
            <label class="form__label" for="bus">الحافلة</label>

            <select class="form__select" id="country-select" required name="bus">
                <option value="">اختر الحافلة</option>
                @foreach (App\Models\Bus::get() as $bus)
                <option value="{{$bus->id}}">{{$bus->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form__linput">
            <label class="form__label" for="name">اسم السائق</label>

            <select class="form__select" id="chauff" required name="chauff">
                <option value="" required>--- اختر العامل ---</option>
                @foreach (App\Models\Chauffeur::get() as $k)
                <option value="{{$k->id}}">{{$k->name}}</option>
                @endforeach
            </select>
        </div>
        @php
        $arr=[' ', 'A', 'B', 'C', 'D'];
        @endphp
        <div class="form__linput">
            <label class="form__label" for="arret">الخدمة</label>
            <select class="form__select" id="arret" required name="service">
                <option value="" required>اختر الخدمة</option>
                @for($i=1; $i<=4 ; $i++) <option value="{{$i}}">{{$arr[$i]}}</option>
                    @endfor
            </select>
        </div>
        <div class="form__linput">
            <label class="form__label" for="arret">وقت التوقف</label>

            <input type="datetime-local" name="start_date" id="start_date">

        </div>
        <div class="form__linput">
            <label class="form__label" for="arret">وقت الانطلاق</label>

            <input type="datetime-local" name="end_date" id="end_date">

        </div>

        <div class="form-group">
            <label class="form__label" for="arret" style="float:right">سبب التوقف</label>
 <select class="form__select" id="arret" required name="cause">
                <option value="" required>-- السبب --</option>
                @foreach ($panne as $k)
                <option value="{{$k->id}}">{{$k->name}}</option>
                @endforeach
            </select>
             <label class="form__label" for="arret" style="float:right">نوع العطب</label>
 <select class="form__select" id="arret" required name="cause">
                <option value="" required>-- العطب --</option>
                @foreach ($lpanne as $k)
                <option value="{{$k->id}}">{{$k->name}}</option>
                @endforeach
            </select>
             <label class="form__label" for="arret" style="float:right">تفصيل سبب التوقف</label>
            <textarea name="caused" required placeholder="تفصيل سبب التوقف" id="cause" cols="30" rows="5"></textarea>
        </div>
        <input class="primary-btn form__btn" style="text-align: center;
    margin-right: 0%;
    font-size: 18px;
    background-color: greenyellow;
    margin-top: 5px;
    margin-bottom: 5px;
    color: darkblue;" type="submit" value="تأكيد">
    </form>
    @include('layouts.footers.auth.footer')
</div>
@endsection

@push('js')

<script>

</script>
@endpush