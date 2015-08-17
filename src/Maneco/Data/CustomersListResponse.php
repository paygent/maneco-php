<?php

namespace Maneco\Data;

use Maneco\Data\Response;

class CustomersListResponse extends Response
{

    public function __construct(array $params)
    {

        $params['data'] = isset($params['data']) ? array_map(function ($rec) {
            return new CustomersResponse($rec);
        }, $params['data']) : array();
        $this->attributes = $params;
    }
}
