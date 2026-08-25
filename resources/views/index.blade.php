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
            padding: 20px 10px;
        }

        .tabellone {
            max-width: 1400px;
            margin: 0 auto;
            border: 2px solid #f0c040;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 30px rgba(240, 192, 64, 0.2);
            background-color: #0f0f0f;
        }

        .tabellone-header {
            background-color: #1a1a1a;
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid #f0c040;
        }

        .tabellone-header h1 {
            font-size: 1.8rem;
            letter-spacing: 4px;
            text-transform: uppercase;
            color: #f0c040;
            text-shadow: 0 0 8px rgba(240, 192, 64, 0.4);
        }

        .tabellone-header .subtitle {
            font-size: 0.9rem;
            color: #aaa;
            margin-top: 4px;
            letter-spacing: 2px;
        }

        /* Responsive Grid Layout */
        .table-container {
            display: flex;
            flex-direction: column;
        }

        .header-row,
        .data-row {
            display: grid;
            grid-template-columns: 
                repeat(8, minmax(100px, 1fr)); /* 8 columns, min 100px */
            gap: 10px;
            padding: 12px;
            border-bottom: 1px solid #222;
            min-width: 700px;
        }

        .header-row {
            background-color: #1a1a1a;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #f0c040;
            border-bottom: 2px solid #f0c040;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .header-cell {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .data-cell {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            font-size: 0.9rem;
        }

        /* Column-specific styling */
        .col-data { flex: 0 0 12%; }     /* Smaller */
        .col-treno { flex: 0 0 15%; }   /* Bigger (train code) */
        .col-azienda { flex: 0 0 12%; }
        .col-percorso { flex: 1; }     /* Grows to fill space (route is important) */
        .col-partenza { flex: 0 0 10%; }
        .col-arrivo { flex: 0 0 10%; }
        .col-carrozze { flex: 0 0 8%; }
        .col-stato { flex: 0 0 12%; text-align: right; }

        /* Desktop adjustments */
        @media (min-width: 769px) {
            .header-row,
            .data-row {
                padding: 14px 16px;
            }

            .header-cell {
                font-size: 0.85rem;
                letter-spacing: 2px;
            }

            .data-cell {
                font-size: 1rem;
            }
        }

        /* Mobile Card Layout (below 768px) */
        @media (max-width: 768px) {
            .table-container {
                padding: 10px;
            }

            .header-row {
                display: none;
            }

            .data-row {
                display: flex;
                flex-direction: column;
                border: 1px solid #333;
                border-radius: 6px;
                margin-bottom: 16px;
                background-color: #0f0f0f;
                padding: 12px;
                min-width: auto;
            }

            .data-cell {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                padding: 6px 0;
                border-bottom: 1px solid #222;
                line-height: 1.5;
            }

            .data-cell:last-child {
                border-bottom: none;
            }

            .data-cell::before {
                content: attr(data-label);
                font-weight: bold;
                color: #50c8ff;
                font-size: 0.75rem;
                margin-bottom: 2px;
            }

            .data-cell .codice-treno,
            .data-cell .orario,
            .data-cell .stato-in-orario,
            .data-cell .stato-in-ritardo,
            .data-cell .stato-cancellato {
                margin-top: 2px;
            }

            /* Special handling for percorso */
            .data-cell[data-label="Percorso"] {
                border: none;
                margin-bottom: 8px;
                padding-bottom: 6px;
            }
        }

        /* Colors */
        .stato-in-orario { color: #33ff66; text-shadow: 0 0 6px rgba(51, 255, 102, 0.4); }
        .stato-in-ritardo { color: #ffcc00; text-shadow: 0 0 6px rgba(255, 204, 0, 0.4); }
        .stato-cancellato { color: #ff3333; text-shadow: 0 0 6px rgba(255, 51, 51, 0.4); text-decoration: line-through; }
        .percorso { color: #ffffff; }
        .codice-treno { color: #50c8ff; text-shadow: 0 0 6px rgba(80, 200, 255, 0.3); }
        .orario { font-weight: bold; color: #ffffff; }
        .freccia { color: #f0c040; margin: 0 4px; }

        .tabellone-footer {
            background-color: #1a1a1a;
            padding: 12px 20px;
            text-align: right;
            border-top: 2px solid #f0c040;
            font-size: 0.75rem;
            color: #666;
            letter-spacing: 2px;
        }

        .no-trains {
            text-align: center;
            padding: 40px 20px;
            color: #666;
            font-size: 1rem;
            letter-spacing: 2px;
        }
    </style>
</head>
<body>
    <div class="tabellone">
        <div class="tabellone-header">
            <h1>Tabellone Treni</h1>
            <div class="subtitle">Partenze</div>
        </div>

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
                        <div class="data-cell col-data" data-label="Data">
                            {{ \Carbon\Carbon::parse($train->Data_di_partenza)->format('d/m/Y') }}
                        </div>
                        <div class="data-cell col-treno codice-treno" data-label="Treno">
                            {{ $train->Codice_Treno }}
                        </div>
                        <div class="data-cell col-azienda" data-label="Azienda">
                            {{ $train->Azienda }}
                        </div>
                        <div class="data-cell col-percorso percorso" data-label="Percorso">
                            {{ $train->Stazione_di_partenza }}
                            <span class="freccia">&#9654;</span>
                            {{ $train->Stazione_di_arrivo }}
                        </div>
                        <div class="data-cell col-partenza orario" data-label="Partenza">
                            {{ \Carbon\Carbon::parse($train->Orario_di_partenza)->format('H:i') }}
                        </div>
                        <div class="data-cell col-arrivo orario" data-label="Arrivo">
                            {{ \Carbon\Carbon::parse($train->Orario_di_arrivo)->format('H:i') }}
                        </div>
                        <div class="data-cell col-carrozze" data-label="Carrozze">
                            {{ $train->Numero_Carrozze }}
                        </div>
                        <div class="data-cell col-stato" data-label="Stato">
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

        <div class="tabellone-footer">
            ULTIMO AGGIORNAMENTO: {{ now()->format('d/m/Y H:i:s') }}
        </div>
    </div>
</body>
</html>
