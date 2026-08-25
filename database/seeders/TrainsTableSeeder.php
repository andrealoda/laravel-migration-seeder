<?php

namespace Database\Seeders;
use App\Models\Train;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newTrain = new Train();
        $newTrain->Azienda = 'Trenitalia';
        $newTrain->Stazione_di_partenza = 'Roma Termini';
        $newTrain->Stazione_di_arrivo = 'Milano Centrale';
        $newTrain->Data_di_partenza = '2026-08-27 08:00:00';
        $newTrain->Orario_di_partenza = '08:00:00';
        $newTrain->Orario_di_arrivo = '12:00:00';
        $newTrain->Codice_Treno = 'T123';
        $newTrain->Numero_Carrozze = 10;
        $newTrain->In_orario = true;
        $newTrain->Cancellato = false;
        $newTrain->save();
    }
}
