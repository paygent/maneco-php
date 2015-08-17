<?php

namespace Maneco\Exception;

use Maneco\Data\ErrorResponse;

class ManecoResponseException extends ManecoException
{
    private $status;
    private $error;

    public function __construct($errorCode, $message, $status, ErrorResponse $error)
    {
        parent::__construct($errorCode, $message);
        $this->status = $status;
        $this->error = $error;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getError()
    {
        return $this->error;
    }

    public function __toString()
    {
        return parent::__toString() . ", HTTP STATUS : " . $this->status . " , DETAIL : " . $this->error;
    }
}
