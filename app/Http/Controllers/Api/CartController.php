<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Interfaces\CartRepositoryInterface;

class CartController extends Controller
{

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository =  $cartRepository;
    }

    /**
     * Add product to cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = $request->only('id', 'qty');
        $cartId = $request->input('cart_id');

        // Creates new cart id if it doesn't exisit
        $cartId = $this->cartRepository->processCartId(cartId: $cartId);
        // Checks if product already exists in the cart
        $cartItems = $this->cartRepository->buildCartArray(cartId: $cartId, product: $product);
        // Adds item to cart
        $this->cartRepository->addItemsToCart(cartId: $cartId, cartItems: $cartItems);
        // Retrieves items from cart
        $cart = $this->cartRepository->retrieveCartItems(cartId: $cartId);

        $cart = $this->cartRepository->getProductData($cart);

        $count = $this->cartRepository->totalItems(cartId: $cartId);

        return response()->json([
            'cart_id' => $cartId,
            'cart' => $cart,
            'count' => $count,
        ]);
    }


    /**
     * Update items in the cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Show cart contents
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($cartId)
    {
        $cart = $this->cartRepository->retrieveCartItems(cartId: $cartId);

        $cart = $this->cartRepository->getProductData($cart);

        $count = $this->cartRepository->totalItems(cartId: $cartId);

        return response()->json([
            'cart_id' => $cartId,
            'cart' => $cart,
            'count' => $count,
        ]);
    }

    /**
     * Delete the Cart
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($cartId)
    {
        $cart = $this->cartRepository->deleteCart(cartId: $cartId);
        return response()->json([
            'cart' => $cart,
            'count' => 0,
        ]);
    }
}
