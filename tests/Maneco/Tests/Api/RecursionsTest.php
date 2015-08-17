<?php

namespace Maneco\Tests\Api;

use Maneco\Tests\ManecoTestCase;

class RecursionsTest extends ManecoTestCase
{

    public function testCreate()
    {
        $result = $this->maneco->recursions->create(array(
             "customer_id" => "cus_bGuha13kNyiT","amount" => 1000,"currency" => "JPY","cycle" => "1","timing" => "31"
        ));
        echo $result;
    }

    public function testResume()
    {
        $this->setMock("recursions/resume");
        $result = $this->maneco->recursions->resume(array(
             "id" => "rec_IdVaswsRgGlS"
        ));
        echo $result;
    }

    public function testDelete()
    {
        $result = $this->maneco->recursions->create(array(
             "customer_id" => "cus_bGuha13kNyiT","amount" => 1000,"currency" => "JPY","cycle" => "1","timing" => "31"
        ));
        $result = $this->maneco->recursions->delete(array(
             "id" => $result->recursion_id
        ));
        echo $result;
    }

    public function testGet()
    {
        $result = $this->maneco->recursions->create(array(
             "customer_id" => "cus_bGuha13kNyiT","amount" => 1000,"currency" => "JPY","cycle" => "1","timing" => "31"
        ));
        $result = $this->maneco->recursions->get(array(
             "id" => $result->recursion_id
        ));
        echo $result;
    }

    public function testAll()
    {
        $result = $this->maneco->customers->create(array(
             "card_number" => "4980058555000000","card_expire_year" => "20","card_expire_month" => "01","card_cvc" => "111","card_name" => "XXX XXX"
        ));
        $customer_id = $result->customer_id;
        for ($i = 0; $i < 5; $i++) {
            $result = $this->maneco->recursions->create(array(
            "customer_id" => $customer_id,"amount" => 1000,"currency" => "JPY","cycle" => "1","timing" => "31"
            ));
        }
        $result = $this->maneco->recursions->all(array(
             "created_time_from" => date("Ymd"),"created_time_to" => date("Ymd"),"customer_id" => $customer_id
        ));
        echo $result;
    }
}
