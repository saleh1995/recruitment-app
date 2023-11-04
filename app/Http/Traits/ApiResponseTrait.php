<?php

namespace App\Http\Traits;

trait ApiResponseTrait
{
    public function apiResponse($data = null, $message = null, $status = 200)
    {
        $array = [
            'data'     => $data,
            'message'  => $message,
            'status'   => $status,
        ];
        return response($array, $status);
    }
}
