<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigurationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //this is for the web route. send configurations list to view
    public function xml()
    {
        $user = Auth::user();

        $configurations = Configuration::all();

        return view('configurations.index', [ 'user' => $user, 'configurations' => $configurations]);

    }
}
