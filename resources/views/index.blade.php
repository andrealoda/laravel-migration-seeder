<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabellone Treni</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body>
    <div class="tabellone">

        @include('partials.header')

        <div class="table-container">
            @if($trains->isEmpty())
            <div class="no-trains">NESSUN TRENO IN PROGRAMMA</div>
            @else
            <div class="header-row">
                <div class="header-cell">Data</div>
                <div class="header-cell">Treno</div>
                <div class="header-cell">Azienda</div>
                <div class="header-cell">Percorso</div>
                <div class="header-cell">Partenza</div>
                <div class="header-cell">Arrivo</div>
                <div class="header-cell">Carrozze</div>
                <div class="header-cell">Stato</div>
            </div>

            @foreach ($trains as $train)
            <div class="data-row">
                <div class="data-cell">
                    {{ \Carbon\Carbon::parse($train->Data_di_partenza)->format('d/m/Y') }}
                </div>
                <div class="data-cell codice-treno">
                    {{ $train->Codice_Treno }}
                </div>
                <div class="data-cell">
                    {{ $train->Azienda }}
                </div>
                <div class="data-cell percorso">
                    {{ $train->Stazione_di_partenza }}
                    <span class="freccia">&#9654;</span>
                    {{ $train->Stazione_di_arrivo }}
                </div>
                <div class="data-cell orario">
                    {{ \Carbon\Carbon::parse($train->Orario_di_partenza)->format('H:i') }}
                </div>
                <div class="data-cell orario">
                    {{ \Carbon\Carbon::parse($train->Orario_di_arrivo)->format('H:i') }}
                </div>
                <div class="data-cell">
                    {{ $train->Numero_Carrozze }}
                </div>
                <div class="data-cell" style="justify-content: flex-start;">
                    @if($train->Cancellato)
                    <span class="stato-cancellato">CANCELLATO</span>
                    @elseif(!$train->In_orario)
                    <span class="stato-in-ritardo">IN RITARDO</span>
                    @else
                    <span class="stato-in-orario">IN ORARIO</span>
                    @endif
                </div>
            </div>
            @endforeach

            @endif
        </div>

        @include('partials.footer')

    </div>
</body>

</html>