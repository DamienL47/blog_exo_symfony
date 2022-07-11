<?php

namespace App\Controller;


use App\Entity\Post;

use App\Form\ArticleType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticlesController extends AbstractController
{

//    /**
//     * @Route("articles", name="articles")
//     */
//
//    public function ListArticles()
//    {
//        $articles = [
//            1 => [
//                'title' => 'Non, là c\'est sale',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Eric',
//                'image' => 'https://media.gqmagazine.fr/photos/5b991bbe21de720011925e1b/master/w_780,h_511,c_limit/la_tour_montparnasse_infernale_1893.jpeg',
//                'id' => 1
//            ],
//            2 => [
//                'title' => 'Il faut trouver tous les gens qui étaient de dos hier',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Maurice',
//                'image' => 'https://fr.web.img6.acsta.net/r_1280_720/medias/nmedia/18/35/18/13/18369680.jpg',
//                'id' => 2
//            ],
//            3 => [
//                'title' => 'Pluuutôôôôt Braaaaaach, Vasarelyyyyyy',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Didier',
//                'image' => 'https://media.gqmagazine.fr/photos/5eb02109566df9b15ae026f3/master/pass/n-3freres.jpg',
//                'id' => 3
//            ],
//            4 => [
//                'title' => 'Quand on attaque l\'empire, l\'empire contre attaque',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Mbala',
//                'image' => 'https://fr.web.img2.acsta.net/newsv7/21/01/20/15/49/5077377.jpg',
//                'id' => 4
//            ],
//        ];
//        return $this->render("articles.html.twig", [
//            'listArticles' => $articles
//        ]);
//    }
//
//    /**
//     * @Route("article/{id}", name="article")
//     */
//
//    public function articleToId($id)
//    {
//        $articles = [
//            1 => [
//                'title' => 'Non, là c\'est sale',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Eric',
//                'image' => 'https://media.gqmagazine.fr/photos/5b991bbe21de720011925e1b/master/w_780,h_511,c_limit/la_tour_montparnasse_infernale_1893.jpeg',
//                'id' => 1
//            ],
//            2 => [
//                'title' => 'Il faut trouver tous les gens qui étaient de dos hier',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Maurice',
//                'image' => 'https://fr.web.img6.acsta.net/r_1280_720/medias/nmedia/18/35/18/13/18369680.jpg',
//                'id' => 2
//            ],
//            3 => [
//                'title' => 'Pluuutôôôôt Braaaaaach, Vasarelyyyyyy',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Didier',
//                'image' => 'https://media.gqmagazine.fr/photos/5eb02109566df9b15ae026f3/master/pass/n-3freres.jpg',
//                'id' => 3
//            ],
//            4 => [
//                'title' => 'Quand on attaque l\'empire, l\'empire contre attaque',
//                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam amet assumenda deserunt eius eveniet molestias necessitatibus non, quos sed sequi! Animi aspernatur assumenda earum laudantium odio quasi quibusdam quisquam veniam.',
//                'publishedAt' => new \DateTime('NOW'),
//                'isPublished' => true,
//                'author' => 'Mbala',
//                'image' => 'https://fr.web.img2.acsta.net/newsv7/21/01/20/15/49/5077377.jpg',
//                'id' => 4
//            ],
//        ];
//        return $this->render("article.html.twig", [
//           'article' => $articles[$id]
//        ]);
//    }

    /**
     * @Route("/admin/article/{id}", name="admin-article")
     */
    public function showArticle(PostRepository $articleRepository, $id)
    {
        // Récupérer depuis la base de données un article
        // en fonction d'un id
        //donc un SELECT * FROM article where id = xxx

        // La classe repository me permet de faire des requete dans la table
        //La méthode find permet de récupérer un élément

        $article = $articleRepository->find($id);

        return $this->render('admin/article.html.twig', ['article' => $article ]);
    }

    /**
     * @Route("/admin/articles", name="admin-articles")
     */
    public function listArticles(PostRepository $listArticles)
    {
        $articles = $listArticles->findAll();

        return $this->render('admin/articles.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route("/admin/insert-article", name="admin-insert_article")
     */

    public function insertArticle(EntityManagerInterface $entityManager, Request $request)
    {

//        $title = $request->query->get('title');
//        $content = $request->query->get('description');
//        $author = $request->query->get('author');
//
//        if(!empty($title) && !empty($content) && !empty($author)){
//            //je créé une instance de la classe d'entité post
//            //pour créer un nouvel article dans ma base de données
//            $post = new Post();
//
//            //Je renseigne mes données en utilisant les setteurs de mes colonnes
//            $post->setTitle($title);
//            $post->setContent($content);
//            $post->setAuthor($author);
//            $post->setIsPublished('true');
//
//            //Avec la classe Entity Manager Interface du framework doctrine
//            // pour enregistrer dans ma base de données mon entité dans la table post
//            $entityManager->persist($post);
//            // avec la même classe entity manager interface j'utilise la fonction flush
//            // pour envoyer vers la base de données.
//            $entityManager->flush();
//
//            $this->addFlash('Bravo', 'Votre article est bien créé');
//            return $this->redirectToRoute('admin-articles');
//        } else {
//            $this->addFlash('error', 'Veuillez renseigner tout les champs ');
//        }
//
//        return $this->render('admin/insertArticle.html.twig');
        // je créé l'instance de classe entité
        $article = new Post();

        $form = $this->createForm(ArticleType::class, $article);
        // je donne à la variable form une instance de la classe d'entité request pour que le formulaire
        // puisse récupérer toutes les données des inputs et faire les setter automatiquement


        $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $entityManager->persist($article);
                $entityManager->flush();

                $this->addFlash('success', 'Votre article à bien été posté ');
                $this->redirectToRoute('admin-articles');
            }

        return $this->render('admin/insertArticle.html.twig', [
            'form' => $form->createView()
            ]);
    }

    /**
     * @Route("/admin/delete/article/{id}", name="admin-delete-article")
     */

    public function deleteArticle($id, PostRepository $deleteRepository, EntityManagerInterface $entityManager)
    {
        $article = $deleteRepository->find($id);

        if (!is_null($article)){
            $entityManager->remove($article);
            $entityManager->flush();
            $this->addFlash('Bravo', 'Votre article a bien été supprimé');
            return $this->redirectToRoute('home');
        } else {
            return new Response('Article non trouvé ');
        }
    }

    /**
     * @Route("/admin/update/article/{id}", name="admin-update-article")
     */
    public function updateArticle($id, EntityManagerInterface $entityManager, PostRepository $updateRepository, Request $request)
    {   //je récupère l'id de l'article à modifier en cliquant sur le lien modifier
        $article = $updateRepository->find($id);
        $form = $this->createForm('ArticleType', $article);

        //Je récupère la méthod get renseigné dans mon formulaire par l'admin
//        $request->query->get();
        //je passe une condition pour savoir ce qui à été modifié

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('success', 'Votre article à bien été posté ');
            $this->redirectToRoute('admin-articles');
        }

        return $this->render('admin/insertArticle.html.twig', [
            'form' => $form->createView()
        ]);



        $entityManager->persist($article);
        $entityManager->flush();
        return $this->render('admin/updateArticle.html.twig');
    }
}