<!DOCTYPE html>
<html>

<head>
    <title>Events</title>
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
    @if(isset($event) && $event == 1)
<script>
alert('تم التأكيد بنجاح')
</script>
@endif
    <div class="container" style="overflow:scroll" dir="rtl">

        <h4>التاريخ من : <?php echo str_replace("T", " ", $sttart_date); 
        ?> إلى : <?php echo
        str_replace("T", " ", $endd_date); ?> </h4>

        <table class="table table-bordered data-table" dir="rtl" style="text-align:right; font-size:16px">
            <thead>
                <tr>
                    <th>رقم</th>
                     <th>اسم العامل</th>
                    <th> تاريخ الطلب</th>
                    <th> نوع الحدث</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
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
                <form action="{{route('event_reg')}}" method="post" dir="rtl">
                    @csrf
                    
                    <input type="hidden" name="event" id="event">
                    <input type="hidden" name="status" id="status">
                    <label for="nbr_jr">عدد الأيام</label>
                    <input type="number" name="nbr_jr" id="nbr_jr">
                    <input type="hidden" value="{{$sttart_date}}" name="from" id="from">
                    <input type="hidden" value="{{$endd_date}}" name="to" id="to">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                <input type="submit" class="btn btn-primary" value="تاكيد">
                </form>
            </div>
        </div>
    </div>
</div>
<br>
<div class="col-12" style="text-align:center">
    <a href="/Control"> <button type="button" class="btn btn-primary mb-2"> Retour</button></a>
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
    
    var table = $('.data-table').DataTable({
        dom: "lBfrtip",
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('show_events') }}",
            type: "post",
            data: {
                start_date: "{{$sttart_date}}",
                end_date: "{{$endd_date}}",
                'csrf-token': $('meta[name=csrf-token]').attr("content")
            },
            deferRender: true,
        },
        columns: [{
                data: 'id',
                name: 'events.id'
            },
            {
                data: 'username',
                name: 'users.username'
            },
            {
                data: 'date',
                name: 'events.created_at'
            },
            
            {
                data: 'name',
                name: 'events.name'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        
    });

});
function put_id(x, y) {
    $('#event').val(x);
    $('#status').val(y);
}

</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

</html>