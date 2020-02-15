<?php

declare(strict_types=1);

namespace App\Action\Product;

use App\Action\Product\Interfaces\ProductShowActionInterface;
use App\Domain\Model\CategoryManager;
use App\Domain\Model\ProductManager;
use App\Responder\Product\Interfaces\ProductShowResponderInterface;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route(path="/decouvrez/{slug}", name="showProduct")
 */
class ProductShowAction implements ProductShowActionInterface
{
    private $responder;

    public function __construct(ProductShowResponderInterface $responder, ProductManager $productManager, CategoryManager $categoryManager)
    {
        $this->responder = $responder;
        $this->productManager = $productManager; 
        $this->categoryManager = $categoryManager;
    }

    public function __invoke($slug)
    {
        $product = $this->productManager->findBySlug($slug);
        $menuItems       = $this->categoryManager->getMenuItems();

        return $this->responder->render('product/show.html.twig', [
                                                                   'product' => $product,
                                                                   'menuItems' => $menuItems
                                                                ]);
    }
}