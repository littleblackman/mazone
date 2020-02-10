<?php

namespace App\DataFixtures;

use App\Domain\Entity\Product;
use App\Domain\Entity\Photo;
use App\Domain\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;


class ProductFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
             return ['product'];
    }
    
    public function load(ObjectManager $manager) {

        /*
DELETE FROM photo;
DELETE FROM product;
        */


        $datas = $this->getDatas();

        foreach($datas as $data) {

            $category = $manager->getRepository(Category::class)->find($data['category_id']);

            $product = new Product();
            $product->setNameFr($data['name_fr']);
            $product->setNameEn($data['name_en']);
            $product->setDescriptionFr($data['description_fr']);
            $product->setDescriptionEn($data['description_en']);
            $product->setPrice($data['price']);
            $product->setDeliveryPrice($data['delivery_price']);
            $product->setCategory($category);
            $product->setLiked(rand(1,1000));
            $product->setSolded(rand(1,100));

            if($data['photos']) {
                foreach($data['photos'] as $d) {
                    $photo = new Photo();
                    $photo->setUrl($d['url']);
                    $manager->persist($photo);
                    $product->addPhoto($photo);

                }
            }
            
            $manager->persist($product);
        }
        $manager->flush();
    }

    public function getDatas() {


        $datas = [
                    [
                        'name_fr' => "Nouvel Apple MacBook Pro (13 pouces, 8Go RAM, 128Go de stockage, Intel Core i5 à 1,4GHz) - Argent",
                        'name_en' => 'Apple MacBook Air (13-inch, 8GB RAM, 128GB SSD Storage) - Silver',
                        'description_fr' => 'Processeur Intel iRNUM i5 bicœur de 8e génération à 1, 6 Ghz
                                            Superbe écran retina avec technologie true tone
                                            Toucher et touch id
                                            Intel Iris plus graphics 645
                                            Ssd ultra‑rapide
                                            Deux ports Thunderbolt 3 (usb‑c)
                                            Jusqu’à 10 heures d’autonomie
                                            Wi‐fi 802.11ac
                                            Tout dernier clavier conçu par Apple
                                            Trackpad force Touch',
                        'description_en' => '1.8 GHz dual-core Intel Core i5 Processor
                                            Intel HD Graphics 6000
                                            Fast SSD Storage
                                            8GB memory
                                            Two USB 3 ports
                                            Thunderbolt 2 port
                                            Sdxc port',
                        'price' => '1411.55',
                        'delivery_price' => '50',
                        'category_id' => 2,
                        'photos' => [
                                        ['url' => 'https://images-na.ssl-images-amazon.com/images/I/51-oeeCf1zL._SL1024_.jpg'],
                                        ['url' => 'https://images-na.ssl-images-amazon.com/images/I/413cU6KK6QL._SL1024_.jpg']
                                    ]
                        ],
                        [
                            'name_fr' => "Nouvel Apple MacBook Pro (13 pouces, 8Go RAM, 128Go de stockage, Intel Core i5 à 1,4GHz) - Argent",
                            'name_en' => 'Apple MacBook Air (13-inch, 8GB RAM, 128GB SSD Storage) - Silver',
                            'description_fr' => 'Processeur Intel iRNUM i5 bicœur de 8e génération à 1, 6 Ghz
                                                Superbe écran retina avec technologie true tone
                                                Toucher et touch id
                                                Intel Iris plus graphics 645
                                                Ssd ultra‑rapide
                                                Deux ports Thunderbolt 3 (usb‑c)
                                                Jusqu’à 10 heures d’autonomie
                                                Wi‐fi 802.11ac
                                                Tout dernier clavier conçu par Apple
                                                Trackpad force Touch',
                            'description_en' => '1.8 GHz dual-core Intel Core i5 Processor
                                                Intel HD Graphics 6000
                                                Fast SSD Storage
                                                8GB memory
                                                Two USB 3 ports
                                                Thunderbolt 2 port
                                                Sdxc port',
                            'price' => '1411.55',
                            'delivery_price' => '50',
                            'category_id' => 2,
                            'photos' => [
                                            ['url' => 'https://images-na.ssl-images-amazon.com/images/I/51-oeeCf1zL._SL1024_.jpg'],
                                            ['url' => 'https://images-na.ssl-images-amazon.com/images/I/413cU6KK6QL._SL1024_.jpg']
                                        ]
                        ]
        ];




        return $datas;
    }
}
