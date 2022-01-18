<?php

use App\Services\Response;

if (! function_exists('api_response')) {
    /**
     * Return a new JSON response from the application.
     *
     * @param  mixed  $data
     * @param  int  $status
     * @param  array  $headers
     * @param  int  $options
     * @return \Illuminate\Http\JsonResponse
     */
    function api_response($data = '', $status = 200, array $headers = [])
    {
        return response()
            ->json(
                $data,
                $status,
                $headers,
                JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE
            );
    }
}

if (! function_exists('success')) {
    /**
     * Create Success standard response instance.
     *
     * @param  mixed  $data
     * @param  string  $message
     * @return \App\Services\Response
     */
    function success($data = '', string $message = 'success')
    {
        return new Response(0, $message, $data);
    }
}

if (! function_exists('failure')) {
    /**
     * Create Failure standard response instance.
     *
     * @param  string  $message
     * @param  int  $code
     * @param  mixed  $data
     * @return \App\Services\Response
     */
    function failure($message = 'failure', int $code = 1, $data = '')
    {
        return new Response($code, $message, $data);
    }
}
