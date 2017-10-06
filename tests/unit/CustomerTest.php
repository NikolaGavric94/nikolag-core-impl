<?php

namespace Nikolag\Myservice\Tests\Unit;

use Nikolag\Myservice\Models\Customer;
use Nikolag\Myservice\Tests\TestCase;

class CustomerTest extends TestCase
{

    /**
     * Customer creation
     *
     * @return void
     */
    public function test_customer_make()
    {
        $customer = factory(Customer::class)->make();

        $this->assertTrue($customer!=null, 'Customer is null');
    }
}
