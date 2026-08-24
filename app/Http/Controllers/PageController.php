<?php

namespace App\Http\Controllers;

use App\Models\Train;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()

    {

    $trains = Train::where('Data_di_partenza', '>=', now())
    ->orderBy('Data_di_partenza', 'asc')
    ->orderBy('Orario_di_partenza', 'asc')
    ->get();


        return view('index', compact('trains'));
    }
}
