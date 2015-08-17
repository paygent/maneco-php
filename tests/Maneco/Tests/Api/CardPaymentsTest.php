<?php

namespace Maneco\Tests\Api;

use Maneco\Tests\ManecoTestCase;

class CardPaymentsTest extends ManecoTestCase
{

    public function testCreateWithNumber()
    {
        $result = $this->maneco->cardPayments->create(array(
             "amount" => 10000,"card_number" => "4980058555000000","card_expire_year" => "20","card_expire_month" => "01","card_cvc" => "111","card_name" => "XXX XXX","capture" => "false","currency" => "JPY"
        ));
        echo $result;
    }

    public function testCreateWithCustomer()
    {
        $result = $this->maneco->cardPayments->create(array(
             "amount" => 10000,"customer_id" => "cus_bGuha13kNyiT","capture" => "false","currency" => "JPY"
        ));
        echo $result;
    }

    public function testRefund()
    {
        $result = $this->maneco->cardPayments->create(array(
             "amount" => 10000,"card_number" => "4980058555000000","card_expire_year" => "20","card_expire_month" => "01","card_cvc" => "111","card_name" => "XXX XXX","capture" => "false","currency" => "JPY"
        ));
        $result = $this->maneco->cardPayments->refund(array(
             "id" => $result->payment_id,"amount" => 100
        ));
        echo $result;
    }

    public function testCapture()
    {
        $result = $this->maneco->cardPayments->create(array(
             "amount" => 10000,"card_number" => "4980058555000000","card_expire_year" => "20","card_expire_month" => "01","card_cvc" => "111","card_name" => "XXX XXX","capture" => "false","currency" => "JPY"
        ));
        $result = $this->maneco->cardPayments->refund(array(
             "id" => $result->payment_id,"amount" => 100
        ));
        $result = $this->maneco->cardPayments->capture(array(
             "id" => $result->payment_id
        ));
        echo $result;
    }
}
