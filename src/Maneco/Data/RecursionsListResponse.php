<?php

namespace Maneco\Data;

class RecursionsListResponse extends Response
{

    public function __construct(array $params)
    {
        $params['data'] = isset($params['data']) ? array_map(function ($rec) {
            return new RecursionsResponse($rec);
        }, $params['data']) : array();
        $this->attributes = $params;
    }
}
