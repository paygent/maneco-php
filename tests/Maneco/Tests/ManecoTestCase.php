<?php

namespace Maneco\Tests;

use Maneco\Maneco;
use Guzzle\Plugin\Mock\MockPlugin;

class ManecoTestCase extends \PHPUnit_Framework_TestCase
{
    protected $maneco;
    protected $plugin;

    public function __construct()
    {
        mb_internal_encoding("SJIS");
        $this->maneco = new Maneco('123456789012345678901234567890123456');
    }

    public function setMock($api)
    {
        $this->plugin = new MockPlugin();
        $this->plugin->addResponse(__DIR__ . "/Mock/{$api}.txt");
        $this->maneco->getClient()->addSubscriber($this->plugin);
    }
}
