<?php

namespace Wambo\Cart;

use RandomLib\Factory as RandomNumberGeneratorFactory;
use RandomLib\Generator as RandomNumberGenerator;
use SecurityLib\Strength as RandomNumberStrength;
use Wambo\Cart\Controller\CartController;
use Wambo\Cart\Service\CartFactory;
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
        $app->post("/cart", ["CartController", "createCart"]);
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

        // Random Number Generator
        $container->set(RandomNumberGenerator::class, function () {
            $randomNumberGeneratorFactory = new RandomNumberGeneratorFactory;
            $randomNumberGenerator = $randomNumberGeneratorFactory->getGenerator(new RandomNumberStrength(RandomNumberStrength::MEDIUM));
            return $randomNumberGenerator;
        });

        // Cart Factory
        $container->set(CartFactory::class, \DI\object(CartFactory::class));

        // Cart Repository
        $container->set(CartRepositoryInterface::class, \DI\object(JSONCartRepository::class));

        // Cart Controller
        $container->set('CartController', \DI\object(CartController::class));
    }
}
