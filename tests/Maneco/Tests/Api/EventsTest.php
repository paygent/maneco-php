<?php

namespace Maneco\Tests\Api;

use Maneco\Tests\ManecoTestCase;

class EventsTest extends ManecoTestCase
{

    public function testGet()
    {
        $result = $this->maneco->events->all(array(
             "created_time_from" => date("Ymd"),"created_time_to" => date("Ymd")
        ));
        $result = $this->maneco->events->get(array(
             "id" => $result->data[0]->event_id
        ));
        echo $result;
        echo $result->detail;
    }

    public function testAll()
    {
        $result = $this->maneco->events->all(array(
             "count" => 30, "created_time_from" => date("Ymd"),"created_time_to" => date("Ymd")
        ));
        echo $result . "\n";
        foreach ($result->data as $record) {
            echo $record->detail->object . "\n";
            switch ($record->detail->object) {
                case 'card-payment':
                    echo $record->detail->card . "\n";
                    break;
                case 'customer':
                    print_r($record->detail->recursions);
                    break;
            }
        }
    }
}
