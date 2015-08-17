<?php

namespace Maneco\Api;

use Maneco\Maneco;
use Maneco\Data\CustomersListResponse;
use Maneco\Data\CustomersResponse;

class Customers
{
    private $client;

    public function __construct(Maneco $client)
    {
        $this->client = $client;
    }

    public function __call($key, $value)
    {
        $accessors = array(
            'create', 'update', 'delete', 'get', 'all'
        );
        if (in_array($key, $accessors)) {
            $result = $this->client->request('customers.' . $key, $value && is_array($value) ? $value[0] : array());
            if ($key == 'all') {
                return new CustomersListResponse($result);
            } else {
                return new CustomersResponse($result);
            }
        }
        throw new \Exception('Method "' . $key . '" does not exist.');
    }
}
