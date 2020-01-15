<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait JsonResponsible
{
    /**
     * Отправка положительного ответа  в формате json.
     *
     * @param string $message
     * @param array  $data
     *
     * @return JsonResponse
     */
    protected function sendOk(string $message, array $data = null): JsonResponse
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
     * @return JsonResponse
     */
    protected function sendError(string $message, array $data = []): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => $data,
        ]);
    }
}