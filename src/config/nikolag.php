<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Nikolag Configuration
    |--------------------------------------------------------------------------
    |
    | This represents the default connection name that will be used when
    | u have multiple available connections. For all available connections
    | take a look a the code documentation of 'connections' just below.
    |
    */
    'default' => 'my-service',

    /*
    |--------------------------------------------------------------------------
    | Nikolag Connections
    |--------------------------------------------------------------------------
    |
    | Here you will find all available connections you have in your project.
    | For all available connections you can take a look at the link under.
    |
    | https://github.com/NikolaGavric94/nikolag-core/blob/master/DRIVERS.md
    |
    */
    'connections' => [
        /*
        |--------------------------------------------------------------------------
        | My Service Configuration
        |--------------------------------------------------------------------------
        |
        | My service configuration determines the default application_id
        | and my service token when doing any of the calls to my service. These values will
        | be used when there is no merchant provided as a seller. You have to change
        | these values.
        |
        */
    	'my-service' => [
            'namespace' => 'Nikolag\Myservice\MyService',
    		'application_id' => env('MY_SERVICE_APPLICATION_ID'),
    		'access_token' => env('MY_SERVICE_TOKEN'),

            /*
            |--------------------------------------------------------------------------
            | My Service Merchant Configuration
            |--------------------------------------------------------------------------
            |
            | The my service merchant configuration determines the default namespace for
            | merchant model and it's identifier which will be used in various
            | relationships when retrieving models. You are encouraged to change these
            | values to better reflect your application.
            |
            */
            'user' => [
                'namespace' => env('MY_SERVICE_USER_NAMESPACE', '\App\User'),
                'identifier' => env('MY_SERVICE_USER_IDENTIFIER', 'id')
            ],
    	],
    ]
];