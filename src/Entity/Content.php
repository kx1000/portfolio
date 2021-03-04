<?php

namespace App\Entity;

use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ContentRepository;
use Doctrine\ORM\Mapping as ORM;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslatable;
use Locastic\ApiPlatformTranslationBundle\Model\TranslationInterface;
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
class Content extends AbstractTranslatable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
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
     * @Assert\NotNull
     * @Groups("get_page")
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ContentTranslation", mappedBy="translatable", fetch="EXTRA_LAZY", indexBy="locale", cascade={"PERSIST"}, orphanRemoval=true)
     * @Groups({"get_page", "translations"})
     */
    protected $translations;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->getTranslation()->getValue();
    }

    public function setValue(?string $value): self
    {
        $this->getTranslation()->setValue($value);

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

    protected function createTranslation(): TranslationInterface
    {
        return new ContentTranslation();
    }
}
