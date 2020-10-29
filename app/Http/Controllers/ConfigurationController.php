<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelpers;
use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configurations = Configuration::all();

        //Api helper class to send response
        $response = ApiHelpers::apiResponse(false, 200, 'records collected', $configurations);

        return response()->json($response, 200);
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
        $configuration = new Configuration();
        $configuration->json = $request->json;
        $configuration->mac_address = $request->mac_address;
        $configurationSaved = $configuration->save();

        //Check if the configuration is saved or not.
        if ($configurationSaved) {
            $response = ApiHelpers::apiResponse(false, 201, 'record saved successfully', null);
            return response()->json($response, 200);
        } else {
            $response = ApiHelpers::apiResponse(true, 400, 'record saving failed', null);
            return response()->json($response, 400);
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
        $configurations = Configuration::findOrFail($id);

        //Api helper class to send response
        $response = ApiHelpers::apiResponse(false, 200, 'record found', $configurations);

        return response()->json($response, 200);
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

        $configuration = Configuration::findOrFail($id);
        $configuration->json = $request->json;
        $configuration->mac_address = $request->mac_address;
        $configurationUpdated = $configuration->save();

        //Check if the configuration is updated or not.
        if ($configurationUpdated) {
            $response = ApiHelpers::apiResponse(false, 200, 'record updated successfully', null);
            return response()->json($response, 200);
        } else {
            $response = ApiHelpers::apiResponse(true, 400, 'record update failed', null);
            return response()->json($response, 400);
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
        $configuration = Configuration::findOrFail($id);
        $configurationDeleted = $configuration->delete();

        //Check if the configuration is deleted or not.
        if ($configurationDeleted) {
            $response = ApiHelpers::apiResponse(false, 200, 'record deleted successfully', null);
            return response()->json($response, 200);
        } else {
            $response = ApiHelpers::apiResponse(true, 400, 'record delete failed', null);
            return response()->json($response, 400);
        }
    }
}
