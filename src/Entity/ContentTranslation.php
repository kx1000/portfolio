<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslation;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class ContentTranslation extends AbstractTranslation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Content", inversedBy="translations")
     * @Assert\NotNull
     */
    protected $translatable;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=1500)
     * @Groups({"get_page", "translations"})
     */
    private $value;

    /**
     * @ORM\Column(type="string")
     *
     * @Groups({"get_page", "translations"})
     */
    protected $locale;

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }
}