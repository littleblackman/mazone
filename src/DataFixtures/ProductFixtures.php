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
bin/console doctrine:fixtures:load --append
        */


        $datas = $this->getDatas();

        foreach($datas as $data) {

            $category = $manager->getRepository(Category::class)->find($data['category_id']);
    
            $slug = $this->createSlug($manager, $data['name_fr'].'-'.$data['brand']);

            $product = new Product();
            $product->setNameFr($data['name_fr']);
           // $product->setNameEn($data['name_en']);
            $product->setDescriptionFr($data['description_fr']);
           // $product->setDescriptionEn($data['description_en']);
            $product->setInformationFr($data['information_fr']);
           // $product->setInformationEn($data['information_en']);
            $product->setSlug($slug);
            $product->setBrand($data['brand']);
            $product->setPrice($data['price']);
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
            $manager->flush();
        }
       
    }

    public function createSlug($manager, $name) {

        $slug_name = str_replace([' ', ',', "'"], ['-', '-', '-'], $name);
        $slug_name = strtolower(
                            str_replace(
                                ['é', 'è', 'ê', 'ï', 'î','ë', 'à', 'ô', 'ö', 'â'],
                                ['e', 'e', 'e', 'i', 'i', 'e', 'a', 'o', 'o', 'a'],
                                $slug_name
        ));

        $i = 0;

        $original_name = $slug_name;

        if($product = $manager->getRepository(Product::class)->findOneBy(['slug' => $slug_name])) {

            $slug_product = $product->getSlug();
            while($slug_name == $slug_product) {
                $i++;
                $slug_name = $original_name.'-'.$i;
                $product = $manager->getRepository(Product::class)->findOneBy(['slug' => $slug_name]);
                ($product) ? $slug_product = $product->getSlug() : $slug_product = "";
            }
        }

        return $slug_name;
    }

    public function getDatas() {


        $datas = [
                    [
                        'name_fr'        => 'Apple MacBook Pro',
                        'description_fr' => "Nouvel Apple MacBook Pro (13 pouces, 8Go RAM, 128Go de stockage, Intel Core i5 à 1,4GHz) - Argent",
                        'information_fr' => 'Processeur Intel iRNUM i5 bicœur de 8e génération à 1, 6 Ghz
                                            Superbe écran retina avec technologie true tone
                                            Toucher et touch id
                                            Intel Iris plus graphics 645
                                            Ssd ultra‑rapide
                                            Deux ports Thunderbolt 3 (usb‑c)
                                            Jusqu’à 10 heures d’autonomie
                                            Wi‐fi 802.11ac
                                            Tout dernier clavier conçu par Apple
                                            Trackpad force Touch',
                        'brand' => 'Apple',
                        'price' => '1411.55',
                        'category_id' => 2,
                        'photos' => [
                                        ['url' => 'https://images-na.ssl-images-amazon.com/images/I/51-oeeCf1zL._SL1024_.jpg'],
                                        ['url' => 'https://images-na.ssl-images-amazon.com/images/I/413cU6KK6QL._SL1024_.jpg']
                                    ]
                    ],

                    /**** CLOTHES MAN ****/

                    [
                        'name_fr'        => 'Veste de costume',
                        'description_fr' => "CREEKS veste de costume",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'CREEKS',
                        'price' => '59.90',
                        'category_id' => 12,
                        'photos' => [
                                        ['url' => 'https://media.lahalle.com/media/catalog/product/cache/1/image/468x624/9df78eab33525d08d6e5fb8d27136e95/5/9/veste-de-costume-11-creeks-noir-3f8564d151477d3eb8f8c112d861ce8b-a.jpg'],
                                    ]
                    ],
                    [
                        'name_fr'        => 'Blazer',
                        'description_fr' => "Blazer Couleur: dark blue",
                        'information_fr' => "Composition: 84% polyester, 14% viscose, 2% élasthanne
                                            Doublure: 100% polyester
                                            Conseils d'entretien: Nettoyage à sec",
                        'brand' => 'KIOMO',
                        'price' => '45.90',
                        'category_id' => 12,
                        'photos' => [
                                        ['url' => 'https://media.lahalle.com/media/catalog/product/cache/1/image/468x624/9df78eab33525d08d6e5fb8d27136e95/5/9/veste-de-costume-11-creeks-noir-3f8564d151477d3eb8f8c112d861ce8b-a.jpg'],
                                    ]
                    ],
                    [
                        'name_fr'        => 'Bombers',
                        'description_fr' => "BOMBERS - MULTICOLORE / BEST MOUNTAIN",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'Best Mountain',
                        'price' => '53.94',
                        'category_id' => 12,
                        'photos' => [
                                        ['url' => 'https://media.brandalley.com/img_rayons/400x400/2018/07/27/401/2867401_1.jpg'],
                                    ]
                    ],
                    [
                        'name_fr'        => 'Bombers noir',
                        'description_fr' => "mj goose badge - bombers - noir",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'SOULSTAR',
                        'price' => '40.90',
                        'category_id' => 12,
                        'photos' => [
                                        ['url' => 'https://media.brandalley.com/img_rayons/400x400/2016/09/14/064/2216064_1.jpg'],
                                    ]
                    ],

                    /**** CLOTHES WOMAN ****/
                    [
                        'name_fr'        => 'Blouse Mode',
                        'description_fr' => "SUNSHINE BOW BLOUSE - Blouse",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'SISTER JANE',
                        'price' => '69.90',
                        'category_id' => 11,
                        'photos' => [
                                        ['url' => 'https://img01.ztat.net/article/QS/02/1E/04/TA/11/QS021E04T-A11@7.jpg?imwidth=1800'],
                                    ]
                    ],
                    [
                        'name_fr'        => 'Chemisier',
                        'description_fr' => "QUARTERS RUFFLE - Chemisier",
                        'information_fr' => "Composition: 84% polyester, 14% viscose, 2% élasthanne
                                            Doublure: 100% polyester
                                            Conseils d'entretien: Nettoyage à sec",
                        'brand' => 'SISTER JANE',
                        'price' => '64.90',
                        'category_id' => 11,
                        'photos' => [
                                        ['url' => 'https://img01.ztat.net/article/QS/02/1E/04/CJ/11/QS021E04C-J11@7.jpg?imwidth=1800'],
                            ]
                    ],
                    [
                        'name_fr'        => 'Chemisier',
                        'description_fr' => "PLUM BLOSSOM BLOUSE - Chemisier",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'SISTER JANE',
                        'price' => '69.95',
                        'category_id' => 11,
                        'photos' => [
                                        ['url' => 'https://img01.ztat.net/article/QS/02/1E/04/QJ/11/QS021E04Q-J11@10.jpg?imwidth=1800'],
                            ]
                    ],
                    [
                        'name_fr'        => 'Blouse',
                        'description_fr' => "NOTES BOW BLOUSE - Blouse",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'SISTER JANE',
                        'price' => '64.94',
                        'category_id' => 11,
                        'photos' => [
                                        ['url' => ''],
                            ]
                    ]

                    /***  CLOTHES BOY*****/
                    ,
                    [
                        'name_fr'        => 'Sweat Shirt',
                        'description_fr' => "JACK AND JONES Sweat à Capuche Logo Garçon Bordeaux",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'JACK AND JONES',
                        'price' => '17.96',
                        'category_id' => 17,
                        'photos' => [
                                        ['url' => 'https://resources.mandmdirect.com/Images/_default/j/j/4/jj4498_1_cloudzoom.jpg'],
                            ]
                    ],
                    [
                        'name_fr'        => 'Sweat Shirt',
                        'description_fr' => "Converse Sweat à Capuche Chuck Patch Garçon Bleu Clair Chiné",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'Converse',
                        'price' => '26.94',
                        'category_id' => 17,
                        'photos' => [
                                        ['url' => 'https://resources.mandmdirect.com/Images/_default/v/r/1/vr1826_1_cloudzoom.jpg'],
                            ]
                    ],
                    [
                        'name_fr'        => 'Sweat Shirt',
                        'description_fr' => "DFND London Sweat à Capuche Boomz Garçon Noir",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'DFND',
                        'price' => '20.95',
                        'category_id' => 17,
                        'photos' => [
                                        ['url' => 'https://resources.mandmdirect.com/Images/_default/d/f/6/df677_1_cloudzoom.jpg'],
                            ]
                    ],
                    [
                        'name_fr'        => 'Sweat Shirt',
                        'description_fr' => "Converse Sweat à Capuche Zippé Chuck Patch Garçon Rouge",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'CONVERSE',
                        'price' => '53.94',
                        'category_id' => 17,
                        'photos' => [
                                        ['url' => 'https://resources.mandmdirect.com/Images/_default/v/r/1/vr1827_1_cloudzoom.jpg'],
                            ]
                    ]


                    /*** CLOTHES GIRL ****/
                    ,
                    [
                        'name_fr'        => 'Pantalon',
                        'description_fr' => "Board Angels Pantalon Coeurs Imprimé Fille Noir",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'BOARD ANGEL',
                        'price' => '20.95',
                        'category_id' => 16,
                        'photos' => [
                                        ['url' => 'https://resources.mandmdirect.com/Images/_default/f/q/2/fq2655_1_cloudzoom.jpg'],
                            ]
                    ],
                    [
                        'name_fr'        => 'Legging',
                        'description_fr' => "Beck And Hersey Legging Lyla Fille Blanc",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'BECK AND HERSEY',
                        'price' => '13.95',
                        'category_id' => 16,
                        'photos' => [
                                        ['url' => 'https://resources.mandmdirect.com/Images/_default/b/y/3/by393_1_cloudzoom.jpg'],
                            ]
                    ],
                    [
                        'name_fr'        => 'Pantalon',
                        'description_fr' => "MINOTI Pantalon Wonder Shimmer Twill Fille Bleu Marine",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'MINOTI',
                        'price' => '6.95',
                        'category_id' => 16,
                        'photos' => [
                                        ['url' => 'https://resources.mandmdirect.com/Images/_default/m/2/6/m262_1_cloudzoom.jpg'],
                            ]
                    ],
                    [
                        'name_fr'        => 'Collant',
                        'description_fr' => "Under Armour Collant de Course HG HeatGear Armour Imprimé Fille Bleu",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'UNDER ARMOUR',
                        'price' => '17.95',
                        'category_id' => 16,
                        'photos' => [
                                        ['url' => 'https://resources.mandmdirect.com/Images/_default/u/j/2/uj2161_1_cloudzoom.jpg'],
                            ]
                    ]


                    /***** CLOTHES BABY****/
                    ,
                    [
                        'name_fr'        => '3 Pyjamas',
                        'description_fr' => "Lot de 3 pyjamas 0 mois - 3 ans blanc + bleu + rayé LA REDOUTE COLLECTIONS",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'LA REDOUTE',
                        'price' => '19.54',
                        'category_id' => 18,
                        'photos' => [
                                        ['url' => 'https://cdn.laredoute.com/products/680by680/0/9/b/09b0ff719f4dfd794d0934ffb5347287.jpg'],
                            ]
                    ],
                    [
                        'name_fr'        => 'T-shirt',
                        'description_fr' => "T-shirt à motif animalier bébé fille",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'OBAIBI',
                        'price' => '5.99',
                        'category_id' => 18,
                        'photos' => [
                                        ['url' => 'https://media.idkids.fr/media/productstorage/images/okaidi/0094088/thumbs/0235502_800.jpg'],
                            ]
                    ],
                    [
                        'name_fr'        => 'T-shirt',
                        'description_fr' => "T-shirt à motifs pailletés bébé fille",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'OBAIBI',
                        'price' => '6.99',
                        'category_id' => 18,
                        'photos' => [
                                        ['url' => 'https://media.idkids.fr/media/productstorage/images/okaidi/0094090/thumbs/0235470_800.jpg'],
                            ]
                    ],
                    [
                        'name_fr'        => 'T-shirt',
                        'description_fr' => "T-shirt rayé à motif bébé fille",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'OBAIBI',
                        'price' => '53.94',
                        'category_id' => 18,
                        'photos' => [
                                        ['url' => 'https://media.idkids.fr/media/productstorage/images/okaidi/0094089/thumbs/0235483_800.jpg'],
                            ]
                    ]

                    /**** RANDOM ITEMS ****/

                    ,
                    [
                        'name_fr'        => 'Télévison Led Monitor',
                        'description_fr' => 'Samsung S24F354 Ecran PC, Dalle Pls 24", Résolution FHD (1920 x 1080), 60 Hz, 4ms, AMD Freesync, Noir',
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'SAMSUNG',
                        'price' => '97.94',
                        'category_id' => 7,
                        'photos' => [
                                        ['url' => 'https://images-na.ssl-images-amazon.com/images/I/81rEWNXkBWL._SL1500_.jpg'],
                            ]
                    ],
                    [
                        'name_fr'        => 'Galaxy A20',
                        'description_fr' => "Samsung A202F Galaxy A20e (Black) débloqué Logiciel Original",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'SAMSUNG',
                        'price' => '166.65',
                        'category_id' => 4,
                        'photos' => [
                                        ['url' => 'https://images-na.ssl-images-amazon.com/images/I/81mFCePJoIL._SL1500_.jpg'],
                            ]
                    ],
                    [
                        'name_fr'        => 'Ensemble de serviettes',
                        'description_fr' => "BUNDMAN Ensembles de Serviettes en Coton avec 6 essuie-Mains et 6 débarbouillettes Collection de Serviettes à la Maison pour Salle de Bain",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'BUNDMAN',
                        'price' => '32.94',
                        'category_id' => 15,
                        'photos' => [
                                        ['url' => 'https://images-na.ssl-images-amazon.com/images/I/818NUYoQHSL._SL1500_.jpg'],
                            ]
                    ],
                    [
                        'name_fr'        => 'Coffret cadeau',
                        'description_fr' => "OOTB Coffret Cadeau Plateau avec Bougie Chauffe-Plat, Multicolore, 20 x 20 x 8",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'OOTB',
                        'price' => '17.50',
                        'category_id' => 14,
                        'photos' => [
                                        ['url' => 'https://images-na.ssl-images-amazon.com/images/I/41-mpnPVtsL.jpg'],
                            ]
                    ],
                    [
                        'name_fr'        => 'PS4',
                        'description_fr' => "Sony PlayStation 4 Pro 1 To, Avec 1 Manette Sans Fil Dualshock 4 V2, Châssis G, Noir (Jet Black), Art : 9752316",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'SONY',
                        'price' => '358.99',
                        'category_id' => 6,
                        'photos' => [
                                        ['url' => 'https://images-na.ssl-images-amazon.com/images/I/71GWJXGeZsL._SL1500_.jpg'],
                            ]
                    ],
                    [
                        'name_fr'        => 'Tomb Raider',
                        'description_fr' => "Shadow of the Tomb Raider - Edition Mini - Guide Digital Exclusif Amazon",
                        'information_fr' => 'COMPOSITION & ENTRETIEN
                                            82 polyester 16 viscose 2 élasthanne
                                            Information entretien article
                                            Lavable en machine',
                        'brand' => 'CRYSTAL DYNAMICS',
                        'price' => '53.94',
                        'category_id' => 6,
                        'photos' => [
                                        ['url' => 'https://images-na.ssl-images-amazon.com/images/I/61tr594XHvL._SL1000_.jpg'],
                            ]
                    ]
                    
                    

        ];





        return $datas;
    }
}
