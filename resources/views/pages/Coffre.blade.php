@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'مراقبة الصندوق'])
@if(isset($ctrl))
<script>
alert('لقد قمت بمراقبة الصندوق')
</script>
@endif
<div class="container-fluid py-4">
    <form class="form main__form" id="myform" action="/add_coffre" style="    z-index: 9;
    position: relative;
    border: black;
    border-radius: 9px;
    background-color: navajowhite;" method="POST" dir="rtl">
        @csrf
        <div class="form__linput">
            <label class="form__label" for="fname">التاريخ</label>
            <input class="form__input" required type="datetime-local" id="date" required name="date" />
        </div>
        <div class="form__linput">
            <label class="form__label" for="name">الاسم</label>

            <select class="form__select" required id="name" required name="name">
                <option value="" required>--- القابض ---</option>
                @foreach (App\Models\Kabid::where('id','>','2')->get() as $k)
                <option value="{{$k->id}}">{{$k->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form__linput">
            <label class="form__label" required for="ligne">الخط</label>
            <select class="form__select" id="ligne" required name="ligne">
                <option value="" required>اختر الخط</option>
                @foreach (App\Models\Ligne::get() as $l)
                <option value="{{$l->id}}">{{$l->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="form__linput">
            <label class="form__label" for="bus">التذاكر بقيمة 20 دج</label>
            <div class="row">
                <div class="col-5"><input onkeyup="ch(1)" value="0" required type="number" style="width:100px" min="0"
                        id="t20" name="t20">
                </div>
                <div class="col-5">بمبلغ <span id="tp20">0</span> دج</div>
            </div>

        </div>
        <div class="form__linput">
            <label class="form__label" for="bus">التذاكر بقيمة 25 دج</label>
            <div class="row">
                <div class="col-5"><input onkeyup="ch(2)" value="0" required type="number" style="width:100px" min="0"
                        id="t25" name="t25">
                </div>
                <div class="col-5">بمبلغ <span id="tp25">0</span> دج</div>
            </div>

        </div>
        <div class="form__linput">
            <label class="form__label" for="bus">التذاكر بقيمة 30 دج</label>
            <div class="row">
                <div class="col-5"><input onkeyup="ch(3)" value="0" required type="number" style="width:100px" min="0"
                        id="t30" name="t30">
                </div>
                <div class="col-5">بمبلغ <span id="tp30">0</span> دج</div>
            </div>

        </div>
        <div class="row">
            <div class="col-8">اجمالي التذاكر <span id="tt">0</span> دج</div>
        </div>

        <div class="form__linput">
            <label class="form__label" for="bus">النقود </label>
            <div class="row">
                <div class="col-5"><input onkeyup="ch(4)" value="0" required type="text" id="money" name="money"></div>
                <br>
                <div class="col-7">اجمالي الصندوق <span id="ts">0</span> دج</div>
            </div>

        </div>
        <div class="form__linput">
            <label class="form__label" for="bus">المحاسب </label>
            <div class="row">
                <div class="col-5"><input value="0" required type="text" id="caisse" name="caisse"></div>
            </div>

        </div>
        <div class="form__linput">
            <label class="form__label" for="infra">ملاحظة:</label>
            <textarea class="form-control" rows="5" id="rq" name="rq"></textarea>

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

function ch(x) {

    x = document.getElementById("t20").value * 20;
    y = document.getElementById("t25").value * 25;
    z = document.getElementById("t30").value * 30;
    xx = document.getElementById("money").value * 1;
    document.getElementById("tp20").textContent = x;
    document.getElementById("tp25").textContent = y;
    document.getElementById("tp30").textContent = z;


    document.getElementById("tt").textContent = x + y + z;
    document.getElementById("ts").textContent = x + y + z + xx;
}

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