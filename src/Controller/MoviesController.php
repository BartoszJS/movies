<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieFormType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MoviesController extends AbstractController
{
    private $em;
    private $movieRepository;
    public function __construct(MovieRepository $movieRepository, EntityManagerInterface $em) 
    {
        $this->movieRepository = $movieRepository;
        $this->em = $em;
    }

    #[Route('/movies', methods: ['GET'], name: 'movies')]
    public function index(): Response
    {
        $movies = $this->movieRepository->findAll();

        return $this->render('movies/index.html.twig', [
            'movies' => $movies
        ]);
        
    }

    #[Route('/movies/create', name:'create')]
    public function create(Request $request): Response
    {
       $movie = new Movie();
       $form = $this->createForm(MovieFormType::class, $movie);

       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
            $newMovie = $form->getData();

            $imagePath = $form->get('imagePath')->getData();
            if($imagePath){
                $newFileName = uniqid().'.'.$imagePath->guessExtension();

                try{
                    $imagePath->move(
                        $this->getParameter('kernel.project_dir'). '/public/uploads',
                        $newFileName
                    );
                } catch(FileException $e){
                    return new Response($e->getMessage());
                }
                $newMovie->setImagePath('/uploads/'.$newFileName);
            }

            $this->em->persist($newMovie);
            $this->em->flush();

            return $this->redirectToRoute('movies');
       }

       return $this->render('movies/create.html.twig',[
            'form' => $form->createView()
       ]);
    }
    
    #[Route('/movies/{id}',methods: ['GET'], name: 'movie')]
    public function show($id): Response
    {
        $movie = $this->movieRepository->find($id);

        return $this->render('movies/Show.html.twig', [
            'movie' => $movie
        ]);
        
    }

} 




   // findAll() - SELECT * FROM movies;
        // find(5) - SELECT * FROM movies WHERE id=5;
        // findBy([],['id' => 'DESC']) - SELECT * FROM movies order by id desc;
        // findOneBy(['id' => 8, 'title'=>'The Dark 2'],['id' => 'DESC']);
        // count(['id' => 8]);



        //    $repository = $this->em->getRepository(Movie::class);
        //    $movies = $repository->getClassName();
        //    dd($movies);
