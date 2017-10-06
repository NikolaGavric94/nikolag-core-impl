<?php

namespace Nikolag\Myservice;

use Nikolag\Core\Contracts\ConfigContract;
use Nikolag\Core\CoreConfig;

class MyConfig extends CoreConfig implements ConfigContract
{
    /**
     * @var array
     */
    public $customVariable;

    public function __construct()
    {
        parent::__construct();
        $this->config['connections']['my-service'] = config('nikolag.connections.my-service');
        $this->checkConfigValidity($this->config);
    }
}
