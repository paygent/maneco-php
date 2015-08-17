<?php

namespace Maneco\Api;

use Maneco\Maneco;
use Maneco\Data\CardPaymentsResponse;
use Maneco\Data\PaymentsListResponse;

class Payments
{
    private $client;

    public function __construct(Maneco $client)
    {
        $this->client = $client;
    }

    public function __call($key, $value)
    {
        $accessors = array(
            'get', 'all'
        );
        if (in_array($key, $accessors)) {
            $result = $this->client->request('payments.' . $key, $value && is_array($value) ? $value[0] : array());
            if ($key == 'all') {
                return new PaymentsListResponse($result);
            } else {
                return new CardPaymentsResponse($result);
            }
        }
        throw new \Exception ('Method "' . $key . '" does not exist.');
    }
}
