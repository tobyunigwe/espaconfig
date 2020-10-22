<?php

namespace App\Http\Controllers;

use App\Models\Espa;
use Illuminate\Http\Request;

class EspaController extends Controller
{
    public function index()
    {
        return Espa::with(['rules', 'receivers', 'generals', ])->get();
    }

    public function show($id)
    {
        return Espa::where('config_id', $id)->with(['rules', 'receivers', 'generals', ])->get();
    }
}
