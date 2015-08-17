<?php

namespace Maneco\Data;

class PaymentsListResponse extends Response
{

    public function __construct(array $params)
    {
        $params['data'] = isset($params['data']) ? array_map(function ($rec) {
            return new CardPaymentsResponse($rec);
        }, $params['data']) : array();
        $this->attributes = $params;
    }
}
