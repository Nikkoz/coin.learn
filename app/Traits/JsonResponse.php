<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse as HttpJsonResponse;

trait JsonResponse
{
    /**
     * Отправка положительного ответа  в формате json.
     *
     * @param string $message
     * @param array  $data
     *
     * @return HttpJsonResponse
     */
    protected function sendOk(string $message, array $data = null): HttpJsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ]);
    }

    /**
     * Отправка отрицательного ответа в формате json.
     *
     * @param string $message
     * @param array  $data
     *
     * @return HttpJsonResponse
     */
    protected function sendError(string $message, array $data = []): HttpJsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => $data,
        ]);
    }
}