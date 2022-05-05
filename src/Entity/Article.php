<?php

namespace App\Entity;

use App\Entity\Categorie;
use Doctrine\ORM\Mapping as ORM;
use App\Controller\ArticleController;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Article
 *
 * @ORM\Table(name="article", indexes={@ORM\Index(name="categorie_id", columns={"categorie_id"})})
 * @ORM\Entity
 * 
 */
#[ApiResource(
    collectionOperations:[
        'get',
        'post' => [
            // "controller" => ArticleController::class,
            "denormalization_context" => [
                "groups" => ["post:article"]
            ]
        ]
    ],
    itemOperations:['get']
)]
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=120, nullable=false)
     */
    #[Groups(["read:category", "post:article"])]
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true)
     */
    #[Groups(["post:article"])]
    private $content;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="articles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categorie_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $categorie;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \Datetime
     */
    private \Datetime $createdAt;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get the value of createdAt
     *
     * @return \Datetime
     */
    public function getCreatedAt(): \Datetime
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @param \Datetime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(\Datetime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
