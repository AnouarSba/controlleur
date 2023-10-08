@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'تحركة الحافلة'])
@if(isset($cs))
<script>
alert('لقد قمت بالتبليغ عن توقف الحافلة')
</script>
@elseif(isset($cs1))
<script>
alert('لقد قمت بتأكيد حركة الحافلة')
</script>
@endif
<div class="container-fluid py-4">
    <form class="form main__form" id="myform" action="/store_move" style="    z-index: 9;
    position: relative;
    border: black;
    border-radius: 9px;
    background-color: navajowhite;" method="POST" dir="rtl">
        @csrf
        <div class="form__linput">
            <label class="form__label" for="ligne">المحطة</label>
            <select class="form__select" id="station" required name="station">
                <option value="" required>اختر المحطة</option>
                <option value="0">محطة الأمير عبد القادر</option>
                <option value="1">المحطة رقم 17</option>
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
            <label class="form__label" for="ligne">حالة الحافلة</label>
            <select class="form__select" id="status" required name="status">
                <option value="" required>اختر الحالة</option>
                <option value="0">دخول</option>
                <option value="1">خروج</option>
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
        <div class="form__linput">
            <label class="form__label" for="name">اسم القابض</label>

            <select class="form__select" id="kabid" required name="kabid">
                <option value="" required>--- اختر العامل ---</option>
                @foreach (App\Models\Kabid::get() as $k)
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

            <input type="datetime-local" hidden name="timing" id="start_date">

        </div>
       <div class="form__linput">
            <label class="form__label" for="ligne">حالة اللوحة الالكترونية</label>
            <select class="form__select" id="gstatus" required name="gstatus">
                <option value="" required>اختر الحالة</option>
                <option value="0">تشتغل</option>
                <option value="1">لا تشتغل</option>
            </select>
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
 <script type="text/javascript">
       Number.prototype.AddZero= function(b,c){
        var  l= (String(b|| 10).length - String(this).length)+1;
        return l> 0? new Array(l).join(c|| '0')+this : this;
     }//to add zero to less than 10,


       var d = new Date(),
       localDateTime= [ d.getFullYear(),(d.getMonth()+1).AddZero(),
                d.getDate().AddZero()
               ].join('-') +'T' +
               [d.getHours().AddZero(),
                d.getMinutes().AddZero()].join(':');
       var elem=document.getElementById("start_date"); 
       elem.value = localDateTime;
       alert(localDateTime)
     </script>
@endpush