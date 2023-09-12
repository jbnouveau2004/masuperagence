<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: PictureRepository::class)]
#[Vich\Uploadable]
// /**
//  * @Vich\Uploadable()
//  */
class Picture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $filename = null;

    #[ORM\ManyToOne(inversedBy: 'pictures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Bien $bien = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    // /**
    //  * @var File|null
    //  * @Assert\Image(
    //  *      mimeTypes="image/jpeg"
    //  * )
    //  * @Vich\UploadableField(mapping="bien_image", fileNameProperty="filename")
    //  */
    // private $imageFile;

    #[Vich\UploadableField(mapping: 'bien_image', fileNameProperty: 'filename')]
    private ?File $imageFile = null;

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getBien(): ?Bien
    {
        return $this->bien;
    }

    public function setBien(?Bien $bien): self
    {
        $this->bien = $bien;

        return $this;
    }

    // /**
    //  * @return null|File
    //  */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    // /**
    //  * @param null|File $imageFile
    //  * @return self
    //  */
    public function setImageFile(?File $imageFile): self
    {
        $this->imageFile = $imageFile;
        // if ($this->imageFile instanceof UploadedFile) {
        //     $this->updated_at = new \DateTime('now');
        // }
        return $this;
    }
}
