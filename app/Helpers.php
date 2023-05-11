<?php

if (!function_exists('baseJsonResponse')) {
    function baseJsonResponse(
        array|object|null $dataOrErrors,
        int $statusCode = 200,
        bool $isSuccess = true,
        string|null $message = null
    ) {
        $responseData = [
            'statusCode' => $statusCode,
            'isSuccess' => $isSuccess,

        ];

        $responseData[$isSuccess ? 'data' : 'errors'] = $dataOrErrors;

        if ($message) {
            $responseData['message'] = $message;
        }

        return response()->json($responseData, $statusCode);
    }
}
