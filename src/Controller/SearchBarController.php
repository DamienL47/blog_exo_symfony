<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchBarController extends AbstractController
{

    //Je créé une route pour ma barre de recherche d'articles
    /**
     * @Route("admin/search", name="admin_search")
     */

    //Je créé la méthode de PostRepository pour récupérer les articles dans ma base de données
    public function searchArticles(Request $request, PostRepository $postSearch, CategoryRepository $catSearch)
    {
        //je créé une variable qui va récupérer la requete get
        $search = $request->query->get('search');
        //je stocke cette recherche dans une nouvelle variable qui va la comparer
        // avec les articles dans ma base de données
        $articles = $postSearch->searchByWord($search);
        $categories = $catSearch->searchByWord($search);

        return $this->render('admin/search.html.twig', [
            'articles' => $articles,
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/admin/articles", name="admin-articles")
     */
    public function listArticles(PostRepository $listArticles) : Response
    {
        $articles = $listArticles->findAll();

        return $this->render('admin/articles.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route("/admin/categories", name="admin_categories")
     */
    public function listCategory(CategoryRepository $listCategory) : Response
    {
        $listCategory = $listCategory->findAll();

        return $this->render('admin/categories.html.twig', [
            'categories' => $listCategory
        ]);
    }
}