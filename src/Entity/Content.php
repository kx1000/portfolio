<?php

namespace App\Entity;

use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ContentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     itemOperations={
 *         "get"={
 *             "controller"=NotFoundAction::class,
 *             "read"=false,
 *             "output"=false,
 *         },
 *     },
 *     collectionOperations={}
 * )
 * @ORM\Entity(repositoryClass=ContentRepository::class)
 */
class Content
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotNull
     * @Assert\Length(max=1500)
     * @Groups("get_page")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=Page::class, inversedBy="contents")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull
     */
    private $page;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     * @Groups("get_page")
     */
    private $name;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getPage(): ?Page
    {
        return $this->page;
    }

    public function setPage(?Page $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
