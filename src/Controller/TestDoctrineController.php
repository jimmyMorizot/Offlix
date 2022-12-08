<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Entity\Season;
use App\Repository\MovieRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestDoctrineController extends AbstractController
{
    // Controller pour faire un crud complet sur nos films

    /**
     * @Route("/test/add", name="testDoctrine_add", methods={"GET"})
     */
    public function add(): Response
    {

        // sensio extra bundle est nécessaire pour que cette magie noir fonctionne
        // Le lien est fait entre le nom du paramètre et l'attribut title de Movie

        return $this->render('test_doctrine/add.html.twig');
    }

    /**
     * @Route("/test/add", name="testDoctrine_addValid", methods={"POST"})
     */
    public function addValid(ManagerRegistry $doctrine, Request $request): Response
    {

        $entityManager = $doctrine->getManager();

        // simulé le retour d'un formulaire
        
        // données dans le code -> data mapper -> BDD
        $movie = new Movie;
        // $request->get->title permet de récupérer le champs correspondant de mon formulaire
        $movie->setTitle($request->get('title'));
        $movie->setReleaseDate(new DateTime('2002-12-10'));
        $movie->setSummary("Après la mort de Boromir et la disparition de Gandalf, la Communauté s'est scindée en trois. Perdus dans les collines d'Emyn Muil, Frodon et Sam découvrent qu'ils sont suivis par Gollum, une créature versatile corrompue par l'Anneau. Celui-ci promet de conduire les Hobbits jusqu'à la Porte Noire du Mordor. A travers la Terre du Milieu, Aragorn, Legolas et Gimli font route vers le Rohan...");
        $movie->setSynopsis("Après la mort de Boromir et la disparition de Gandalf, la Communauté s'est scindée en trois. Perdus dans les collines d'Emyn Muil, Frodon et Sam découvrent qu'ils sont suivis par Gollum, une créature versatile corrompue par l'Anneau. Celui-ci promet de conduire les Hobbits jusqu'à la Porte Noire du Mordor. A travers la Terre du Milieu, Aragorn, Legolas et Gimli font route vers le Rohan, le royaume assiégé de Theoden. Cet ancien grand roi, manipulé par l'espion de Saroumane, le sinistre Langue de Serpent, est désormais tombé sous la coupe du malfaisant Magicien. Eowyn, la nièce du Roi, reconnaît en Aragorn un meneur d'hommes. Entretemps, les Hobbits Merry et Pippin, prisonniers des Uruk-hai, se sont échappés et ont découvert dans la mystérieuse Forêt de Fangorn un allié inattendu : Sylvebarbe, gardien des arbres, représentant d'un ancien peuple végétal dont Saroumane a décimé la forêt...");
        $movie->setPoster('lurtz.jpg');
        $movie->setDuration(240);

        // Persist prépare l'ajout en bdd
        $entityManager->persist($movie);

        // Flush ajoute réelement l'objet en bdd
        $entityManager->flush();

        return $this->redirectToRoute('main_home');
    }

    /**
     * @Route("/test/list", name="testDoctrine_list")
     */
    public function list(ManagerRegistry $doctrine): Response
    {

        // Je recupère tout mes films via la méthode findall
        // Exemple pour récupérer les données version 1
        $movies = $doctrine->getRepository(Movie::class)->findAll();
        // Exemple pour récupérer les données version 2
        // $movies = $movieRepository->findAll();

        // Les saison ne sont pas utilisés donc le dump est vide au niveau des saisons
        dump($movies);
        // J'utilise les saisons dans le code donc le même dump n'est pourtant pas identique car les saisons y sont présentes
        foreach($movies[0]->getSeasons()as $season){
            dump($movies);
            // dump($season);
            dd($movies);
        }

        return $this->render('test_doctrine/list.html.twig',[
            'movies' => $movies,

        ]);
    }

    /**
     * @Route("/test/film/{title}", name="testDoctrine_show")
     */
    public function show(Movie $movie): Response
    {

        // sensio extra bundle est nécessaire pour que cette magie noir fonctionne
        // Le lien est fait entre le nom du paramètre et l'attribut title de Movie
        
        dd($movie);
        return $this->redirectToRoute('main_home');
    }

    /**
     * @Route("/test/film/update/{id}", name="testDoctrine_update")
     */
    public function update(Movie $movie, ManagerRegistry $doctrine): Response
    {

        // On récupère le manager
        $entityManager = $doctrine->getManager();
        // Le lien est fait entre le nom du paramètre et l'attribut title de Movie

        // Je modifie un attribut
        $movie->setSummary('Gandalf meurt puis ne meurt pas ...');

        // Je sauvegarde ma modif en bdd
        $entityManager->flush();
        
        return $this->redirectToRoute('testDoctrine_list');
    }

     /**
     * @Route("/test/film/delete/{id}", name="testDoctrine_delete")
     */
    public function delete(Movie $movie, ManagerRegistry $doctrine): Response
    {

        // On récupère le manager
        $entityManager = $doctrine->getManager();

        // Le lien est fait entre le nom du paramètre et l'attribut title de Movie

        // Pour supprimer l'objet
        $entityManager->remove($movie);

        // Je sauvegarde ma modif en bdd
        $entityManager->flush();
        
        return $this->redirectToRoute('testDoctrine_list');
    }

     /**
     * @Route("/test/season/add/{id}", name="testDoctrine_seasonAdd")
     */
    public function seasonAdd(Movie $movie,ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        // Création d'une nouvelle saison
        $season = new Season();
        $season->setNumberEpisodes(10);
        $season->setNumberSeason(2);

        // On lie la saison au film existant
        $season->setMovie($movie);
        // exemple dans l'autre sens
        // $movie->addSeason($season);

        $entityManager->persist($season);
        $entityManager->flush();
        
        return $this->redirectToRoute('testDoctrine_list');
    }
}