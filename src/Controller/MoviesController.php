<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/movies', name: 'app_movies' )]
    public function index(): Response
    {
        // findAll() - SELECT * FROM movies;
        // find(5) - SELECT * FROM movies WHERE id=5;
        // findBy([],['id' => 'DESC']) - SELECT * FROM movies order by id desc;
        // findOneBy(['id' => 8, 'title'=>'The Dark 2'],['id' => 'DESC']);
        // count(['id' => 8]);
       $repository = $this->em->getRepository(Movie::class);
       $movies = $repository->getClassName();

       dd($movies);

        return $this->render('index.html.twig' );
        
    }    
       

}
