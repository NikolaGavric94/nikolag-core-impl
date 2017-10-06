<?php

namespace Nikolag\Myservice\Models;

use Nikolag\Core\Models\Customer as CoreCustomer;
use Nikolag\Myservice\Utils\Constants;

class Customer extends CoreCustomer
{
    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'payment_service_type' => 'my-service'
    ];

    /**
     * List of users this customer bought from.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function merchants()
    {
        return $this->belongsToMany(config('nikolag.connections.my-service.user.namespace'), 'nikolag_customer_user', 'customer_id', 'owner_id');
    }

    /**
     * List of previous transactions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Constants::TRANSACTION_NAMESPACE, 'customer_id', Constants::CUSTOMER_IDENTIFIER);
    }
}
