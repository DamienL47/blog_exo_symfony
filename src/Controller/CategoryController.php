<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
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
    /**
     * @Route("category", name="category")
     */
    public function showCategory(CategoryRepository $categoryRepository)
    {
        // Récupérer depuis la base de données un article
        // en fonction d'un id
        //donc un SELECT * FROM article where id = xxx

        // La classe repository me permet de faire des requete dans la table
        //La méthode find permet de récupérer un élément

        $category = $categoryRepository->find(1);

        dd($category);
    }

    /**
     * @Route("list_category", name="list_category")
     */
    public function listCategory(CategoryRepository $listCategory)
    {
        $listCategory = $listCategory->findAll();

        dd($listCategory);
    }
}