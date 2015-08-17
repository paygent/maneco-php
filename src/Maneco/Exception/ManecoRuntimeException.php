<?php

namespace Maneco\Exception;

class ManecoRuntimeException extends ManecoException
{

    public static function connectionError($previous)
    {
        return new ManecoRuntimeException(ManecoException::CONNECTION_ERROR, $previous->getMessage(), $previous);
    }

    public static function jsonParseError($previous)
    {
        return new ManecoRuntimeException(ManecoException::JSON_ERROR, $previous->getMessage(), $previous);
    }

    public static function unknownError($previous)
    {
        return new ManecoRuntimeException(ManecoException::UNKNOWN_ERROR, $previous->getMessage(), $previous);
    }

    public function __toString()
    {
        return parent::__toString() . ", CAUSED BY : " . $this->message;
    }
}
