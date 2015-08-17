<?php

namespace Maneco\Api;

use Maneco\Maneco;
use Maneco\Data\CardPaymentsResponse;

class CardPayments
{
    private $client;

    public function __construct(Maneco $client)
    {
        $this->client = $client;
    }

    public function __call($key, $value)
    {
        $accessors = array(
            'create', 'capture', 'refund'
        );
        if (in_array($key, $accessors)) {
            $result = $this->client->request('cardPayments.' . $key, $value && is_array($value) ? $value[0] : array());
            return new CardPaymentsResponse($result);
        }
        throw new \Exception('Method "' . $key . '" does not exist.');
    }
}
