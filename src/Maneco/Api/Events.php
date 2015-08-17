<?php

namespace Maneco\Api;

use Maneco\Maneco;
use Maneco\Data\EventsListResponse;
use Maneco\Data\EventsResponse;

class Events
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
            $result = $this->client->request('events.' . $key, $value && is_array($value) ? $value[0] : array());
            if ($key == 'all') {
                return new EventsListResponse($result);
            } else {
                return new EventsResponse($result);
            }
        }
        throw new \Exception ('Method "' . $key . '" does not exist.');
    }
}
