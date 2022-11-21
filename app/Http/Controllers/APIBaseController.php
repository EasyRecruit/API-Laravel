<?php

namespace App\Http\Controllers;
use Symfony\Component\HttpFoundation\Response;



class APIBaseController extends Controller
{
    public function successResponse($message, $result=[], $code=Response::HTTP_OK)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, $code);
    }


    public function sendError($message, $errorMessages = [], $code = Response::HTTP_NOT_FOUND)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
