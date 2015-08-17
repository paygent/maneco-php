<?php

namespace Maneco;

use Guzzle\Common\Event as HttpEvent;
use Guzzle\Service\Client as HttpClient;
use Guzzle\Service\Description\ServiceDescription;
use Maneco\Api\CardPayments;
use Maneco\Api\Customers;
use Maneco\Api\Events;
use Maneco\Api\Payments;
use Maneco\Api\Recursions;
use Maneco\Data\ErrorResponse;
use Maneco\Data\Response;
use Maneco\Exception\ManecoResponseException;
use Maneco\Exception\ManecoRuntimeException;

class Maneco
{
    const METHOD_POST = 'post';
    private $client;
    private $cardPayments;
    private $customers;
    private $events;
    private $payments;
    private $recursions;
    private $timeout = 35;

    public function __construct($apiKey, $options = array())
    {
        $this->client = new HttpClient();
        $this->client->setDefaultOption('headers/Authorization', 'Basic ' . base64_encode($apiKey));
        $this->client->setDescription(ServiceDescription::factory(__DIR__ . "/Resources/description.json"));
        $userAgent = "maneco-connectmodule-php/" . $this->client->getDescription()->getApiVersion();
        $this->client->setUserAgent(
            isset($options['user_agent']) ? $userAgent . "({$options['user_agent']})" : $userAgent, true);
        $this->client->getEventDispatcher()->addListener('request.error', array(
            $this, 'handleException'
        ));
        $this->client->getEventDispatcher()->addListener('request.exception', array(
            $this, 'handleException'
        ));
        $this->cardPayments = new CardPayments($this);
        $this->customers = new Customers($this);
        $this->events = new Events($this);
        $this->payments = new Payments($this);
        $this->recursions = new Recursions($this);
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    public function request($operation, $params)
    {
        $params += array(
            'command.request_options' => array(
                'timeout' => $this->timeout,
                'connect_timeout' => $this->timeout
            )
        );
        $command = $this->client->getCommand($operation, $params);
        try {
            $response = $command->getResponse();
            return $response->json();
        } catch (\Guzzle\Common\Exception\RuntimeException $e) {
            throw ManecoRuntimeException::unknownError($e);
        }
    }

    public function handleException(HttpEvent $event)
    {
        $response = $event['response'];
        if (!isset($response)) {
            $e = $event['exception'];
            throw ManecoRuntimeException::connectionError($e);
        }
        try {
            $error = new ErrorResponse($response->json());
        } catch (\Exception $e) {
            throw ManecoRuntimeException::jsonParseError($e);
        }
        throw new ManecoResponseException($error->error_code, $error->error_msg, $response->getStatusCode(), $error);
    }

    public function getClient()
    {
        return $this->client;
    }

    public function __get($key)
    {
        $accessors = array(
            'cardPayments', 'customers', 'events', 'payments', 'recursions'
        );
        if (in_array($key, $accessors) && property_exists($this, $key)) {
            return $this->{$key};
        } else {
            throw new \Exception('Method "' . $key . '" does not exist.');
        }
    }

    public function __set($key, $value)
    {
        throw new \Exception('Method "' . $key . '" does not exist.');
    }
}
