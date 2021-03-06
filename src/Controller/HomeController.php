<?php

namespace App\Controller;




use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */

    public function home(PostRepository $selectRepository)
    {
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
//        if($request->query->has('age')){
//            if($request->query->get('age')< 18 ) {
//                return $this->render('accessDenied.html.twig');
//            } else {
//                return $this->render('home.html.twig', [
//                    'listArticles' => $articles
//                ]);
//            }
//        } else {
//            return $this->render('firstHome.html.twig');
//        }


        $selectArticles = $selectRepository->findBy([], ['id' => 'DESC'], 3);

        return $this->render('home.html.twig', [
            'articles' => $selectArticles
        ]);
    }

}