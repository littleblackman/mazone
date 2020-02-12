<?php

namespace App\Domain\Entity;

use App\Domain\Entity\Detail;
use App\Domain\Entity\baseEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Repository\ProductRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Product extends baseEntity
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
     * @ORM\Column(name="description_fr", type="text", nullable=true)
     */
    private $descriptionFr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description_en", type="text", nullable=true)
     */
    private $descriptionEn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="information_fr", type="text", nullable=true)
     */
    private $informationFr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="information_en", type="text", nullable=true)
     */
    private $informationEn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="brand", type="string", length=250, nullable=true)
     */
    private $brand;

    /**
     * @var float|null
     *
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;

    /**
     * @var float|null
     *
     * @ORM\Column(name="delivery_price", type="float", nullable=true)
     */
    private $deliveryPrice;

    /**
    * @var ArrayCollection
    * @ORM\OneToMany(targetEntity="Detail", mappedBy="product", cascade={"remove"}))
    * @ORM\OrderBy({"nameFr" = "ASC"})
    */
    private $details;


    /**
    * @var ArrayCollection
    * @ORM\OneToMany(targetEntity="Photo", mappedBy="product", cascade={"persist","remove"}))
    */
    private $photos;

    /**
     * @var int|null
     *
     * @ORM\Column(name="liked", type="integer", nullable=true)
     */
    private $liked;

    /**
     * @var int|null
     *
     * @ORM\Column(name="solded", type="integer", nullable=true)
     */
    private $solded;

    /**
    * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
    * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true)
    */
    private $category;

    /**** base entity ****/

        /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @var String
     *
     * @ORM\Column(name="created_by", type="string", length=250, nullable=true)
     */
    protected $createdBy;

    /**
     * @var String
     *
     * @ORM\Column(name="updated_by", type="string", length=250, nullable=true)
     */
    protected $updatedBy;

    /**
     * @var int
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    protected $isActive;

    /**
     * @var int
     *
     * @ORM\Column(name="is_archived", type="boolean", nullable=true)
     */
    protected $isArchived;


    public function __construct() {
        $this->details = new ArrayCollection();
        $this->photos = new ArrayCollection();
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

    public function getInformationFr(): ?string
    {
        return $this->informationFr;
    }

    public function setInformationFr(?string $informationFr): self
    {
        $this->informationFr = $informationFr;

        return $this;
    }

    public function getInformationEn(): ?string
    {
        return $this->informationEn;
    }

    public function setInformationEn(?string $informationEn): self
    {
        $this->informationEn = $informationEn;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(?string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }


    public function getDeliveryPrice(): ?float
    {
        return $this->deliveryPrice;
    }

    public function setDeliveryPrice(?float $deliveryPrice): self
    {
        $this->deliveryPrice = $deliveryPrice;

        return $this;
    }
 
    public function addPhoto(Photo $photo)
    {
        $this->photos[] = $photo;
        $photo->setProduct($this);
        return $this;
    }

    public function removePhoto($photo)
    {
        $this->photos->removeElement($photo);
        return $this;
    }

    public function getPhotos()
    {
        return $this->photos;
    }

    public function addDetail(Detail $detail)
    {
        $this->details[] = $detail;
        $detail->setProduct($this);
        return $this;
    }

    public function removeDetail($detail)
    {
        $this->details->removeElement($detail);
        return $this;
    }

    public function getDetails()
    {
        return $this->details;
    }

    public function setCategory(Category $category) {
        $this->category = $category;
        $category->addProduct($this);
    }

    public function getCategory() {
        return $this->category;
    }

    public function setLiked(?int $like): ?self
    {
        $this->liked = $like;
        return $this;
    }

    public function getLiked(): ?int
    {
        return $this->liked;
    }

    public function setSolded(?int $solded): ?self
    {
        $this->solded = $solded;
        return $this;
    }

    public function getSolded(): ?int
    {
        return $this->solded;
    }

    /**** base entity methods ****/


    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return LbmCompany
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return LbmCompany
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdBy
     *
     * @param string $createdBy
     *
     * @return String
     */
    public function setCreatedBy($user)
    {
        $this->createdBy = $user;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return String
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param string $updatedBy
     *
     * @return LbmCompany
     */
    public function setUpdatedBy(User $user)
    {
        $this->updatedBy = $user;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return User
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     *
     * set is_active value
     *
     * @param $is_active
     * @return $this
     */
    public function setIsActive($is_active)
    {
        $this->isActive = $is_active;
        return $this;
    }

    /**
     *
     * get is_active value
     * @return int
     */
    public function getIsActive()
    {
        return $this->isActive;
    }


    /**
     *
     * set is_archived value
     *
     * @param $is_archived
     * @return $this
     */
    public function setIsArchived($is_archived)
    {
        $this->isArchived = $is_archived;
        return $this;
    }

    /**
     *
     * get is_archived value
     * @return int
     */
    public function getIsArchived()
    {
        return $this->isArchived;
    }


    /********* PRE PERSIST ************/

    /**
     * @ORM\PrePersist
     */
    public function updateAt()
    {
        $this->setUpdatedAt(new \Datetime());

    }

    /**
     * @ORM\PrePersist
     */
    public function createdAt()
    {
        if($this->createdAt == null) $this->setCreatedAt(new \Datetime());
    }

    /**
     * @ORM\PrePersist
     */
    public function isActive()
    {
        if(!$this->isActive) $this->is_active = 1;
    }

    /**
     * @ORM\PrePersist
     */
    public function isArchived()
    {
        if(!$this->isArchived) $this->is_archived = 0;
    }
    /**
     * @ORM\PrePersist
     */
    public function createdBy()
    {
        /*
        if($this->tokenStorage()->getToken()->getUser() && ($this->createdBy == null || $this->createdBy == "")) {
            $this->createdBy = $tokenStorage()->getToken()->getUser()->getUsername();
        }*/
    }

    /**
     * @ORM\PrePersist
     */
    public function updatedBy()
    {
        /*
        if($user = $this->tokenStorage()->getToken()->getUser()) {
            $this->createdBy = $user->getUsername();
        }*/
    }
}
