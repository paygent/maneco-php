<?php

namespace Maneco\Tests\Api;

use Maneco\Tests\ManecoTestCase;

class PaymentsTest extends ManecoTestCase
{

    public function testGet()
    {
        $result = $this->maneco->cardPayments->create(array(
             "amount" => 10000,"card_number" => "4980058555000000","card_expire_year" => "20","card_expire_month" => "01","card_cvc" => "111","card_name" => "XXX XXX","capture" => "false","currency" => "JPY"
        ));
        $result = $this->maneco->payments->get(array(
             "id" => $result->payment_id
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
            $result = $this->maneco->cardPayments->create(array(
            "amount" => 10000,"customer_id" => $customer_id,"capture" => "false","currency" => "JPY"
            ));
        }
        $result = $this->maneco->payments->all(array(
             "created_time_from" => date("Ymd"),"created_time_to" => date("Ymd"),"customer_id" => $customer_id
        ));
        echo $result;
    }
}
