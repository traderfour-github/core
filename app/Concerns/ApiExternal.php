<?php

namespace App\Concerns;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

trait ApiExternal
{
    protected function getRespondApiExternal(?string $url = null) : JsonResponse
    {
        $response = Http::get($url);

        if($response->ok()){
            return response()->json([
                'succeed'  => $response->successful(),
                'results'  => $response->json(),
            ] , $response->status());
        }elseif ($response->badRequest()){
            return response()->json([
                'succeed'  => $response->serverError(),
                'results'  => [],
            ] , $response->status());
        }
    }

    protected function postRespondApiExternal(?string $url = null , array $data = []) : JsonResponse
    {
        $response = Http::post( $url , $data);

        if($response->ok()){
            return response()->json([
                'succeed'  => $response->successful(),
                'results'  => $response->json(),
            ] , $response->status());
        }elseif ($response->badRequest()){
            return response()->json([
                'succeed'  => $response->serverError(),
                'results'  => [],
            ] , $response->status());
        }
    }
}
