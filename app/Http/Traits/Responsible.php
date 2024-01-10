<?php


namespace App\Http\Traits;


use Illuminate\Http\JsonResponse;

trait Responsible
{
    /**
     * @param $message
     * @param  null  $data
     * @param  int  $http_code
     *
     * @return JsonResponse
     */
    public function success($message, $data = null, $http_code = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'success' => true
        ], $http_code);
    }

    /**
     * @param $message
     * @param $http_code
     * @param null $data
     * @return JsonResponse
     */
    public function error($message, $http_code, $data = null): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
            'success' => false,
        ], $http_code);
    }
}
