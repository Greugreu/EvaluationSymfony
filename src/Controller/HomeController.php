<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @param CategoryRepository $categoryRepository
     * @param MovieRepository $movieRepository
     * @return Response
     */
    public function index(CategoryRepository $categoryRepository, MovieRepository $movieRepository): Response
    {
        $datas = $categoryRepository->findAll();
        $movies = $movieRepository->findAllOrderedByCategory('Categories');

        return $this->render('categories/index.html.twig', [
            'controller_name' => 'CategoryController',
            'datas' => $datas,
            'movies' => $movies
        ]);
    }
}
