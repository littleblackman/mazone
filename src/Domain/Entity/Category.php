<?php

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass="App\Domain\Repository\CategoryRepository")
 */
class Category extends baseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name_fr", type="string", length=250, nullable=true)
     */
    private $nameFr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name_en", type="string", length=250, nullable=true)
     */
    private $nameEn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="constant_key", type="string", length=250, nullable=true)
     */
    private $constantKey;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description_fr", type="string", nullable=true)
     */
    private $descriptionFr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description_en", type="string", nullable=true)
     */
    private $descriptionEn;

    /**
    * @var ArrayCollection
    * @ORM\OneToMany(targetEntity="Product", mappedBy="category", cascade={"remove"}))
    * @ORM\OrderBy({"nameFr" = "ASC"})
    */
    private $products;

    /**
    * @ORM\ManyToOne(targetEntity="Category")
    * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
    */
    private $parent;

    /**
    * @var ArrayCollection
    */
    private $childs;

    /**
     * @var string|null
     *
     * @ORM\Column(name="slug", type="string", length=250, nullable=true)
     */
    private $slug;


    public function __construct() {
        $this->products = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameFr(): ?string
    {
        return $this->nameFr;
    }

    public function setNameFr(?string $nameFr): self
    {
        $this->nameFr = $nameFr;

        return $this;
    }

    public function getConstantKey(): ?string
    {
        return $this->constantKey;
    }

    public function setConstantKey(?string $constantKey): self
    {
        $this->constantKey = $constantKey;

        return $this;
    }


    public function getNameEn(): ?string
    {
        return $this->nameEn;
    }

    public function setNameEn(?string $nameEn): self
    {
        $this->nameEn = $nameEn;

        return $this;
    }

    public function getDescriptionFr(): ?string
    {
        return $this->descriptionFr;
    }

    public function setDescriptionFr(?string $descriptionFr): self
    {
        $this->descriptionFr = $descriptionFr;

        return $this;
    }

    public function getDescriptionEn(): ?string
    {
        return $this->descriptionEn;
    }

    public function setDescriptionEn(?string $descriptionEn): self
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    public function addProduct($product) {
        $this->products[] = $product;
        return $this;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function setParent(Category $category) {
        $this->parent = $category;
        return $this;
    }

    public function getParent() {
        return $this->parent;
    }

    public function setChilds($subcategories) {
        $this->childs = $subcategories;
    }

    public function getChilds() {
        return $this->childs;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }



}
