<?php

namespace App\Repositories;

use App\Interfaces\CartRepositoryInterface;
use Illuminate\Support\Facades\Redis;

use Illuminate\Support\Str;

use App\Models\Product;
use Exception;

class CartRepository implements CartRepositoryInterface
{
    private $redis;

    public function __construct()
    {
        $this->redis = Redis::connection();
    }

    /**
     * Returns Cart Id
     *
     * @param string|null $cartId
     * @return string
     */
    public function processCartId(string $cartId = null): string
    {
        if (!$cartId) {
            $cartId = $this->generateCartId();
        }

        return $cartId;
    }

    /**
     * Generates new cart id
     *
     * @return string
     */
    private function generateCartId(): string
    {
        return Str::uuid();
    }

    /**
     * Retrieves Items from the cart by the cart id
     *
     * @param string $cartId
     * @return array
     */
    public function retrieveCartItems(string $cartId): array
    {
        return ($this->redis->get($cartId) ? json_decode($this->redis->get($cartId)) : []);
    }

    /**
     * Formats the product array
     *
     * @param array $product
     * @return array
     */
    private function formatProductArray(array $product): array
    {
        return [
            [
                'product_id' => $product['id'],
                'product_qty' => $product['qty']
            ]
        ];
    }

    private function updateExistingCartItems(array $cartItems, array $product): array
    {
        array_map(function ($item) use ($product) {
            if ($item->product_id == $product['id']) {
                return $item->product_qty +=  $product['qty'];
            }
        }, $cartItems);

        return $cartItems;
    }

    /**
     * Checks to see if the product already exists in the cart
     *
     * @param array $cartItems
     * @param array $product
     * @return boolean
     */
    private function isProductAlreadyInCart(array $cartItems, array $product): bool
    {
        foreach ($cartItems as $item) {
            if ($item->product_id == $product['id']) {
                return true;
            }
        }

        return false;
    }

    /**
     * Merges new product with the cart array
     *
     * @param array $cartItems
     * @param array $product
     * @return array
     */
    private function mergeNewItemsToCartArray(array $cartItems, array $product): array
    {
        $product = $this->formatProductArray($product);
        return array_merge($cartItems,  $product);
    }

    /**
     * Checks if the product is avaialbe to buy
     * @todo move to product repository and add logic for buying conditions
     *
     * @param integer $productId
     * @return integer
     */
    private function isProductAvailable(int $productId): int
    {
        return Product::where('id', $productId)->count();
    }

    public function getProductData($cartItems)
    {
        $cart = array_map(function ($item) {
            // @todo Move to product repository
            $product = Product::where('id', $item->product_id)->first();
            if (!$product) {
                return false;
            }
            $item->name = $product->name;
            $item->price = $product->price;
            return $item;
        }, $cartItems);

        return $cart;
    }

    public function buildCartArray(string $cartId, array $product)
    {
        if (!$this->isProductAvailable($product['id'])) {
            throw new Exception('Product does not exist');
        }
        // Check if prodicts already exisit in the cart
        $cartItems = $this->retrieveCartItems($cartId);
        if (!$cartItems) {
            return $this->formatProductArray($product);
        }

        // Check if this product is already in the cart
        $productInCart = $this->isProductAlreadyInCart($cartItems, $product);

        if ($productInCart) {
            // Update the product quantity for the product we are trying to add
            $cartItems = $this->updateExistingCartItems($cartItems, $product);
            return $cartItems;
        }

        // Merge new product into the cart array
        return $this->mergeNewItemsToCartArray($cartItems, $product);
    }

    public function addItemsToCart(string $cartId, array $cartItems)
    {
        $this->redis->set(
            $cartId,
            json_encode($cartItems)
        );
    }

    /**
     * 
     *
     * @param string $cartId
     * @return integer
     */
    public function totalItems(string $cartId): int
    {
        return count($this->retrieveCartItems($cartId));
    }

    public function deleteCart($cartId)
    {
        $this->redis->del($cartId);
        return [];
    }
}
