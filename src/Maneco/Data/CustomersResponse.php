<?php

namespace Maneco\Data;

class CustomersResponse extends Response
{

    public function __construct(array $params)
    {
        $params['card'] = isset($params['card']) ? new Response($params['card']) : null;
        $params['recursions'] = isset($params['recursions']) ? array_map(function ($rec) {
            return new RecursionsResponse($rec);
        }, $params['recursions']) : array();
        $this->attributes = $params;
    }
}
