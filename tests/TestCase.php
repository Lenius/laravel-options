<?php

namespace Appstract\Options\Test;

use Appstract\Options\OptionFacade;
use Appstract\Options\OptionsServiceProvider;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Define environment setup.
     *
     * @param  Application  $app
     */
    protected function getEnvironmentSetUp($app): void
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');

        $app['config']->set(
            'database.connections.testbench', [
                'driver' => 'sqlite',
                'database' => ':memory:',
                'prefix' => '',
            ]
        );
    }

    /**
     * Get package providers.
     *
     * @param  Application  $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            OptionsServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  Application  $app
     * @return array
     */
    protected function getPackageAliases($app): array
    {
        return [
            'Option' => OptionFacade::class,
        ];
    }
}
