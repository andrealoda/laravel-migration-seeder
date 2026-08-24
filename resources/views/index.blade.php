<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>TRAINS TIMETABLE</h1>
    <ul>
        @foreach ($trains as $train)
            <li>
                <strong>{{ $train->Azienda }}</strong> - {{ $train->Stazione_di_partenza }} → {{ $train->Stazione_di_arrivo }}
                <br>
                Partenza: {{ $train->Orario_di_partenza }} - {{ $train->Data_partenza }} - Arrivo: {{ $train->Orario_di_arrivo }}
                <br>
                Treno: {{ $train->Codice_Treno }} - Carrozze: {{ $train->Numero_Carrozze }}
                <br>
                In orario: {{ $train->In_orario ? 'Sì' : 'No' }} - Cancellato: {{ $train->Cancellato ? 'Sì' : 'No' }}
            </li>
        @endforeach
    </ul>
</body>
</html>