<?php

namespace Nikolag\Myservice\Tests\Unit;

use Nikolag\Myservice\Facades\MyService;
use Nikolag\Myservice\Tests\TestCase;

class MyServiceTest extends TestCase
{
    /**
     * Charge OK
     * 
     * @return void
     */
    public function test_my_service_charge_ok()
    {
        $response = MyService::charge(['amount' => 5000, 'card_nonce' => 'fake-card-nonce-ok', 'location_id' => env('MY_SERVICE_LOCATION')]);

        $this->assertTrue(is_string($response), 'Response is not of type string');
    }

    /**
     * Retrieving locations
     * 
     * @return void
     */
    public function test_my_service_locations()
    {
        $response = MyService::locations();

        $this->assertTrue(is_string($response), 'Response is not of type string');
    }

    /**
     * Retrieving transactions
     * 
     * @return void
     */
    public function test_my_service_transactions()
    {
        $response = MyService::transactions(['sort' => 'asc']);

        $this->assertTrue(is_string($response), 'Response is not of type string');
    }

    /**
     * Checking my custom function
     * 
     * @return void
     */
    public function test_my_service_custom_function()
    {
        $response = MyService::myCustomFunction();

        $this->assertTrue(is_int($response), 'Response is not of type int');
    }
}
