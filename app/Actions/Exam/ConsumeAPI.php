<?php

namespace App\Actions\Exam;
use Illuminate\Support\Facades\Http;

class ConsumeAPI
{
    public static function execute()
    {
        $requestToken = Http::post('https://ios-api.devsquadstage.com/oauth/token', [ 
            'grant_type' => 'password',
            'client_id' => '3',
            'client_secret' => 'Fql3okYQbbzDtlmhBXdLE2eWy3OR9MR9x3n9NwqL',
            'username' => 'joe@doe.com',
            'password' => 'secret',
            'scope' => '*',
        ]);

       $accessToken = json_decode($requestToken->body())->access_token;

       $requestInfo = Http::withToken($accessToken)->get('https://ios-api.devsquadstage.com/api/me');

       $response = $requestInfo->json();

       return $response;
    }
}