<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

//Je créé une entité avec des annotations qui sera créé en table gr^ce au framework Doctrine utilisé par symfony "Objet Relationnel de Mapping" (ORM)
/**
 * @ORM\Entity()
 */
// je créé une classe pour définir le nom de la table en BDD
class Article
{
    //je fait une propriété et je la mappe en lui passant les valeurs des colonnes
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    // Je lui passe ensuite le titre de la colonne en méthode
    public $id;

    /**
     * @ORM\Column(type="string")
     */
    public $title;
    // ajout d'une colonne image
    /**
     * @ORM\Column(type="string")
     */
    public $image;
    // ajout d'une colonne booléenne publié ou non
    /**
     * @ORM\Column(type="boolean")
     */
    public $isPublished;
    // ajout d'une colonne auteur
    /**
     * @ORM\Column(type="string")
     */
    public $author;
}