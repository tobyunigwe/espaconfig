<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Spatie\ArrayToXml\ArrayToXml;
use App\Models\Configuration;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Client\PendingRequest
     */

//    public function index()
//    {
//        $configurations = Configuration::all()->pluck('link', 'id');
//        $response = ApiHelpers::apiResponse(false, 200, '', $configurations);
//
//        return response()->json($response, 200);
//    }


    public function authenticate()
    {
        //declaring auth variables
        $username = env('API_USERNAME');
        $password = env('API_PASSWORD');

        $auth = Http::withBasicAuth($username, $password);
        return $auth;
    }

    public function handleIncomingRequest(Request $request)
    {
        //GET IP adress (as identifier) from API call
        $ipAdress = $request->input('identifier');

        //GET configuration from VS and parse to json
        $configuration = $this->authenticate()
            ->get("https://configuration.picasse.io/Identifier/Configuration?route=espasdr&identifier=" . $ipAdress . "&content=true")
            ->json();

        //convert the json data to xml
        $data = collect($configuration)->map(function ($value) {
            if (is_array($value)) {
                return collect($value)->filter()->toArray();
            }

            return $value;
        })->filter()->toArray();

        $result = ArrayToXml::convert($data, 'config', true, 'UTF-8');

        //opening source file, replacing it with $result
        $file = fopen(env('SSH_SOURCE_FILE'), 'w+');
        fwrite($file, $result);
        fclose($file);

        //call method to connect to MC with SSH
        app('App\Http\Controllers\SshController')->connection($ipAdress);

        return response($result)->header('Content-Type', 'text/xml');

    }


    public function index()
    {
        $configurations = $this->authenticate()
            ->get("https://configuration.picasse.io/devices/espasdr?subTree=true")
            ->json();

        dump($configurations);

        return view('api.index', ['configurations' => $configurations]);
    }

    public function show($id)
    {
        $json = $this->authenticate()->get('https://configuration.picasse.io/Identifier/Configuration?route=espasdr&identifier=' . $id . '&content=true')->json();

        $data = collect($json)->map(function ($value) {
            if (is_array($value)) {
                return collect($value)->filter()->toArray();
            }

            return $value;
        })->filter()->toArray();

        $result = ArrayToXml::convert($data, 'config', true, 'UTF-8');

        return response($result)->header('Content-Type', 'text/xml');

    }
}
