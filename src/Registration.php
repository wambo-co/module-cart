<?php

namespace Wambo\Cart;

use Wambo\Cart\Controller\CartController;
use Wambo\Cart\Storage\CartRepositoryInterface;
use Wambo\Cart\Storage\JSONCartRepository;
use Wambo\Core\App;
use Wambo\Core\Module\ModuleBootstrapInterface;

/**
 * Class Registration registers the cart module in the Wambo app.
 *
 * @package Wambo\Cart
 */
class Registration implements ModuleBootstrapInterface
{
    /**
     * Register the cart module.
     *
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->configureDI($app);
        $this->registerRoutes($app);
    }

    /**
     * Register routes in the slim app.
     *
     * @param App $app
     */
    private function registerRoutes(App $app)
    {
        $app->get("/cart", ["CartController", "getCart"]);
    }

    /**
     * Configure the dependency injection container
     *
     * @param App $app
     */
    private function configureDI(App $app)
    {
        /** @var \DI\Container $container */
        $container = $app->getContainer();

        $container->set(CartRepositoryInterface::class, \DI\object(JSONCartRepository::class));
        $container->set('CartController', \DI\object(CartController::class));
    }
}
