<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
// création de l'entité en ligne de commande avec "php bin/console make:entity
/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    //création de la propriété de de la table créée généré grâce au terminal
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;
    // les propriétées sont créées en private
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    //je créé un mapping d'entité pour lier la cardinalitée entre articles et category
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Post", mappedBy="category")
     */
    private $posts;
    // je créé un constructeur pour définir mon entité articles comme
    // étant un tableau pouvant contenir plusieurs article
    public function __construct()
    {
       $this->posts = new ArrayCollection();
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;
    //Les getteurs et setteurs sont généré automatiquement
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

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function isIsPublished(): ?bool
    {
        return $this->isPublished;
    }

    public function setIsPublished(bool $isPublished): self
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param ArrayCollection $posts
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
    }


    // une fois les propriété rentrée j'utilise la commande php bin/console make:migration
    //pour rassembler les éléments de ma base de donée avant de les migrer
    //Puis la commande php bin/console doctrine:migration:migrate pour faire migrer la base de donnée
    // vers le serveur

}
