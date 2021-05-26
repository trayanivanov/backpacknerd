<?php

namespace App\Entity;

use App\Repository\ArticleMediaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleMediaRepository::class)
 * @ORM\Table(
 *     name="articles_media",
 *     indexes={
 *         @ORM\Index(name="article_index", columns={"article_id"}),
 *     },
 * )
 */
class ArticleMedia
{
    const TYPE_THUMB = 'thumb';
    const TYPE_HEADER = 'header';
    const TYPE_LIFESTYLE = 'lifestyle';
    const TYPE_VIDEO = 'video';

    use TimestampableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="articleMedia", cascade={"remove"})
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", onDelete="CASCADE", nullable=false)
     */
    private $article;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $thumbName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    public function getId(): int
    {
        return $this->id;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }

    public function setArticle(Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getThumbName(): ?string
    {
        return $this->thumbName;
    }

    public function setThumbName(string $thumbName): self
    {
        $this->thumbName = $thumbName;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
