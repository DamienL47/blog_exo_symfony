<?php

namespace App\Controller;


use App\Entity\Post;

use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
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

        return $this->render('article.html.twig', ['article' => $article ]);
    }

    /**
     * @Route("/admin/articles", name="admin-articles")
     */
    public function listArticles(PostRepository $listArticles)
    {
        $articles = $listArticles->findAll();

        return $this->render('articles.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route("/admin/insert-article", name="admin-insert_article")
     */

    public function insertArticle(EntityManagerInterface $entityManager)
    {
        //je créé une instance de la classe d'entité post
        //pour créer un nouvel article dans ma base de données
        $post = new Post();

        //Je renseigne mes données en utilisant les setteurs de mes colonnes
        $post->setTitle('Felix le chat');
        $post->setContent('la première apparition de Felix le chat date de 1919');
        $post->setAuthor('Damien');
        $post->setIsPublished('true');

        //Avec la classe Entity Manager Interface du framework doctrine
        // pour enregistrer dans ma base de données mon entité dans la table post
        $entityManager->persist($post);
        // avec la même classe entity manager interface j'utilise la fonction flush
        // pour envoyer vers la base de données.
        $entityManager->flush();

        $post1 = new Post();

        $post1->setTitle('Beethoven le chien');
        $post1->setContent('Bethoveen le chien est un ST Bernard');
        $post1->setAuthor('Damien');
        $post1->setIsPublished('true');

        $entityManager->persist($post1);
        $entityManager->flush();

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
            return new Response('Article supprimé');
        } else {
            return new Response('Article non trouvé ');
        }
    }

    /**
     * @Route("/admin/update/article/{id}", name="admin-update-article")
     */
    public function updateArticle($id, EntityManagerInterface $entityManager, PostRepository $updateRepository)
    {
        $article = $updateRepository->find($id);

        $article->setTitle('Nouveau titre');

        $entityManager->persist($article);
        $entityManager->flush();
    }
}