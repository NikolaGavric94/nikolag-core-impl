<?php
namespace Nikolag\Myservice\Traits;

use Nikolag\Myservice\Facades\MyService;
use Nikolag\Myservice\Utils\Constants;

trait HasCustomers
{

    /**
     * Retrieve merchant customers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function customers()
    {
        return $this->belongsToMany(Constants::CUSTOMER_NAMESPACE, 'nikolag_customer_user', 'customer_id', 'owner_id');
    }

    /**
     * Retrieve customer if he exists, otherwise return false.
     *
     * @param string $email
     * @return \Nikolag\Square\Model\Customer|false
     */
    public function hasCustomer(string $email)
    {
        $query = $this->customers()->where('email', '=', $email);
        return $query->exists() ?
                $query->first() : false;
    }

    /**
     * All transactions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Constants::TRANSACTION_NAMESPACE, 'merchant_id', config('nikolag.connections.my-service.user.identifier'));
    }

    /**
     * Paid transactions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function passedTransactions()
    {
        return $this->_byTransactionStatus(Constants::TRANSACTION_STATUS_PASSED);
    }

    /**
     * Pending transactions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function openedTransactions()
    {
        return $this->_byTransactionStatus(Constants::TRANSACTION_STATUS_OPENED);
    }

    /**
     * Failed transactions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function failedTransactions()
    {
        return $this->_byTransactionStatus(Constants::TRANSACTION_STATUS_FAILED);
    }

    /**
     * Charge a customer.
     *
     * @param float $amount
     * @param string $nonce
     * @param string $location_id
     * @param mixed $customer
     * @param string $currency
     * @return \Nikolag\Square\Models\Transaction
     */
    public function charge(float $amount, string $nonce, string $location_id, $customer = null, string $currency = 'USD')
    {
        return MyService::setMerchant($this)->setCustomer($customer)->charge(
            ['amount' => $amount, 'card_nonce' => $nonce, 'location_id' => $location_id, 'currency' => $currency]
        );
    }

    /**
     * Save a customer.
     *
     * @param array $customer
     * @return void
     */
    public function saveCustomer(array $customer)
    {
        MyService::setMerchant($this)->setCustomer($customer)->save();
    }

    /**
     * Model function, return all transactions by status.
     *
     * @param string $status
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function _byTransactionStatus(string $status)
    {
        return $this->transactions()->where(function ($query) use ($status) {
            $query->where('merchant_id', '=', $this->attributes[config('nikolag.connections.my-service.user.identifier')])
                ->where('status', '=', $status);
        });
    }
}
