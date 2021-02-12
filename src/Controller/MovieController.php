<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * @Route("/movies/", name="movies")
     * @param MovieRepository $movieRepository
     * @return Response
     */
    public function index(MovieRepository $movieRepository): Response
    {
        $datas = $movieRepository->findAll();

        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/movies/{category}", name="{category}")
     * @param MovieRepository $movieRepository
     * @param $category
     * @return Response
     */
    public function showAllByCategory(MovieRepository $movieRepository, $category): Response
    {
        $datas = $movieRepository->findBy(["Categories" => $category]);

        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController',
            'datas' => $datas
        ]);
    }

    /**
     * @Route("/movies/new", name="movie_new")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param MovieRepository $movieRepository
     * @return Response
     */
    public function newMovie(Request $request, EntityManagerInterface $manager, MovieRepository $movieRepository)
    {
        $category = new Movie();

        $form = $this->createForm(MovieFormType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $manager->persist($data);
            $manager->flush();
            return $this->redirectToRoute("movies");
        }

        return $this->render('categories/newMovie.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
