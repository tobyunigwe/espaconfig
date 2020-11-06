<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelpers;
use App\Http\Resources\ConfigurationResource;
use Spatie\ArrayToXml\ArrayToXml;
use App\Models\Configuration;
use Illuminate\Http\Request;
use SimpleXMLElement;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configurations = Configuration::all()->pluck('link', 'mac_address');
        $response = ApiHelpers::apiResponse(false, 200, '', $configurations);

        return response()->json($response, 200);
    }

    //this is for the web route. send configuration to view
    public function xml()
    {
        $configurations = Configuration::all();

        return view('xml', compact('configurations'));

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $configuration = new Configuration();
        $configuration->data = json_decode($request->data);
        $configuration->mac_address = $request->mac_address;
        $configurationSaved = $configuration->save();
        if ($configurationSaved) {
            $response = ApiHelpers::apiResponse(false, 201, 'record saved successfully', null);
            return response()->json($response, 201);
        } else {
            $response = ApiHelpers::apiResponse(true, 400, 'record saving failed', null);
            return response()->json($response, 400);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function show(Configuration $configuration)
    {
        $result = ArrayToXml::convert(
            $configuration->jsonSerialize(), // convert collection to array
            'configuration', // root element name
            true, // replace spaces by underscore in element's names
            'UTF-8' // encoding
        );

        return response()->make($result, 200, ['Content-Type' => 'text/xml']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $configuration = Configuration::findOrFail($id);
        $configuration->data = json_decode($request->data);
        $configuration->mac_address = $request->mac_address;
        $configurationUpdated = $configuration->save();
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $configuration = Configuration::findOrFail($id);
        $configurationDeleted = $configuration->delete();

        if ($configurationDeleted) {
            $response = ApiHelpers::apiResponse(false, 200, 'record deleted successfully', null);
            return response()->json($response, 200);
        } else {
            $response = ApiHelpers::apiResponse(true, 400, 'record delete failed', null);
            return response()->json($response, 400);
        }
    }
}
