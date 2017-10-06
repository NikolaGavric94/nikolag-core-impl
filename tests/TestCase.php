<?php
namespace Nikolag\Myservice\Tests;

use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use DatabaseMigrations, WithoutMiddleware;

    /**
     * @var Faker\Factory
     */
    protected $faker;
    
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
        $this->loadLaravelMigrations(['--database' => 'my_service_test']);
        $this->artisan('migrate', ['--database' => 'my_service_test']);
        $this->withFactories(__DIR__.'/../src/database/factories');
        $this->faker = Faker::create();
    }

    /**
     * Add service providers this package depends on.
     */
    protected function getPackageProviders($app)
    {
        return [
            'Nikolag\Myservice\Providers\MyServiceProvider',
            'Nikolag\Core\Providers\MigrationServiceProvider'
        ];
    }

    /**
     * Add aliases this package depends on.
     */
    protected function getPackageAliases($app)
    {
        return [
            'MyService' => 'Nikolag\Myservice\Facades\MyService'
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
    */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'my_service_test');
        $app['config']->set('database.connections.my_service_test', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => ''
        ]);
    }
}
