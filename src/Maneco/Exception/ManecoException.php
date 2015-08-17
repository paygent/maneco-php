<?php

namespace Maneco\Exception;

class ManecoException extends \Exception
{
    const CONNECTION_ERROR = "ME0001";
    const JSON_ERROR = "ME0002";
    const UNKNOWN_ERROR = "ME0003";
    protected $errorCode;

    public function __construct($errorCode, $message, \Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->errorCode = $errorCode;
    }

    public function getErrorCode()
    {
        return $this->errorCode;
    }

    public function __toString()
    {
        return get_class($this) . ", ERROR CODE : " . $this->errorCode;
    }
}
