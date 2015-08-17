<?php

namespace Maneco\Api;

use Maneco\Maneco;
use Maneco\Data\RecursionsListResponse;
use Maneco\Data\RecursionsResponse;

class Recursions
{
    private $client;

    public function __construct(Maneco $client)
    {
        $this->client = $client;
    }

    public function __call($key, $value)
    {
        $accessors = array(
            'create', 'resume', 'delete', 'get', 'all'
        );
        if (in_array($key, $accessors)) {
            $result = $this->client->request('recursions.' . $key, $value && is_array($value) ? $value[0] : array());
            if ($key == 'all') {
                return new RecursionsListResponse($result);
            } else {
                return new RecursionsResponse($result);
            }
        }
        throw new \Exception ('Method "' . $key . '" does not exist.');
    }
}
