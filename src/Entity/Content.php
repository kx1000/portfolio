<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ContentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={
 *         "get"
 *     },
 *     itemOperations={
 *         "get"
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"name": "exact"})
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
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(max=1500)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=Page::class, inversedBy="contents")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotNull
     */
    private $page;

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
}
