<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            min-height: 100vh;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 100%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .form-container {
            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .table-responsive {
            flex: 1;
            overflow: auto;
        }

        .table {
            margin-bottom: 20px;
        }

        .table thead th {
            background-color: #999999;
            color: #fff;
            text-align: center;
        }

        .table tbody tr:nth-child(even) {
            /* background-color: #f2f2f2; */
        }

        .btn-center {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn-primary, .btn-pdf {
            background-color: #999999;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            color: white;
            cursor: pointer;
            margin: 5px;
        }

        .btn-primary:hover, .btn-pdf:hover {
            background-color: #999999;
        }
        .sc{
            background-color: rgba(40, 167, 69, 0.5); /* Semi-transparent success green background */
        }
        .dg{
            background-color: rgba(220, 53, 69, 0.5); /* Semi-transparent danger red background */

        }
    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container form-container">
        <div class="table-responsive" id="table-containerer">
            <h2 class="text-center" style="font-family: Aparajita;font-size: 30px;direction:rtl;">{{$emp->username ?? ''}} : {{date('Y-m-d')}}</h2>
            <h3 class="text-center">الرصيد القديم : {{$emp->R ?? ''}}</h3>
            <table class="table table-bordered" dir="rtl" style="text-align: center">
                <thead>
                    <tr>
                        <th style="width: 30%">التاريخ</th>
                        <th style="width: 50%">الحدث</th>
                       @if (Auth::user()->is_ == 1 && Auth::user()->id > 1)
                           <th style="width: 20%"></th>
                       @endif 
                    </tr>
                </thead>
                <tbody>
                    @php
                        $R = $emp->R;
                    @endphp
                    @foreach ($recups as $recup)
                        @php
                        $R = ($recup->sign) ? $R+1 : $R-1;
                        @endphp
                        <tr class="{{($recup->sign)? 'sc' : 'dg'}}">
                            <td>{{ $recup->date }}</td>
                            <td>{{ $recup->holiday? $recup->holiday : ($recup->event? $recup->event : '/') }}</td>
                            @if (Auth::user()->is_ == 1 && Auth::user()->id > 1)
                            <td class="d-flex justify-content-around">
                                <form action="{{route('recup.edit')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$recup->id }}">
                                    <input type="hidden" name="emp_id" value="{{$recup->emp_id }}">
                                    <input type="hidden" name="date" value="{{$recup->date }}">
                                    <select name="status">
                                        @foreach (App\Models\Emp_status::all() as $item)
                                            <option value="{{$item->id}}" @if ($item->id == $recup->emp_status_id) selected @endif>{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-danger">تعديل</button>
                                </form>
                                <form action="{{route('recup.destroy')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$recup->id }}">
                                    <button type="submit" class="btn btn-danger">حذف</button>
                                </form>
                            </td>
                            @endif 
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h3 class="text-center">الرصيد الجديد : {{$R }}</h3>

        </div>
        <div class="btn-center">
            <a href="/">
                <button type="button" class="btn btn-primary mb-2">Retour</button>
            </a>
            <button type="button" class="btn-pdf mb-2" onclick="downloadPDF()">Download PDF</button>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script>
        async function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF('p', 'pt', 'a4');
            const table = document.getElementById("table-containerer");

            await html2canvas(table, {
                scale: 2,
                useCORS: true
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgProps = doc.getImageProperties(imgData);
                const pdfWidth = doc.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                doc.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                doc.save("وضعية أيام الراحة العالقة.pdf");
            });
        }
    </script>
</body>

</html>
