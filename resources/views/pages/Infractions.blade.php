@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'المخالفات'])
@if(isset($ctrl))
<script>
alert('لقد قمت بتحرير المخالفة')
</script>
@endif
<div class="container-fluid py-4">
    <form class="form main__form" id="myform" action="/add_infra" style="    z-index: 9;
    position: relative;
    border: black;
    border-radius: 9px;
    background-color: navajowhite;" method="POST" dir="rtl">
        @csrf
        <div class="form__linput">
            <label class="form__label" for="fname">التاريخ</label>
            <input class="form__input" type="date" id="date" required name="date" />
        </div>
        <div class="form__linput">
            <label class="form__label" for="fname">العامل:</label>
            <fieldset dir="rtl">
                <div class="some-class" style="float:right">
                    <input type="radio" class="radio" name="x" value="0" onchange="handleChange(this);" id="z" />
                    <label for="y">السائق </label>
                    <input type="radio" checked class="radio" name="x" value="1" onchange="handleChange(this);"
                        id="y" />
                    <label for="z">القابض </label>

                </div>
            </fieldset>
        </div>
        <div class="form__linput">
            <label class="form__label" for="name">الاسم</label>

            <select class="form__select" id="name" required name="name">
                <option value="" required>--- اختر العامل ---</option>
                @foreach (App\Models\Kabid::where('id','>','2')->get() as $k)
                <option value="{{$k->id}}">{{$k->name}}</option>
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
            <label class="form__label" for="ligne">الخط</label>
            <select class="form__select" id="ligne" required name="ligne">
                <option value="" required>اختر الخط</option>
                @foreach (App\Models\Ligne::get() as $l)
                <option value="{{$l->id}}">{{$l->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form__linput">
            <label class="form__label" for="arret">المحطة</label>
            <select class="form__select" id="arret" required name="arret">
                <option value="" required>اختر المحطة</option>
                @foreach (App\Models\Arret::get() as $a)
                <option value="{{$a->id}}">{{$a->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form__linput">
            <label class="form__label" for="infra">الخطأ</label>
            <select class="form__select" id="infra" required name="infra">
                <option value="" required>اختر نوع الخطأ</option>
                @foreach (App\Models\Fkab::get() as $fk)
                <option value="{{$fk->id}}">{{$fk->name}}</option>
                @endforeach
            </select>
        </div>
        <input type="hidden" name="lang" id="lang">
        <input type="hidden" name="lat" id="lat">
        <button class="primary-btn form__btn" style="text-align: center;
    margin-right: 0%;
    font-size: 18px;
    background-color: greenyellow;
    margin-top: 5px;
    margin-bottom: 5px;
    color: darkblue;" onclick="getLocation();" type="button">تأكيد</button>
    </form>
    @include('layouts.footers.auth.footer')
</div>
@endsection

@push('js')
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
    let applyForm = document.getElementById('myform');

    if (!applyForm.checkValidity()) {
        if (applyForm.reportValidity) {
            applyForm.reportValidity();
        } else {
            alert(msg.ieErrorForm);
        }
    } else {
        document.getElementById("myform").submit();
    }
}
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

function handleChange(src) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var id = src.value;
    $.ajax({
        method: "GET",
        url: "/inf_show/" + id,

    }).done(function(data) {
        $("select[name='name'").html('');

        $("select[name='name'").html(data.options);

    });
    $.ajax({
        method: "GET",
        url: "/inf_type/" + id,

    }).done(function(data) {
        $("select[name='infra'").html('');

        $("select[name='infra'").html(data.options);

    });
}
</script>
@endpush