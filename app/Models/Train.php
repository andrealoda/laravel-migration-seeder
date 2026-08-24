<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
   // $fillable serve per i mass assignment (es. Train::create(...)), $casts converte i campi nei tipi corretti.
    protected $fillable = [
        'Azienda',
        'Stazione_di_partenza',
        'Stazione_di_arrivo',
        'Data_partenza',
        'Orario_di_partenza',
        'Orario_di_arrivo',
        'Codice_Treno',
        'Numero_Carrozze',
        'In_orario',
        'Cancellato',
    ];

    protected $casts = [
        'In_orario' => 'boolean',
        'Cancellato' => 'boolean',
        'Data_partenza' => 'date',
    ];

}
