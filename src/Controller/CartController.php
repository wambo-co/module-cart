<?php

namespace Wambo\Cart\Controller;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Wambo\Cart\Model\Cart;
use Wambo\Cart\Service\CartFactory;
use Wambo\Cart\Storage\CartRepositoryInterface;

/**
 * Class CartController provides API methods for common shopping cart operations.
 *
 * @package Wambo\Cart\Controller
 */
class CartController
{
    /**
     * @var CartRepositoryInterface
     */
    private $cartRepository;
    /**
     * @var CartFactory
     */
    private $cartFactory;

    /**
     * Create a new CartController instance.
     *
     * @param CartRepositoryInterface $cartRepository An instance of the cart repository.
     * @param CartFactory             $cartFactory    A cart factory
     */
    public function __construct(CartRepositoryInterface $cartRepository, CartFactory $cartFactory)
    {
        $this->cartRepository = $cartRepository;
        $this->cartFactory = $cartFactory;
    }

    /**
     * Create a new cart
     *
     * @param Request  $request
     * @param Response $response
     *
     * @return ResponseInterface
     */
    public function createCart(Request $request, Response $response)
    {
        $cartIdentifier = $this->getCartIdentifierFromCookieParams($request->getCookieParams());
        if (strlen($cartIdentifier) != 0) {

            if ($this->cartRepository->getCart($cartIdentifier) != null) {

                // Bad request
                return $response->withStatus(400, "You already have a cart");
            }

        }

        $cart = $this->cartFactory->createCart();
        $this->cartRepository->saveCart($cart);

        return $response->withJson($cart);
    }

    /**
     * Get the cart with the specified cart identifier.
     *
     * @param Request  $request
     * @param Response $response
     *
     * @return ResponseInterface
     */
    public function getCart(Request $request, Response $response)
    {
        $cartIdentifier = $this->getCartIdentifierFromCookieParams($request->getCookieParams());
        if (strlen($cartIdentifier) == 0) {
            // Bad request
            return $response->withStatus(400, "No cart identifier supplied");
        }

        $cart = $this->cartRepository->getCart($cartIdentifier);
        if (is_null($cart)) {
            // Not found
            return $response->withStatus(404, "Cart not found");
        }

        return $response->withJson($cart);
    }

    /**
     * Get the cart identifier from the given cookie parameters
     *
     * @param array $cookieParameters An array of cookie parameters
     *
     * @return string
     */
    private function getCartIdentifierFromCookieParams(array $cookieParameters): string
    {
        if (isset($cookieParameters["cart"]) === false) {
            return "";
        }

        $cartIdentifier = $cookieParameters["cart"];
        return $cartIdentifier;
    }
}