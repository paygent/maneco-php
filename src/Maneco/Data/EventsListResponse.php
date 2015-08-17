<?php

namespace Maneco\Data;

class EventsListResponse extends Response
{

    public function __construct(array $params)
    {
        $params['data'] = isset($params['data']) ? array_map(function ($rec) {
            return new EventsResponse($rec);
        }, $params['data']) : array();
        $this->attributes = $params;
    }
}
