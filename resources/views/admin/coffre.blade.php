<!DOCTYPE html>
<html>

<head>
    <title>Coffres</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <style>
    body {
        margin: 0;
    }

    html,
    body,
    #leaflet {
        height: 100%;

    }

    .animate {
        color: red;
        animation: blinker 1s linear infinite;
    }

    @keyframes blinker {
        50% {
            opacity: 0;
        }
    }

    #map {
        margin-left: 10%;
        height: 580px;
        width: 80%
    }
    </style>
</head>

<body>

    <div class="container"  style="overflow:scroll" dir="rtl">
        <h1>مراقبة الصندوق</h1>
        <h3>المراقب: <?php echo $controlleur; ?></h3>
        

        <h4>التاريخ من : <?php echo str_replace("T", " ", $sttart_date); 
        ?> إلى : <?php echo
        str_replace("T", " ", $endd_date); ?> </h4>

        <table class="table table-bordered data-table">
            <thead>
                <tr>
                    <th>رقم</th>
                    <th> المراقب</th>
                    <th> القابض</th>
                    <th> الخط</th>
                    <th> تاريخ</th>
                    <th> المبلغ الاجمالي (دج)</th>
                    <th> المحاسب </th>
                    <th>الفارق </th>

                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تسوية وضعية التبليغ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('Alert_save')}}" method="post">
                        @csrf
                        هل أنت متأكد من حفظ التبليغ
                        <input type="hidden" name="alert" id="alert">
                        <input type="hidden" name="status" id="status">
                        <input type="hidden" value="{{$sttart_date}}" name="from" id="from">
                        <input type="hidden" value="{{$endd_date}}" name="to" id="to">
                        <input type="hidden" value="{{$controlleur}}" name="controlleur" id="controlleur">
                        <input type="hidden" value="{{$user_id}}" name="type_id" id="type_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <input type="submit" class="btn btn-primary" value="تاكيد">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal01" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">تسوية وضعية المخالفة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('Coffre_save')}}" method="post">
                        @csrf
                        هل أنت متأكد من تقديم الاستفسار
                        <input type="hidden" name="infra" id="infra_q">
                        <input type="hidden" name="status" id="status_q">
                        <input type="hidden" value="{{$sttart_date}}" name="from" id="from">
                        <input type="hidden" value="{{$endd_date}}" name="to" id="to">
                        <input type="hidden" value="{{$controlleur}}" name="controlleur" id="controlleur">
                        <input type="hidden" value="{{$user_id}}" name="type_id" id="type_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <input type="submit" class="btn btn-primary" value="تقديم استفسار">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">معالجة التبليغ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('Alert_trait')}}" method="post">
                        @csrf

                        <input type="hidden" name="alert" id="alert_2">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">كيف تمت معالجة هذا التبليغ</label>
                            <textarea class="form-control" required rows="10" id="cntnt" name="proces"></textarea>
                        </div>
                        <input type="hidden" value="{{$sttart_date}}" name="from" id="from">
                        <input type="hidden" value="{{$endd_date}}" name="to" id="to">
                        <input type="hidden" value="{{$controlleur}}" name="controlleur" id="controlleur">
                        <input type="hidden" value="{{$user_id}}" name="type_id" id="type_id">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <input type="submit" class="btn btn-primary" value="تاكيد">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ضبط نتيجة الاستفسار عن المخالفة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('Coffre_trait')}}" method="post">
                        @csrf

                        <input type="hidden" name="infra" id="infra_q2">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">حدد مآل المخالفة</label>
                            <textarea class="form-control" required rows="10" id="quest" name="quest"></textarea>
                        </div>
                        <input type="hidden" value="{{$sttart_date}}" name="from" id="from">
                        <input type="hidden" value="{{$endd_date}}" name="to" id="to">
                        <input type="hidden" value="{{$controlleur}}" name="controlleur" id="controlleur">
                        <input type="hidden" value="{{$user_id}}" name="type_id" id="type_id">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <input type="submit" class="btn btn-primary" value="تاكيد">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</body>

<script>
var d1 = "{{$sttart_date}}";
var d2 = "{{$endd_date}}";
d1 = new Date(d1);
d2 = new Date(d2);
var currentDateMilliSec = d1.getTime();
var updateDateMilliSec = d2.getTime();

var diffDays = (updateDateMilliSec - currentDateMilliSec) / (24 * 60 * 60 * 1000);
if (Math.ceil(diffDays) + 1 == 1) {


    var map = L.map('map').setView([35.2, -0.641389], 14);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    var cures = <?php echo json_encode( $markers); ?>;
    var c = [];
    for (var key in cures) {
        if (cures[key]['lat']) {
            var cure = cures[key];
            // your code from above modified to use the Javascript variable created
            var marker = L.marker([cures[key]['lat'], cures[key]['lang']]).addTo(map);
            marker.bindPopup(cures[key]['created_at']).openPopup();
            var popup = L.popup();
            c.push([cures[key]['lat'], cures[key]['lang']]);
        }

    }


    var spiralLine = L.polyline(c).addTo(map)
}
/*  function connectTheDots(data){
    var c = [];
    for(i in data._layers) {
        var x = data._layers[i]._latlng.lat;
        var y = data._layers[i]._latlng.lng;
        c.push([x, y]);
    }
    return c;
}

spiralCoords = connectTheDots(spiralLayer);
var spiralLine = L.polyline(spiralCoords).addTo(map)
 */
</script>

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(function() {

    var table = $('.data-table').DataTable({
        dom: "lBfrtip",
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('Coffre_list') }}",
            type: "post",
            data: {
                user_id: "{{$user_id}}",
                sttart_date: "{{$sttart_date}}",
                endd_date: "{{$endd_date}}",
                'csrf-token': $('meta[name=csrf-token]').attr("content")
            },
            deferRender: true,
        },
        columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'ctrl_name',
                name: 'users.username'
            },
            {
                data: 'emp_name',
                name: 'kabids.name'
            },
            {
                data: 'l_name',
                name: 'lignes.name'
            },
            {
                data: 'c_date',
                name: 'c_date'
            },
            {
                data: 'ts',
                name: 'ts'
            },
            {
                data: 'caisse',
                name: 'caisse'
            },
            {
                data: 'rq',
                name: 'rq'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        createdRow: function(row, data, index) {

            // Updated Schedule Week 1 - 07 Mar 22


            /* else if (data.cn == null) {
                              $('td:eq(2)', row).css('background-color', 'grey'); // Behind of Original Date
                          }*/
        },
    });

});

function put_id(x, y) {
    $('#alert').val(x);
    $('#status').val(y);
}

function put_id01(x, y) {
    $('#infra_q').val(x);
    $('#status_q').val(y);
}

function put_id2(x, y) {
    $('#infra_q2').val(x);
    $('#quest').html(y);
}

</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

</html>