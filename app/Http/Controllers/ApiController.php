<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\GenericProvider;
use Spatie\ArrayToXml\ArrayToXml;
use App\Models\Configuration;
use Illuminate\Http\Request;
use TheNetworg\OAuth2\Client\Provider\Azure;

/**
 * Class ApiController
 * @package App\Http\Controllers
 */
class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Client\PendingRequest
     */
    /**
     * Handler for the incoming request from the Configuration Server.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */

    public function handleIncomingRequest(Request $request)
    {
        //GET IP adress (as identifier) from API call
        $ipAdress = $request->input('identifier');

        //GET configuration from VS and parse to json
        $unconverted = $this->authenticate()
            ->get("https://configuration.picasse.io/Identifier/Configuration/espasdr/" . $ipAdress . "?content=true")
            ->json();

        //Return failure message
        if (!$unconverted) {
            $response = ApiHelpers::apiResponse(true, 400, 'Receiving configuration from Configuration Server failed (not found)', null);
            return response()->json($response, 400);
        } else {

            //convert to XML when found
            $configuration = $this->convertToXml($unconverted);
//            $response = ApiHelpers::apiResponse(false, 200, 'Successfully received configuration from Configuration Server', $configuration);
//            return response()->json($response, 200);

            //call method to connect to MC with SSH
            app('App\Http\Controllers\SshController')->connection($ipAdress);

            return $configuration;
        }
    }


    /**
     * authenticator method to receive a bearer token from Azure OAuth2.0
     *
     * @return \Illuminate\Http\Client\PendingRequest
     */
    public function authenticate()
    {
        $provider = new Azure([
            'clientId' => env('AZURE_CLIENT_ID'),
            'clientSecret' => env('AZURE_CLIENT_SECRET'),
            'tenant' => env('AZURE_TENANT'),
            'urlAuthorize' => env('AZURE_URL_AUTHORIZE'),
            'urlAccessToken' => env('AZURE_ACCESS_TOKEN'),
            'defaultEndPointVersion' => Azure::ENDPOINT_VERSION_2_0
        ]);


        try {

            // Try to get an access token using the client credentials grant.
            $accessToken = $provider->getAccessToken('client_credentials', ['scope' => '6b093944-8625-4f1a-b861-029380fb4424/.default'])->getToken();

        } catch (IdentityProviderException $e) {

            // If it fails
            exit($e->getMessage());
        }

        $auth = Http::withToken($accessToken);

        return $auth;
    }


    /**
     * Converter method to convert the data from the Configuration server to XML.
     *
     * @param $unconverted
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function convertToXml($unconverted)
    {
        //convert the json data to xml
        $configuration = collect($unconverted)->map(function ($value) {
            if (is_array($value)) {
                return collect($value)->filter()->toArray();
            }

            return $value;
        })->filter()->toArray();

        $result = ArrayToXml::convert($configuration, 'config', true, 'UTF-8');

        //opening source file, replacing it with $result
        $file = fopen(env('SSH_SOURCE_FILE'), 'w+');
        fwrite($file, $result);
        fclose($file);


        return response($result)->header('Content-Type', 'text/xml');

    }

    public function status(Request $request)
    {

        $ipAdress = $request->input('identifier');

        //get the form params
        $status = $request->get('status');
        $information = $request->get('information');
        $dateTime = $request->get('dateTime');

        $res = $this->authenticate()->asForm()->post( 'https://configuration.picasse.io/status/espasdr/'. $ipAdress, [
            'status' => $status,
            'information' => $information,
            'dateTime' => $dateTime
        ]);
        if ($res) {
            $response = ApiHelpers::apiResponse(false, 201, 'status saved successfully', null);
            return response()->json($response, 201);
        } else {
            $response = ApiHelpers::apiResponse(true, 400, 'status saving failed', null);
            return response()->json($response, 400);
        }

    }
}
