<?php

namespace App\Entity;

use App\Repository\ArticleCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleCategoryRepository::class)
 * @ORM\Table(
 *     name="articles_categories",
 *     uniqueConstraints={
 *         @ORM\UniqueConstraint(name="slug", columns={"slug"}),
 *         @ORM\UniqueConstraint(name="name", columns={"name"}),
 *     }
 * )
 */
class ArticleCategory
{
    use TimestampableTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="boolean", options={"default": true})
     */
    private $active = true;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="articleCategory")
     */
    protected $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getArticles(): Collection
    {
        return $this->articles;
    }
}
