<?php

namespace Wambo\Cart\Controller;

use Slim\Http\Request;
use Slim\Http\Response;
use Wambo\Cart\Model\Cart;
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
     * Create a new CartController instance.
     *
     * @param CartRepositoryInterface $cartRepository An instance of the cart repository.
     */
    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    /**
     * @param Request  $request
     * @param Response $response
     */
    public function getCart(Request $request, Response $response)
    {
        $cartIdentifier = $this->getCartIdentifierFromCookieParams($request->getCookieParams());
        if (is_null($cartIdentifier)) {
            // todo: Bad request
            return;
        }

        $cart = $this->cartRepository->getCart($cartIdentifier);
        if (is_null($cart)) {
            // todo: Cart not found
            return;
        }

        $response->withJson($cart);
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
        return "cookie-id-1";
    }
}