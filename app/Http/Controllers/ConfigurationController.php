<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigurationController extends Controller
{

    //this is for the web route. send configurations list to view
    public function index()
    {
        $user = Auth::user();

        $configurations = Configuration::all();

        return view('configurations.index', [ 'user' => $user, 'configurations' => $configurations]);

    }
}
