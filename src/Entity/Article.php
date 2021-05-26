<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 * @ORM\Table(
 *     name="articles",
 *     indexes={
 *         @ORM\Index(name="article_category_index", columns={"article_category_id"}),
 *     },
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="slug", columns={"slug"}),
 *         @ORM\UniqueConstraint(name="title", columns={"title"}),
 *     }
 * )
 */
class Article
{
    use TimestampableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=ArticleCategory::class, inversedBy="articles")
     * @ORM\JoinColumn(name="article_category_id", referencedColumnName="id", nullable=false)
     */
    private $articleCategory;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $body;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $favourite = false;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $active = false;

    /**
     * @ORM\OneToMany(targetEntity=ArticleMedia::class, mappedBy="article")
     */
    private $articleMedia;

    public function __construct()
    {
        $this->articleMedia = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getArticleCategory(): ArticleCategory
    {
        return $this->articleCategory;
    }

    public function setArticleCategory(ArticleCategory $articleCategory): self
    {
        $this->articleCategory = $articleCategory;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getFavourite(): bool
    {
        return $this->favourite;
    }

    public function setFavourite(bool $favourite): self
    {
        $this->favourite = $favourite;

        return $this;
    }

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getArticleMedia(): Collection
    {
        return $this->articleMedia;
    }

    public function getArticleMediaThumb(): ArticleMedia
    {
        $thumb = $this->getArticleMedia()->filter(function (ArticleMedia $articleMedia) {
           return $articleMedia->getType() === ArticleMedia::TYPE_THUMB;
        });

        return $thumb->first();
    }

    public function getArticleMediaHeader(): ArticleMedia
    {
        $header = $this->getArticleMedia()->filter(function (ArticleMedia $articleMedia) {
            return $articleMedia->getType() === ArticleMedia::TYPE_HEADER;
        });

        return $header->first();
    }

    public function getArticleMediaVideo(): ArticleMedia
    {
        $video = $this->getArticleMedia()->filter(function (ArticleMedia $articleMedia) {
            return $articleMedia->getType() === ArticleMedia::TYPE_VIDEO;
        });

        return $video->first();
    }

    public function getArticleMediaLifestyle(): Collection
    {
        return $this->getArticleMedia()->filter(function (ArticleMedia $articleMedia) {
            return $articleMedia->getType() === ArticleMedia::TYPE_LIFESTYLE;
        });
    }
}
