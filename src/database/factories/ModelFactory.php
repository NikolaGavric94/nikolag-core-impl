<?php

use Nikolag\Myservice\Models\Customer;
use Nikolag\Myservice\Models\Transaction;
use Nikolag\Myservice\Tests\Models\User;
use Nikolag\Myservice\Utils\Constants;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Constants::CUSTOMER_NAMESPACE, function (Faker\Generator $faker)
{
    return [
    	'payment_service_id' => $faker->unique()->randomNumber,
        'first_name' => $faker->unique()->firstNameMale,
        'last_name' => $faker->unique()->lastName,
        'company_name' => $faker->unique()->address,
        'nickname' => $faker->unique()->firstNameFemale,
        'email' => $faker->unique()->companyEmail,
        'phone' => $faker->unique()->tollFreePhoneNumber,
        'note' => $faker->unique()->paragraph(5),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Constants::TRANSACTION_NAMESPACE, function (Faker\Generator $faker)
{
    return [
        'status' => array_rand([Constants::TRANSACTION_STATUS_OPENED, Constants::TRANSACTION_STATUS_PASSED, Constants::TRANSACTION_STATUS_FAILED]),
        'amount' => $faker->numberBetween(5000, 500000)
    ];
});
/** PENDING TRANSACTION */
$factory->state(Constants::TRANSACTION_NAMESPACE, 'OPENED', [
    'status' => Constants::TRANSACTION_STATUS_OPENED,
]);
/** PAID TRANSACTION */
$factory->state(Constants::TRANSACTION_NAMESPACE, 'PASSED', [
    'status' => Constants::TRANSACTION_STATUS_PASSED,
]);
/** FAILED TRANSACTION */
$factory->state(Constants::TRANSACTION_NAMESPACE, 'FAILED', [
    'status' => Constants::TRANSACTION_STATUS_FAILED,
]);

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker\Generator $faker)
{
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
