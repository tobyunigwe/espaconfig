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




    public function authenticate()
    {

        $provider = new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId' => 'cd464722-011c-4371-9566-7662c5ca1e87',    // The client ID assigned to you by the provider
            'clientSecret' => 'hUlKc91n-5slnJ~t3HfKFiw1r3x_x~We.y',    // The client password assigned to you by the provider
            'redirectUri' => '127.0.0.1:8000',
            'urlAuthorize' => 'https://login.microsoftonline.com/25f2f5dc-0e4d-4c27-b5b4-ff4b5bf90d00/oauth2/v2.0/authorize',
            'urlAccessToken' => 'https://login.microsoftonline.com/25f2f5dc-0e4d-4c27-b5b4-ff4b5bf90d00/oauth2/v2.0/token',
            'urlResourceOwnerDetails' => '',
            'scopes' => '6b093944-8625-4f1a-b861-029380fb4424/.default'
        ]);

        try {

            // Try to get an access token using the client credentials grant.
            $accessToken = $provider->getToken();

        } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

            // Failed to get the access token
            exit($e->getMessage());
        }

        $auth = Http::withToken($accessToken);

        return $auth;
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
