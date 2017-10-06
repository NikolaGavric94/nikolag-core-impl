<?php

namespace Nikolag\Myservice;

use Nikolag\Core\Abstracts\CorePaymentService;
use Nikolag\Myservice\Contracts\MyServiceContract;
use Nikolag\Myservice\Models\Customer;
use Nikolag\Myservice\MyConfig;
use Nikolag\Myservice\Utils\Constants;

class SquareService extends CorePaymentService implements MyServiceContract
{
    public function __construct(MyConfig $myConfig)
    {
        $this->config = $myConfig;
    }

    /**
     * List locations.
     *
     * @return string
     */
    public function locations()
    {
        return "Logic for retrieving all locations goes here";
    }

    /**
     * Save customer.
     *
     * @return void
     */
    public function save()
    {
        return "Logic for saving a customer in local db and on your service and connecting him to the merchant";
    }

    /**
     * Charge a customer.
     *
     * @param array $data
     * @return \Nikolag\Square\Models\Transaction
     * @throws \Nikolag\Square\Exception on non-2xx response
     */
    public function charge(array $data)
    {
        return "Logic for charging a customer and saving transaction goes here.";
    }

    /**
     * List transactions.
     *
     * @param array $data
     * @return \SquareConnect\Model\ListTransactionsResponse
     */
    public function transactions(array $data)
    {
        return "Logic for retrieving all transactions from your service goes here";
    }

    /**
     * My custom function
     * 
     * @return int
     */
    public function myCustomFunction() {
        return 25;
    }

    /**
     * @param Customer|null $customer
     *
     * @return self
     */
    public function setCustomer($customer)
    {
        if ($customer instanceof Customer) {
            $this->customer = $customer;
        } elseif (is_array($customer)) {
            $this->customer = new Customer($customer);
        }

        return $this;
    }
}
