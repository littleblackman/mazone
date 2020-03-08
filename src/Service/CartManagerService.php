<?php

declare(strict_types=1);

namespace App\Service;

use App\Domain\Model\ProductManager;
use App\Service\baseService;

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

    public function delete() {
       $this->session->remove('cart'); 
    }

    public function setCart($cart) {
        $this->session->set('cart', $cart);
    }

    public function addToCart($productId) {
        $product = $this->productManager->find($productId);
        $cart = $this->getCart();
        
        (key_exists($product->getId(), $cart)) ? $quantity = $cart[$product->getId()]['quantity']+1 : $quantity = 1;
        
        $cart[$product->getId()] = ['id' => $productId, 'quantity' => $quantity, 'product' => $product];
        
        if(!isset($cart['total'])) $cart['total'] = 0;

        $cart['total'] += $product->getPrice();

        $this->session->set('cart', $cart);
        
        return $cart;
    }

    public function removeFromCart($productId) {
        $product = $this->productManager->find($productId);

        $cart = $this->getCart();
        if(!key_exists($product->getId(), $cart)) return ['message' => 'this product is not in your cart'];
        
        $quantity = $cart[$product->getId()]['quantity'];

        $quantity--;


        if($quantity < 1) {
            unset($cart[$product->getId()]);
        } else {
            $cart[$product->getId()]['quantity'] = $quantity;
        }

        $cart['total'] -= $product->getPrice();

        if($cart['total'] <= 0) {
            $this->delete();
            $message = ['message' => 'your cart is empty'];
        } else {
            $this->session->set('cart', $cart);
            $message = ['message' => 'this product has been removed'];
        }

        return $message;

    }

    public function toArray() {
        $cartArray = [];
        $cart = $this->getCart();
        foreach($cart as $productId => $item) {
            $cartArray[] = ['id' => $productId, 'quantity' => $item['quantity'], 'product' => $item['product']->toArray()];
        }
        return $cartArray;
    }

    public function getCartNbItems() {
        $cart = $this->getCart();
        $quantity = 0;
        foreach($cart as $item) {
            $quantity += $item['quantity'];
        }
        if($quantity == 0) return null;
        return $quantity;
    }
    

}