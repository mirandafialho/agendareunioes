<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $client_http = new Client();

        try {
            $response = $client_http->post(config('services.passport.endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password
                ]
            ]);
            
            return $response->getBody();

        } catch (BadResponseException $e) {
            if ($e->getCode() === 400) {
                return response()->json(
                    'Requisição inválida. Por favor, coloque usuário e senha', 
                    $e->getCode()
                );
            } else if ($e->getCode() === 401) {
                return response()->json(
                    'Suas credenciais estão incorretas. Tente novamente.', 
                    $e->getCode()
                );
            }

            return response()->json(
                'Há algo de errado com o servidor. Tente novamente mais tarde.', 
                $e->getCode()
            );
        }
    }

    public function logout()
    {
        auth()->user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json('Logout realizado com sucesso.', 200);
    }
}
