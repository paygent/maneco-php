<?php

namespace Maneco\Tests;

use Maneco\Tests\ManecoTestCase;
use Maneco\Exception\ManecoResponseException;

class ManecoTest extends ManecoTestCase
{

    public function testErrorResponse()
    {
        try {
            $result = $this->maneco->cardPayments->create();
        } catch (ManecoResponseException $e) {
            echo $e ."\n";
            echo $e->getErrorCode() ."\n";
            echo $e->getError()->parameter ."\n";
        }
    }

    public function testConnectionError()
    {
        $this->maneco->getClient()->setBaseUrl("http://127.0.0.1:8081");
        try {
            $result = $this->maneco->cardPayments->create(array(
            "amount" => 10000,"card_number" => "4980058555000000","card_expire_year" => "20","card_expire_month" => "01","card_cvc" => "111","card_name" => "XXX XXX","capture" => "false","currency" => "JPY"
            ));
        } catch (\Exception $e) {
            echo $e ."\n";
            echo $e->getErrorCode() ."\n";
        }
    }

    public function testJsonParseError()
    {
        $this->setMock("errors/json_parse_error");
        try {
            $result = $this->maneco->cardPayments->create(array(
            "amount" => 10000,"card_number" => "4980058555000000","card_expire_year" => "20","card_expire_month" => "01","card_cvc" => "111","card_name" => "XXX XXX","capture" => "false","currency" => "JPY"
            ));
        } catch (\Exception $e) {
            echo $e ."\n";
            echo $e->getErrorCode() ."\n";
        }
    }

    public function testUnknownError()
    {
        $this->setMock("errors/unknown_error");
        try {
            $result = $this->maneco->cardPayments->create(array(
            "amount" => 10000,"card_number" => "4980058555000000","card_expire_year" => "20","card_expire_month" => "01","card_cvc" => "111","card_name" => "XXX XXX","capture" => "false","currency" => "JPY"
            ));
        } catch (\Exception $e) {
            echo $e ."\n";
            echo $e->getErrorCode() ."\n";
        }
    }
}
