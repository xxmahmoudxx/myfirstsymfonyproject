<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $publicate_date = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(nullable: true)]
    private ?bool $published = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    private ?author $auth = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getPublicateDate(): ?string
    {
        return $this->publicate_date;
    }

    public function setPublicateDate(?string $publicate_date): static
    {
        $this->publicate_date = $publicate_date;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(?bool $published): static
    {
        $this->published = $published;

        return $this;
    }

    public function getAuth(): ?author
    {
        return $this->auth;
    }

    public function setAuth(?author $auth): static
    {
        $this->auth = $auth;

        return $this;
    }
}
