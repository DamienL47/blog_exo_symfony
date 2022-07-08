<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use \Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{

    /**
     * @Route("admin/insert-category", name="admin_insert_category")
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
     * @Route("/admin/categories/{id}", name="admin_category")
     */
    public function showCategory($id, CategoryRepository $categoryRepository)
    {
        // Récupérer depuis la base de données un article
        // en fonction d'un id
        //donc un SELECT * FROM article where id = xxx

        // La classe repository me permet de faire des requete dans la table
        //La méthode find permet de récupérer un élément

        $category = $categoryRepository->find($id);

        return $this->render('admin/category.html.twig', [
            'category' => $category
        ]);
    }

    /**
     * @Route("/admin/categories", name="admin_categories")
     */
    public function listCategory(CategoryRepository $listCategory)
    {
        $listCategory = $listCategory->findAll();

        return $this->render('admin/categories.html.twig', [
            'categories' => $listCategory
        ]);
    }

    /**
     * @Route("admin/delete_category/{id}", name="admin_delete_category")
     */
    public function deleteCategory($id, CategoryRepository $deleteCatRepository, EntityManagerInterface $entityManager)
    {
        $deleteCategory = $deleteCatRepository->find($id);

        if(!is_null($deleteCategory)){
            $entityManager->remove($deleteCategory);
            $entityManager->flush();
            new Response('Categorie supprimé');
            return $this->redirectToRoute('admin_categories');
        } else {
            return new Response('Catégorie non trouvé ');
        }
    }

    // Je créé ma route vers la page de modification
    /**
     * @Route("/admin/update/category/{id}", name="admin_update_category")
     */
    // J'instancie ma classe en lui passant les méthodes de classe en parametre
    // la methode repository me permet de cibler la table
    // entity manager me permettra d'effectuer la méthode sur le serveur
    public function updateCategory($id, CategoryRepository $updateCatRepository, EntityManagerInterface $entityManager)
    {
        //Je cible l'id grâce à la méthode find
        $category = $updateCatRepository->find($id);
        // je selectionne l'élément de la catégory à modifier grâce au setter
        $category -> setTitle('nouveau titre');
        //j'appelle la méthode entity manager pour "persister" (enregistrer) les modifications de ma catégory
        //Puis je flush les changement pour qu'il soit envoyé dans la base de donnée.
        $entityManager->persist($category);
        $entityManager->flush();



    }

}