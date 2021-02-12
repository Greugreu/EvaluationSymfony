<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryFormType;
use App\Repository\ActorRepository;
use App\Repository\CategoryRepository;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="categories")
     * @param CategoryRepository $categoryRepository
     * @param MovieRepository $movieRepository
     * @return Response
     */
    public function index(CategoryRepository $categoryRepository, MovieRepository $movieRepository): Response
    {
        $datas = $categoryRepository->findAll();
        $movies = $movieRepository->findAllOrderedByCategory('categories');

        return $this->render('categories/index.html.twig', [
            'controller_name' => 'CategoryController',
            'datas' => $datas,
            'movies' => $movies
        ]);
    }

    /**
     * @Route("/categories/new", name="categories_new")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param CategoryRepository $categoryRepository
     * @return Response
     */
    public function newCategory(Request $request, EntityManagerInterface $manager, CategoryRepository $categoryRepository)
    {
        $category = new Category();

        $form = $this->createForm(CategoryFormType::class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $manager->persist($data);
            $manager->flush();
            return $this->redirectToRoute("categories");
        }

        return $this->render('categories/newCategory.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
