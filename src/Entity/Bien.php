<?php

namespace App\Entity;

use App\Repository\BienRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: BienRepository::class)]
class Bien
{

    const HEAT = [
        0 => 'Electrique',
        1 => 'Gaz',
        2 => 'Fioul',
        3 => 'Bois',
        4 => 'Pellet'
    ];

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $surface = null;

    #[ORM\Column]
    private ?int $rooms = null;

    #[ORM\Column]
    private ?int $bedrooms = null;

    #[ORM\Column]
    private ?int $floor = null;

    #[ORM\Column]
    private ?int $prix = null;

    #[ORM\Column]
    private ?int $heat = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $postal_code = null;

    #[ORM\Column(options: ["default"=>false])]
    private ?bool $sold = false;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\OneToMany(mappedBy: 'bien', targetEntity: Picture::class, orphanRemoval: true, cascade: ['persist'])]
    private Collection $pictures;

        /**
     * @Assert\All({
     *  @Assert\Image(mimeTypes="image/jpeg")
     * })
     */
    private $pictureFiles;

    // #[ORM\Column(type: 'datetime')]
    // private ?\DateTimeInterface $updated_at = null;

    public function __construct()
    {
        $this->created_at = new \DateTime();
        $this->pictures = new ArrayCollection();
        // $this->updated_at = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;


        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

    public function setBedrooms(int $bedrooms): self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getHeat(): ?int
    {
        return $this->heat;
    }

    public function getHeatType(): string
    {
        return self::HEAT[$this->heat];
    }

    public function setHeat(int $heat): self
    {
        $this->heat = $heat;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    public function isSold(): ?bool
    {
        return $this->sold;
    }

    public function setSold(bool $sold): self
    {
        $this->sold = $sold;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    // /**
    //  * @return Collection<int, Picture>
    //  */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function getPicture(): ?Picture
    {
        if ($this->pictures->isEmpty()){
            return null;
        }
        return $this->pictures[0]; // ou return $this->pictures->first();
    }   

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setBien($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getBien() === $this) {
                $picture->setBien(null);
            }
        }

        return $this;
    }

    //     /**
    //  * @return mixed
    //  */
    public function getPictureFiles()
    {
        return $this->pictureFiles;
    }

    // /**
    //  * @param mixed $pictureFiles
    //  * @return Bien
    //  */
    public function setPictureFiles($pictureFiles): self
    {
        foreach($pictureFiles as $pictureFile){
            $picture = new Picture();
            $picture->setImageFile($pictureFile);
            $this->addPicture($picture);
        }
        $this->pictureFiles = $pictureFiles;
        return $this;
    }

    // public function getUpdatedAt(): ?\DateTimeInterface
    // {
    //     return $this->updated_at;
    // }

    // public function setUpdatedAt(\DateTimeInterface $updated_at): self
    // {
    //     $this->updated_at = $updated_at;
    //     // $this->updated_at = new \DateTimeImmutable();
    //     // $this->updated_at = new \DateTime('now');
    //     // if ($this->imageFile instanceof UploadedFile) {
    //     //     $this->updated_at = new \DateTime('now');
    //     // }
    //     // $this->updated_At = new \DateTimeImmutable();
    //     return $this;
    // }

}
