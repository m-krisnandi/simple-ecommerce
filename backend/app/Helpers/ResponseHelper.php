<?php

namespace App\Helpers;

class ResponseHelper
{
    const INTERNAL_SERVER_ERROR_MESSAGE = 'Internal server error';
    const DATA_NOT_FOUND_MESSAGE = 'Data not found';

    public static function successResponse($data, $message, $code)
    {
        return [
            'success' => true,
            'data' => $data,
            'message' => $message,
            'code' => $code,
        ];
    }

    public static function errorResponse($message, $code)
    {
        return [
            'success' => false,
            'message' => 'Error: ' . $message,
            'code' => $code,
        ];
    }
}
