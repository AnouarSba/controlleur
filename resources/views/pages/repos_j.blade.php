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

        .btn-primary, .btn-pdf {
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            color: white;
            cursor: pointer;
            margin: 5px;
        }

        .btn-primary:hover, .btn-pdf:hover {
            background-color: #0056b3;
        }
    </style>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="contain form-contain">
        <div class="table-responsive" id="table-container">
            <table class="table table-bordered" dir="rtl">
                <thead>
                    <tr>
                        <th>الاسم واللقب</th>
                        <th>الرصيد القديم</th>
                        <th>ايام العمل الكاملة</th>
                        <th>ايام الراحة الكاملة</th>
                        <th>الرصيد الجديد</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emps as $emp)
                        <tr>
                            <td><a href="{{route('details_rj', ['id' => $emp->id])}}">{{ $emp->username }}</a></td>
                            <td>{{ $emp->RJ }}</td>
                            
                            <td>{{ $emp['pj'] }}</td>
                            <td>{{ $emp['rj'] }}</td>
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

            await html2canvas(table, {
                scale: 2,
                useCORS: true
            }).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgProps = doc.getImageProperties(imgData);
                const pdfWidth = doc.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

                doc.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                doc.save("وضعية أيام الراحة الكاملة.pdf");
            });
        }
    </script>
</body>

</html>
