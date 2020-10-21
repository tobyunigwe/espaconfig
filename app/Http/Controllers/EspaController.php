<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConfigResource;
use App\Http\Resources\EspaResource;
use App\Models\Config;
use App\Models\Espa;
use App\Models\Rule;
use Illuminate\Http\Request;

class EspaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        //get Configs
//        $espas = Espa::all();
//
//        //return collection of configs as a resource
//        return ConfigResource::collection($espas);

        $espas = Espa::with(['rule'])->paginate(50);
        return EspaResource::collection($espas);
//        return Espa::with('rule')->get();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $espa = new Espa ();
        $espa->enabled = $request->enabled;
        if ($espa->save()) {
            return new EspaResource($espa);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //get espa
        $espa = Espa::with(['rule'])->findorfail($id);
        //return a single espa as a resource
        return new EspaResource($espa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $espa = Espa::with(['rule'])->findorfail($id);
        $espa->enabled = $request->enabled;
        if ($espa->save()) {
            return new EspaResource($espa);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //get config
        $espa = Espa::with(['rule'])->findorfail($id);

        if ($espa->delete()) {
            return new EspaResource($espa);
        }
    }
}
