<?php

namespace App\Exceptions;

use Exception;

class JsonEncodingException extends Exception
{
    /**
     * Create a new JSON encoding exception for the service.
     *
     * @param  mixed  $service
     * @param  string  $message
     * @return static
     */
    public static function forService($service, $message)
    {
        return new static('Error encoding instance of service ['.get_class($service).'] to JSON: '.$message);
    }
}
