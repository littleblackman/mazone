<?php

declare(strict_types=1);

namespace App\Domain\Service;

use App\Domain\Model\ProductManager;
use App\Domain\Service\baseService;

/**
 * Class used to manager all the shop application
 * 
 */
class CartManagerService extends baseService
{

    private $productManager;

    public function __construct(ProductManager $productManager) {
        parent::__construct();
        $this->productManager = $productManager;
    }

    public function getCart() {
        if(!$this->session->get('cart')) return [];
        $cart = $this->session->get('cart');
        return $cart;
    }

    public function setCart($cart) {
        $this->session->set('cart', $cart);
    }

    public function addToCart($productId) {
        $product = $this->productManager->find($productId);
        $cart = $this->getCart();
        (key_exists($product->getId(), $cart)) ? $quantity = $cart[$product->getId()]['quantity']+1: $quantity = 1;
        $cart[$product->getId()] = ['quantity' => $quantity, 'product' => $product];
        $this->session->set('cart', $cart);
        return $cart;
    }

    public function toArray() {
        $cartArray = [];
        $cart = $this->getCart();
        foreach($cart as $productId => $item) {
            $cartArray[$productId] = ['quantity' => $item['quantity'], 'product' => $item['product']->toArray()];
        }
        return $cartArray;
    }

}