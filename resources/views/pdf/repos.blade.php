<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تقرير الجدول</title>
    <style>
        @font-face {
            font-family: 'Amiri';
            src: url('{{ public_path('fonts/Amiri.ttf') }}') format('truetype');
        }

        body {
            font-family: 'Amiri';
            direction: rtl;
            text-align: right;
            margin: 0;
            padding: 0;
        }

        h3 {
            text-align: center;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
            direction: rtl;

        }

        th, td {
            border: 1px solid black;
            text-align: center;
            padding: 5px;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        @page {
            margin: 20px;
        }
    </style>
</head>
<body>
    <h3>تقرير أيام الراحةالعالقة يوم {{ Carbon\Carbon::now()->format('d-m-Y')}}</h3>
    <table>
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
                    <td>{{ $emp->username }}</td>
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
</body>
</html>
