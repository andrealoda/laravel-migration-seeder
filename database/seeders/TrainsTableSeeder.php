<?php

namespace Database\Seeders;
use App\Models\Train;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class TrainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void

    {
    for($i=0; $i<100; $i++) {
    $newTrain = new Train();
    $newTrain->Azienda = $faker->company();
    $newTrain->Stazione_di_partenza = $faker->city();
    $newTrain->Stazione_di_arrivo = $faker->city();
    $newTrain->Data_di_partenza = $faker->date();
    $newTrain->Orario_di_partenza = $faker->time();
    $newTrain->Orario_di_arrivo = $faker->time();
    $newTrain->Codice_Treno = $faker->bothify('??###');
    $newTrain->Numero_Carrozze = $faker->numberBetween(1, 20);
    $newTrain->In_orario = $faker->boolean();
    $newTrain->Cancellato = $faker->boolean();
    $newTrain->save();
        }
    }
}
