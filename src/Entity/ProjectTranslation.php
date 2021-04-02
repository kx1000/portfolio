<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Locastic\ApiPlatformTranslationBundle\Model\AbstractTranslation;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 */
class ProjectTranslation extends AbstractTranslation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Project", inversedBy="translations")
     * @Assert\NotNull
     */
    protected $translatable;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(max=255)
     * @Groups({"read_project", "translations"})
     */
    private $subtitle;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(max=1500)
     * @Groups({"read_project", "translations"})
     */
    private $body;

    /**
     * @ORM\Column(type="string")
     * @Groups({"read_project", "translations"})
     */
    protected $locale;

    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    public function setSubtitle(?string $subtitle): self
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }
}