<?php

namespace Maneco\Tests\Api;

use Maneco\Tests\ManecoTestCase;

class CustomersTest extends ManecoTestCase
{

    public function testCreate()
    {
        $result = $this->maneco->customers->create(array(
             "card_number" => "4980058555000000","card_expire_year" => "20","card_expire_month" => "01","card_cvc" => "111","card_name" => "XXX XXX"
        ));
        echo $result;
    }

    public function testUpdate()
    {
        $result = $this->maneco->customers->create(array(
             "card_number" => "4980058555000000","card_expire_year" => "20","card_expire_month" => "01","card_cvc" => "111","card_name" => "XXX XXX"
        ));
        $result = $this->maneco->customers->update(array(
             "id" => $result->customer_id,"description" => "update"
        ));
        echo $result;
    }

    public function testDelete()
    {
        $result = $this->maneco->customers->create(array(
             "card_number" => "4980058555000000","card_expire_year" => "20","card_expire_month" => "01","card_cvc" => "111","card_name" => "XXX XXX"
        ));
        $result = $this->maneco->customers->delete(array(
             "id" => $result->customer_id
        ));
        echo $result;
    }

    public function testGet()
    {
        $result = $this->maneco->customers->create(array(
             "card_number" => "4980058555000000","card_expire_year" => "20","card_expire_month" => "01","card_cvc" => "111","card_name" => "XXX XXX"
        ));
        $result = $this->maneco->cardPayments->create(array(
             "amount" => 10000,"customer_id" => $result->customer_id,"capture" => "false","currency" => "JPY"
        ));
        $result = $this->maneco->customers->get(array(
             "id" => $result->customer_id
        ));
        echo $result;
    }

    public function testAll()
    {
        for ($i = 0; $i < 5; $i++) {
            $this->maneco->customers->create(array(
            "card_number" => "4980058555000000","card_expire_year" => "20","card_expire_month" => "01","card_cvc" => "111","card_name" => "XXX XXX"
            ));
        }
        $result = $this->maneco->customers->all(array(
             "created_time_from" => date("Ymd"),"created_time_to" => date("Ymd")
        ));
        echo $result;
    }
}
