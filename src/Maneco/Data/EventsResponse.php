<?php

namespace Maneco\Data;

class EventsResponse extends Response
{

    public function __construct($params)
    {
        if (isset($params['detail'])) {
            switch ($params['detail']['object']) {
                case 'card-payment':
                    $params['detail'] = new CardPaymentsResponse($params['detail']);
                    break;
                case 'customer':
                    $params['detail'] = new CustomersResponse($params['detail']);
                    break;
                case 'recursion':
                    $params['detail'] = new RecursionsResponse($params['detail']);
                    break;
                default:
                    $params['detail'] = new Response($params['detail']);
                    break;
            }
        }
        $this->attributes = $params;
    }
}
