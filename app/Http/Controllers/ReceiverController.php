<?php

namespace App\Http\Controllers;

use App\Models\Receiver;
use Illuminate\Http\Request;

class ReceiverController extends Controller
{
    public function index()
    {
        return Receiver::with(['loggings', 'heartbeats', 'mains', 'communications'])->get();
    }

    public function show($id)
    {
        return Receiver::where('espa_id', $id)->with(['loggings', 'heartbeats', 'mains', 'communications'])->get();
    }
}
