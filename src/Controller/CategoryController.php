<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    /**
     * @Route("insert-category", name="insert_category")
     */
    public function insertCategory(EntityManagerInterface $entityManager)
    {
        //Je recommence la même chose pour category ...
        $category = new Category();

        $category->setTitle('Legumes');
        $category->setColor('violet');
        $category->setDescription("l'aubergine est un très gros légume violet ");
        $category->setIsPublished('true');

        $entityManager->persist($category);
        $entityManager->flush();

        dd($category);
    }
}