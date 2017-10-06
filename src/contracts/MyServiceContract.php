<?php

namespace Nikolag\Myservice\Contracts;

use Nikolag\Core\Contracts\PaymentServiceContract;

interface MyServiceContract extends PaymentServiceContract
{
	public function myCustomFunction();
}
