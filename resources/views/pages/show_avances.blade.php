<!-- resources/views/pages/show_avances.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        /* resources/css/show_avances.css */


.table-container {
    overflow-x: auto;
}

.table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
}

th, td {
    padding: 12px 15px;
    text-align: center;
    border: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
    color: #333;
    text-transform: uppercase;
}

tr:hover {
    background-color: #f5f5f5;
}

tbody tr:last-child {
    border-bottom: none;
}


p {
    margin-bottom: 10px;
}
/* resources/css/show_avances.css */

.container {
    margin-top: 20px;
    font-family: Arial, sans-serif;
}

h1 {
    text-align: center;
}

.date-header {
    text-align: center;
    margin-bottom: 20px;
}

.filter-section {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    display: inline-block;
    margin-right: 10px;
}

.custom-select {
    padding: 8px 15px;
    font-size: 16px;
}

.btn {
    padding: 8px 20px;
    font-size: 16px;
}


    </style>
</head>
<body>
    
<div class="container">
    @php
            $months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"];
            $month = $months[$date_month - 1];
            $year = $date_year;
            $empty = true;
    @endphp
     <h1>Employee Avance</h1>
     <h3 class="date-header">Date: {{ $month . ' ' . $year }}</h3>
     <div class="filter-section">
         <form action="{{ route('show_avances') }}" method="get">
             <div class="form-group">
                 <select name="month" class="custom-select">
                     @foreach ($months as $index => $monthName)
                         <option value="{{ $index + 1 }}" {{ $date_month == $index + 1 ? 'selected' : '' }}>
                             {{ $monthName }}
                         </option>
                     @endforeach
                 </select>
             </div>
             <div class="form-group">
                 <select name="year" class="custom-select">
                     @for ($i = 2024; $i < 2030; $i++)
                         <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>
                             {{ $i }}
                         </option>
                     @endfor
                 </select>
             </div>
             <button type="submit" class="btn btn-primary">Search</button>
         </form>
     </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Avance (DA)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalAvance = 0;
                @endphp
                @foreach ($employeesWithAvances as $avance)
                @php
                    $totalAvance += $avance->avance;
                @endphp
                @if ($empty)
                    @php
                    $empty = false;
                    @endphp
                @endif
                <tr>
                    <td>{{ $avance->users->username }}</td>
                    <td>{{ $avance->avance }} </td>
                </tr>
                @endforeach
                <tr>
                    <td>Total</td>
                    <td>{{ $totalAvance }} </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
<div style="display: ruby-text; text-align: center">
    @if (!$empty)
        <div >
    <form action="{{route('exportDataAvance')}}" method="POST">
        @csrf
    <input type="hidden" id="month" name="month" value="{{$date_month}}"/>
    <input type="hidden" id="year" name="year" value="{{$date_year}}"/>
    <button type="submit"  class="btn btn-primary mb-2">Export Excel</button>
    </form>
    </div>
    @endif
    
    <div >
            <a href="/"> <button type="button" class="btn btn-primary mb-2"> Retour</button></a>

    </div>
</div>
</div>
</body>
</html>
