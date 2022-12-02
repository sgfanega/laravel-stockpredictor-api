<?php

namespace App\Traits;

trait HttpResponses 
{
    /**
     * A success message when a HTTP Request is successful
     * 
     * @param $data
     * @param String $message
     * @param Int $code
     * 
     * @return Response
     */
    protected function success($data, string $message = null, int $code = 200)
    {
        return response()->json([
            'status' => 'Request was successful.',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * A fail message when a HTTP Request fails
     *  
     * @param $data
     * @param String $message
     * @param Int $code
     * 
     * @return Response
     */
    protected function fail($data, string $message = null, int $code)
    {
        return response()->json([
            'status' => 'Request failed.',
            'message' => $message,
            'data' => $data
        ], $code);
    }
}