<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
use \Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoryController extends AbstractController
{
    // Je créé une route vers ma page d'insert category
    /**
     * @Route("admin/insert-category", name="admin_insert_category")
     */

    // j'instancie ma classe grâce à la méthode insertCategory et Request pour pouvoir gérer ma base de donnée
    // existante
    public function insertCategory(EntityManagerInterface $entityManager, Request $request)
    {
        //Je défini une variable pour chaque élément de mon formulaire dont je récupère la valeur grâce
        //à la classe request et aux fonctions query et get dont la clé me permet de cibler les colonnes de ma BDD.
//        $title = $request->query->get('title');
//        $color = $request->query->get('color');
//        $description = $request->query->get('description');

        // Je teste si la catégory existe
//        if($request->query->has('title') && $request->query->has('color') && $request->query->has('description')){
//
//            // si elle existe je teste si tous les champs sont bien renseigné
//            if(!empty($title) && !empty($color) && !empty($description)){
//
//                // j'instancie ma classe catégory
//
//                // j'affecte les valeurs du formulaire grâce aux setters dans ma classe
//                $category->setTitle($title);
//                $category->setColor($color);
//                $category->setDescription($description);
//                $category->setIsPublished('true');
//
//                // j'utilise la classe entity manager et la fonction persist pour enregistrer mes données avant de les transmettre
//                $entityManager->persist($category);
//                // j'utilise ensuite la fonction flush pour envoyer les données dans ma BDD
//                $entityManager->flush();
//
//                // je transmet un message flash pour confirmer
//                $this->addFlash('Bravo', 'Votre catégory a bien été créé');
//                // Je redirige vers la page des catégories
//                return $this->render('admin/categories.html.twig');
//            } else {
//                // si les champs sont vides j'affiche un message d'erreur
//                $this->addFlash('ERROR', 'Veuillez renseigner tous les champs !');
//            }
//        }
        //Je créé mon instance de classe pour l'entité category
        $category = new Category();

        //j'ai demandé à symfony de créer un formulaire avec la ligne de commande bin/console make:form
        // j'appelle donc le fichier CategoryType créé par symfony pour mettre en forme le formulaire
        // grace à la fonction create form
        $form = $this->createForm(CategoryType::class, $category);

        // je donne à la variable form une instance de la classe d'entité request pour que le formulaire
        // puisse récupérer toutes les données des inputs et faire les setter automatiquement
        $form->handleRequest($request);

        $category->setIsPublished('true');

        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Votre category à bien été posté ');
            $this->redirectToRoute('admin_categories');
        }
        // je dirige ma route vers la page de mon formulaires
        return $this->render('admin/insertCategory.html.twig', [
            'form' => $form->createView()
        ]);
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
            $this->addFlash('Bravo', 'Votre catégory a bien été supprimé');
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
    public function updateCategory($id, CategoryRepository $updateCatRepository, EntityManagerInterface $entityManager, Request $request)
    {
        //Je cible l'id grâce à la méthode find
        $category = $updateCatRepository->find($id);
        // je selectionne l'élément de la catégory à modifier grâce au setter
        $form = $this->createForm(CategoryType::class, $category);

        // je donne à la variable form une instance de la classe d'entité request pour que le formulaire
        // puisse récupérer toutes les données des inputs et faire les setter automatiquement
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($category);
            $entityManager->flush();

            $this->addFlash('success', 'Votre category à bien été posté ');
            $this->redirectToRoute('admin_categories');
        }
        // je dirige ma route vers la page de mon formulaires
        return $this->render('admin/insertCategory.html.twig', [
            'form' => $form->createView()
        ]);
        //j'appelle la méthode entity manager pour "persister" (enregistrer) les modifications de ma catégory
        //Puis je flush les changement pour qu'il soit envoyé dans la base de donnée.
//        $entityManager->persist($category);
//        $entityManager->flush();

        return $this->redirectToRoute('admin_categories');

    }

}