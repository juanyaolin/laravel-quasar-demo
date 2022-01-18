<?php

namespace App\Services;

use App\Exceptions\JsonEncodingException;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

class Response implements Arrayable, Jsonable, JsonSerializable
{
    /**
     * Determine if the response means success or failure.
     *
     * @var int $code
     */
    protected $code;

    /**
     * Description of the response.
     *
     * @var string $message
     */
    protected $message;

    /**
     * The data from the method when successful. Or, details of error when failed.
     *
     * @var mixed $data
     */
    protected $data;

    /**
     * Construct standard response.
     *
     * @param  int  $code
     * @param  string  $message
     * @param  mixed  $data
     */
    function __construct(int $code, string $message, $data)
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * Determine if the instance means failure.
     *
     * @return bool
     */
    public function fails()
    {
        return boolval($this->code);
    }

    /**
     * Convert the model instance to JSON.
     *
     * @param  int  $options
     * @return string
     *
     * @throws \App\Exceptions\JsonEncodingException
     */
    public function toJson($options = 0)
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw JsonEncodingException::forService($this, json_last_error_msg());
        }

        return $json;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * Convert the instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
}
