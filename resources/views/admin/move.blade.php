<!DOCTYPE html>
<html>

<head>
    <title>Move</title>
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
    @if(isset($ctrl))
    <script>
    alert('انت تراقب الحافلة {{$buses[$ctrl]}}')
    </script>
    @endif
    <div class="container"  style="overflow:scroll" dir="rtl">

        <h4>التاريخ من : <?php echo str_replace("T", " ", $sttart_date); 
        ?> إلى : <?php echo
        str_replace("T", " ", $endd_date); ?> </h4>

        <table class="table table-bordered data-table" dir="rtl" style="text-align:right; font-size:12px">
            <thead>
                <tr>
                    <th>رقم</th>
                    <th> المراقب</th>
                    <th> المحطة</th>
                    <th> الحافلة</th>
                    <th>الخط </th>
                    <th>اسم السائق</th>
                  <!--  <th>اسم القابض</th>-->
                    <th> الخدمة</th>
                    <th> الحالة </th>
                    <th> حالة اللوحة الالكترونية </t>
                    <th> حالة نظافة الحافلات</th>
                    <th> التوقيت </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>

</body>

<script>

</script>

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(function() {
    var arr = ['A', 'B', 'C', 'D'];
    var s=['دخول','خروج'];
    var st=  @php echo $tp; @endphp ;;
    var g=['تشتغل','لا تشتغل'];
          var n=['غير نظيفة',' نظيفة '];


    var table = $('.data-table').DataTable({
        dom: "lBfrtip",
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('move') }}",
            type: "post",
            data: {
                sttart_date: "{{$sttart_date}}",
                endd_date: "{{$endd_date}}",
                'csrf-token': $('meta[name=csrf-token]').attr("content")
            },
            deferRender: true,
        },
        columns: [{
                data: 'id',
                name: 'moves.id'
            },
            {
                data: 'ctrl_name',
                name: 'users.username'
            },
            {
                data: 'station_id',
                name: 'station_id'
            },
            {
                data: 'b_name',
                name: 'buses.name'
            },
            {
                data: 'l_name',
                name: 'lignes.name'
            },
            {
                data: 'c_name',
                name: 'chauffeurs.name'
            },
          /*  {
                data: 'k_name',
                name: 'kabids.name'
            },*/
            {
                data: 'service',
                name: 'service'
            },
            {
                data: 'ms',
                name: 'moves.status'
            },

            {
                data: 'gstatus',
                name: 'gstatus'
            },
            
              {
                data: 'nstatus',
                name: 'nstatus'
            },
            
            {
                data: 'timing',
                name: 'timing'
            },
        ],
        createdRow: function(row, data, index) {
            if(data.station_id > 4)
                              $('td:eq(2)', row).html(st[data.station_id-2]); // Behind of Original Date
                              else
                              $('td:eq(2)', row).html(st[data.station_id-1]); // Behind of Original Date

            // Updated Schedule Week 1 - 07 Mar 22
            $('td:eq(6)', row).html(arr[data.service - 1]); //Original Date

                              $('td:eq(7)', row).html(s[data.ms]); // Behind of Original Date
                              $('td:eq(8)', row).html(g[data.gstatus]); // Behind of Original Date
                                                            $('td:eq(9)', row).html(n[data.nstatus]); // Behind of Original Date

                     
        },

    });

});

function put_id(x, y) {
    $('#infra').val(x);
    $('#status').val(y);
}

function put_id01(x, y) {
    $('#infra_q').val(x);
    $('#status_q').val(y);
}

function put_id2(x, y) {
    $('#infra_t').val(x);
    $('#proces').html(y);
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