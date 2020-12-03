<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelpers;
use Illuminate\Support\Facades\Auth;
use Spatie\ArrayToXml\ArrayToXml;
use App\Models\Configuration;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

//    public function index()
//    {
//        $configurations = Configuration::all()->pluck('link', 'id');
//        $response = ApiHelpers::apiResponse(false, 200, '', $configurations);
//
//        return response()->json($response, 200);
//    }


    public function index(Configuration $configuration)
    {
        $data = collect($configuration->data)->map(function ($value) {
            if (is_array($value)) {
                return collect($value)->filter()->toArray();
            }

            return $value;
        })->filter()->toArray();

        $result = ArrayToXml::convert($data, 'config', true, 'UTF-8');

        return response($result)->header('Content-Type', 'text/xml');

    }


}
