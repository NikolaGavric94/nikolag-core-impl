<?php

namespace Nikolag\Myservice\Models;

use Nikolag\Myservice\Utils\Constants;
use Nikolag\Core\Models\Transaction as CoreTransaction;

class Transaction extends CoreTransaction
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
     * Seller from this transaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function merchant()
    {
        return $this->belongsTo(config('nikolag.connections.my-service.user.namespace'), config('nikolag.connections.my-service.user.identifier'), 'merchant_id');
    }

    /**
     * Buyer from this transaction.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Constants::CUSTOMER_NAMESPACE, Constants::CUSTOMER_IDENTIFIER, 'customer_id');
    }
}
