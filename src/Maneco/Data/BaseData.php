<?php

namespace Maneco\Data;

use Maneco\Util;

class BaseData
{
    protected $attributes;

    public function __construct(array $params)
    {
        $this->attributes = $params;
    }

    public function __get($key)
    {
        if (array_key_exists($key, $this->attributes)) {
            $value = $this->attributes[$key];
            $value = is_string($value) ? mb_convert_encoding($value, mb_internal_encoding(), "auto") : $value;
            return $value;
        }
        throw new \Exception('Undefined variable ' . $key);
    }

    public function __toString()
    {
        $recursive = function ($var) use (&$recursive) {
            $results = array();
            foreach ($var as $key => $value) {
                if (is_array($value) && !$this->is_hash($value)) {
                    $results[$key] = $recursive($value);
                } elseif ($value instanceof BaseData) {
                    $results[$key] = $recursive($value->attributes);
                } else {
                    $results[$key] = $value;
                }
            }
            return $results;
        };
        $obj = $recursive($this->attributes);
        $obj = json_encode($obj, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $obj = mb_convert_encoding($obj, mb_internal_encoding(), "auto");
        return $obj;
    }

    private static function is_hash(&$array)
    {
        $i = 0;
        foreach ($array as $k => $dummy) {
            if ($k !== $i++) {
                return true;
            }
        }
        return false;
    }
}
