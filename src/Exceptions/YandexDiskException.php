<?php

namespace Tigusigalpa\YandexDisk\Exceptions;

use Exception;

class YandexDiskException extends Exception
{
    protected $errorCode;
    protected $response;

    public function __construct(string $message = "", int $code = 0, $response = null)
    {
        parent::__construct($message, $code);
        $this->response = $response;
        $this->errorCode = $code;
    }

    public function getErrorCode(): int
    {
        return $this->errorCode;
    }

    public function getResponse()
    {
        return $this->response;
    }
}
