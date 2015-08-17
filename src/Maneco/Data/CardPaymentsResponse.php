<?php

namespace Maneco\Data;

use Maneco\Data\Response;

class CardPaymentsResponse extends Response
{

    public function __construct(array $params)
    {
        $params['card'] = isset($params['card']) ? new Response($params['card']) : null;
        $params['refunds'] = isset($params['refunds']) ? array_map(function ($rec) {
            return new Response($rec);
        }, $params['refunds']) : array();
        $params['fees'] = isset($params['fees']) ? array_map(function ($rec) {
            return new Response($rec);
        }, $params['fees']) : array();
        $this->attributes = $params;
    }
}
