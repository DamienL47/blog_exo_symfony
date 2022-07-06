<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

//Je créé un Objet Relationnel de Mapping (ORM) gr^ce au framework Doctrine utilisé par symfony
/**
 * @ORM\Entity()
 */
// je créé une classe pour définir le nom de la table en BDD
class Article
{
    //j'instancie ma classe en lui passant les valeurs des colonnes
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

}