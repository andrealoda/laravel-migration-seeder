<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabellone Treni</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #0a0a0a;
            color: #f0c040;
            font-family: 'Share Tech Mono', monospace;
            padding: 40px 20px;
            min-height: 100vh;
        }

        .tabellone {
            max-width: 1200px;
            margin: 0 auto;
            border: 2px solid #f0c040;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 30px rgba(240, 192, 64, 0.2);
        }

        .tabellone-header {
            background-color: #1a1a1a;
            padding: 20px 30px;
            text-align: center;
            border-bottom: 2px solid #f0c040;
        }

        .tabellone-header h1 {
            font-size: 2rem;
            letter-spacing: 6px;
            text-transform: uppercase;
            color: #f0c040;
            text-shadow: 0 0 10px rgba(240, 192, 64, 0.5);
        }

        .tabellone-header .subtitle {
            font-size: 0.85rem;
            color: #888;
            margin-top: 5px;
            letter-spacing: 3px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background-color: #1a1a1a;
            color: #f0c040;
            padding: 14px 12px;
            text-align: left;
            font-size: 0.85rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            border-bottom: 2px solid #f0c040;
            white-space: nowrap;
        }

        tbody tr {
            border-bottom: 1px solid #222;
            transition: background-color 0.2s;
        }

        tbody tr:hover {
            background-color: #1a1a1a;
        }

        tbody td {
            padding: 14px 12px;
            font-size: 1rem;
            letter-spacing: 1px;
            white-space: nowrap;
        }

        .stato-in-orario {
            color: #33ff66;
            text-shadow: 0 0 8px rgba(51, 255, 102, 0.4);
        }

        .stato-in-ritardo {
            color: #ffcc00;
            text-shadow: 0 0 8px rgba(255, 204, 0, 0.4);
        }

        .stato-cancellato {
            color: #ff3333;
            text-shadow: 0 0 8px rgba(255, 51, 51, 0.4);
            text-decoration: line-through;
        }

        .percorso {
            color: #ffffff;
        }

        .freccia {
            color: #f0c040;
            margin: 0 6px;
        }

        .orario {
            font-size: 1.1rem;
            color: #ffffff;
        }

        .codice-treno {
            color: #50c8ff;
            text-shadow: 0 0 6px rgba(80, 200, 255, 0.3);
        }

        .tabellone-footer {
            background-color: #1a1a1a;
            padding: 12px 30px;
            text-align: right;
            border-top: 2px solid #f0c040;
            font-size: 0.75rem;
            color: #666;
            letter-spacing: 2px;
        }

        .no-trains {
            text-align: center;
            padding: 60px 20px;
            color: #666;
            font-size: 1.1rem;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
    <div class="tabellone">
        <div class="tabellone-header">
            <h1>Tabellone Treni</h1>
            <div class="subtitle">Departures</div>
        </div>

        @if($trains->isEmpty())
            <div class="no-trains">NESSUN TRENO IN PROGRAMMA</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Treno</th>
                        <th>Azienda</th>
                        <th>Percorso</th>
                        <th>Partenza</th>
                        <th>Arrivo</th>
                        <th>Carrozze</th>
                        <th>Stato</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($trains as $train)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($train->Data_di_partenza)->format('d/m') }}</td>
                            <td class="codice-treno">{{ $train->Codice_Treno }}</td>
                            <td>{{ $train->Azienda }}</td>
                            <td class="percorso">
                                {{ $train->Stazione_di_partenza }}
                                <span class="freccia">&#9654;</span>
                                {{ $train->Stazione_di_arrivo }}
                            </td>
                            <td class="orario">{{ \Carbon\Carbon::parse($train->Orario_di_partenza)->format('H:i') }}</td>
                            <td class="orario">{{ \Carbon\Carbon::parse($train->Orario_di_arrivo)->format('H:i') }}</td>
                            <td>{{ $train->Numero_Carrozze }}</td>
                            <td>
                                @if($train->Cancellato)
                                    <span class="stato-cancellato">CANCELLATO</span>
                                @elseif(!$train->In_orario)
                                    <span class="stato-in-ritardo">IN RITARDO</span>
                                @else
                                    <span class="stato-in-orario">IN ORARIO</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="tabellone-footer">
            ULTIMO AGGIORNAMENTO: {{ now()->format('d/m/Y H:i:s') }}
        </div>
    </div>
</body>
</html>
