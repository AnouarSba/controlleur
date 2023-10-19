<!DOCTYPE html>
<html>

<head>
    <title>Stop</title>
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
    <div class="container" style="overflow:scroll" dir="rtl">

        <h4>التاريخ من : <?php echo str_replace("T", " ", $sttart_date); 
        ?> إلى : <?php echo
        str_replace("T", " ", $endd_date); ?> </h4>

        <table class="table table-bordered data-table" dir="rtl" style="text-align:right; font-size:12px">
            <thead>
                <tr>
                    <th>رقم</th>
                    <th> رئيس المحطة</th>
                    <th> الخط</th>
                    <th> الحافلة</th>
                    <th>اسم السائق</th>
                    <th> الخدمة</th>
                    <th> وقت التوقف</th>
                    <th> وقت الانطلاق</th>
                    <th>سبب التوقف </th>
                    <th> العطب </th>
                    <th>التفصيل </th>
                    <th> الوقت المستغرق</th>
                    <th>  </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <div class="row" dir="rtl" style="float:right;font-size:18px">
            الوقت المستغرق الكلي {{$time}} دقيقة
        </div>

    </div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> تحديث توقيت نهاية التوقف </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('panne_edit')}}" method="post">
                        @csrf
                       
                        <input type="hidden" name="panne" id="panne">
                        <input type="hidden" value="{{$sttart_date}}" name="sttart_date" id="sttart_date">
                        <input type="hidden" value="{{$time}}" name="time" id="time">
                        <input type="datetime-local" name="endd_date" id="end_date">
                      
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <input type="submit" class="btn btn-primary" value="تاكيد">
                    </form>
                </div>
            </div>
        </div>
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
    var a = @php echo $tp; @endphp ;
    var ps = @php echo $lp; @endphp ;
    
    var table = $('.data-table').DataTable({
        dom: "lBfrtip",
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('panne') }}",
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
                name: 'pannes.id'
            },
            {
                data: 'ctrl_name',
                name: 'users.username'
            },
            {
                data: 'l_name',
                name: 'lignes.name'
            },
            {
                data: 'b_name',
                name: 'buses.name'
            },
            {
                data: 'c_name',
                name: 'chauffeurs.name'
            },
            {
                data: 'service',
                name: 'service'
            },
            {
                data: 'start_date',
                name: 'start_date'
            },

            {
                data: 'end_date',
                name: 'end_date'
            },
            {
                data: 'cause',
                name: 'cause'
            },
            {
                data: 'panne',
                name: 'panne'
            },
            {
                data: 'caused',
                name: 'caused'
            },
            {
                data: 'time',
                name: 'time'
            },
            {
                data: 'action',
                name: 'action'
            },
        ],
        createdRow: function(row, data, index) {

            // Updated Schedule Week 1 - 07 Mar 22
            $('td:eq(5)', row).html(arr[data.service - 1]); //Original Date

            if (data.cause == 0) {
                              $('td:eq(8)', row).html('لم يحدد'); // Behind of Original Date
                          }
                          else $('td:eq(8)', row).html(a[data.cause-1]);
                          if (data.panne == 0 && data.panne==null) {
                              $('td:eq(9)', row).html(''); // Behind of Original Date
                          }
                          else $('td:eq(9)', row).html(ps[data.panne-1]);
        },

    });

});

function put_id(x, y) {
    
    $('#panne').val(x);
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
      
    $('#end_date').val(localDateTime);
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