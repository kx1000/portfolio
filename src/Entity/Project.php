<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProjectRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get"
 *     },
 *     itemOperations={
 *         "get"
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"slug": "exact"})
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 * @Vich\Uploadable()
 */
class Project
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
     * @Assert\NotNull
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(max=1500)
     */
    private $body;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="projects_images", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     */
    private $animation;

    /**
     * @Vich\UploadableField(mapping="projects_animations", fileNameProperty="animation")
     */
    private $animationFile;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255)
     * @Assert\NotNull
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Type("DateTime")
     */
    private $vichUpdatedAt;

    public function __construct()
    {
        $this->vichUpdatedAt = new \DateTime();
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

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getAnimation(): ?string
    {
        return $this->animation;
    }

    public function setAnimation(?string $animation): self
    {
        $this->animation = $animation;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param mixed $imageFile
     */
    public function setImageFile($imageFile): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->setVichUpdatedAt(new \DateTime());
        }
    }

    /**
     * @return mixed
     */
    public function getAnimationFile()
    {
        return $this->animationFile;
    }

    /**
     * @param mixed $animationFile
     */
    public function setAnimationFile($animationFile): void
    {
        $this->animationFile = $animationFile;

        if (null !== $animationFile) {
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
