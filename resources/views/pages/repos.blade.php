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

        .contain {
            width: 100%;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .form-contain {
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
            background-color: #007bff;
            color: #fff;
            text-align: center;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-center {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn-primary,
        .btn-pdf {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            color: white;
            cursor: pointer;
            margin: 5px;
        }

        .btn-primary:hover,
        .btn-pdf:hover {
            background-color: #0056b3;
        }


        .checkbox-container {
            display: flex;
            /* flex-direction: column; */
            align-items: center;
            justify-content: center;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .checkbox-container label {
            margin: 10px 0;
        }
    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="contain form-contain">
        @if (in_array(auth()->user()->is_, [1, 6]))
            <div class="row m-5" style="justify-content: center; align-items: center;">

                <div class="checkbox-container" dir="rtl">
                    <form action="{{ route('repo') }}" method="post" id="form">
                        @csrf
                    <label><input type="checkbox" {{$admin ?? ''}} name="admin" value="1"> الإدارة </label>
                    <label><input type="checkbox" {{$exp ?? ''}} name="exp" value="2"> الاستغلال </label>
                    {{-- <label><input type="checkbox" {{$compta ?? ''}} name="compta" value="3">المحاسبة </label> --}}
                    <label><input type="checkbox" {{$maint ?? ''}} name="maint" value="4"> الصيانة </label>
                    {{-- <label><input type="checkbox" {{$stock ?? ''}} name="stock" value="5"> المخزن </label> --}}
                        <input class="btn-primary mb-2 " type="submit" value="بحث">
                    </form>
                </div>
            </div>
        @endif
        <div class="table-responsive" id="table-container">
            <table class="table table-bordered" dir="rtl">
                <thead>
                    <tr>
                        <th>الاسم واللقب</th>
                        <th>الرصيد القديم</th>
                        @foreach ($holidays as $holiday)
                            <th>{{ $holiday->name }}</th>
                        @endforeach
                        @foreach ($events as $event)
                            <th>{{ $event->name }}</th>
                        @endforeach
                        <th>العطلة التعويضية</th>
                        <th>الرصيد الجديد</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emps as $emp)
                        <tr>
                            <td><a href="{{ route('details', ['id' => $emp->id]) }}">{{ $emp->username }}</a></td>
                            <td>{{ $emp->R }}</td>
                            @foreach ($holidays as $holiday)
                                <td>{{ $emp[$holiday->name] }}</td>
                            @endforeach
                            @foreach ($events as $event)
                                <td>{{ $emp[$event->name] }}</td>
                            @endforeach
                            <td>{{ $emp['repos'] }}</td>
                            <td>{{ $emp['new'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
    const table = document.getElementById("table-container");

    // Convert the table to a canvas
    await html2canvas(table, { scale: 2, useCORS: true }).then(canvas => {
        const imgData = canvas.toDataURL('image/png');
        const imgProps = doc.getImageProperties(imgData);
        const pdfWidth = doc.internal.pageSize.getWidth();
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
        const pageHeight = doc.internal.pageSize.getHeight();
        let heightLeft = pdfHeight;
        let position = 0;

        doc.addImage(imgData, 'PNG', 0, position, pdfWidth, pdfHeight);
        heightLeft -= pageHeight;

        // Add new pages while content still exists
        while (heightLeft > 0) {
            position = heightLeft - pdfHeight;
            doc.addPage();
            doc.addImage(imgData, 'PNG', 0, position, pdfWidth, pdfHeight);
            heightLeft -= pageHeight;
        }

        doc.save("وضعية أيام الراحة العالقة.pdf");
    });
}

    </script>
</body>

</html>
