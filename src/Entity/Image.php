<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 * @Vich\Uploadable()
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255)
     */
    private $name;

    /**
     * @Vich\UploadableField(mapping="images", fileNameProperty="name")
     * @Assert\NotNull
     */
    private $file;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Type("DateTime")
     * @Assert\NotNull
     */
    private $vichUpdatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile($file): void
    {
        $this->file = $file;

        if (null !== $file) {
            $this->setVichUpdatedAt(new \DateTime());
        }
    }

    public function getVichUpdatedAt(): ?\DateTimeInterface
    {
        return $this->vichUpdatedAt;
    }

    public function setVichUpdatedAt(\DateTimeInterface $vichUpdatedAt): self
    {
        $this->vichUpdatedAt = $vichUpdatedAt;

        return $this;
    }
}
