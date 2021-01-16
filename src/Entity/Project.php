<?php

namespace App\Entity;

use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"read_project"}},
 *     collectionOperations={
 *         "get"
 *     },
 *     itemOperations={
 *         "get"={
 *             "controller"=NotFoundAction::class,
 *             "read"=false,
 *             "output"=false,
 *         },
 *     },
 *     attributes={"order"={"listOrder": "ASC"}}
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
     * @Groups("read_project")
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(max=1500)
     * @Groups("read_project")
     */
    private $body;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     * @Groups("read_project")
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="projects_images", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     * @Groups("read_project")
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
     * @Groups("read_project")
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Type("DateTime")
     */
    private $vichUpdatedAt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Groups("read_project")
     */
    private $listOrder;

    /**
     * @ORM\OneToMany(targetEntity=Link::class, mappedBy="project", cascade={"persist"}, orphanRemoval=true)
     * @Groups("read_project")
     */
    private $links;

    /**
     * @ORM\OneToMany(targetEntity=Technology::class, mappedBy="project", cascade={"persist"}, orphanRemoval=true)
     * @Groups("read_project")
     */
    private $technologies;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     * @Groups("read_project")
     */
    private $year;

    public function __construct()
    {
        $this->vichUpdatedAt = new \DateTime();
        $this->links = new ArrayCollection();
        $this->technologies = new ArrayCollection();
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

    public function getListOrder(): ?int
    {
        return $this->listOrder;
    }

    public function setListOrder(?int $listOrder): self
    {
        $this->listOrder = $listOrder;

        return $this;
    }

    /**
     * @return Collection|Link[]
     */
    public function getLinks(): Collection
    {
        return $this->links;
    }

    public function addLink(Link $link): self
    {
        if (!$this->links->contains($link)) {
            $this->links[] = $link;
            $link->setProject($this);
        }

        return $this;
    }

    public function removeLink(Link $link): self
    {
        if ($this->links->contains($link)) {
            $this->links->removeElement($link);
            // set the owning side to null (unless already changed)
            if ($link->getProject() === $this) {
                $link->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Technology[]
     */
    public function getTechnologies(): Collection
    {
        return $this->technologies;
    }

    public function addTechnology(Technology $technology): self
    {
        if (!$this->technologies->contains($technology)) {
            $this->technologies[] = $technology;
            $technology->setProject($this);
        }

        return $this;
    }

    public function removeTechnology(Technology $technology): self
    {
        if ($this->technologies->contains($technology)) {
            $this->technologies->removeElement($technology);
            // set the owning side to null (unless already changed)
            if ($technology->getProject() === $this) {
                $technology->setProject(null);
            }
        }

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): self
    {
        $this->year = $year;

        return $this;
    }
}
