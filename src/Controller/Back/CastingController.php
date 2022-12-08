<?php

namespace App\Controller\Back;

use App\Entity\Movie;
use App\Entity\Casting;
use App\Form\CastingType;
use App\Repository\CastingRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @IsGranted("ROLE_MANAGER", message="No access! Get out!")
 * @Route("/back/casting")
 */
class CastingController extends AbstractController
{
    /**
     * Afficher les castings d'un film donné
     * 
     * @Route("/movie/{id}", name="app_back_casting_index", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function index(Movie $movie, CastingRepository $castingRepository): Response
    {
        return $this->render('back/casting/index.html.twig', [
            'movie' => $movie,
            'castings' => $castingRepository->findByMovie($movie),
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN", message="No access! Get out!")
     * @Route("/new/movie/{id}", name="app_back_casting_new", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function new(Movie $movie, Request $request, CastingRepository $castingRepository): Response
    {
        $casting = new Casting();
        $form = $this->createForm(CastingType::class, $casting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // on associe le film au casting
            $casting->setMovie($movie);

            $castingRepository->add($casting, true);

            return $this->redirectToRoute('app_back_casting_index', ['id' => $movie->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/casting/new.html.twig', [
            'casting' => $casting,
            'form' => $form,
            'movie' => $movie,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN", message="No access! Get out!")
     * @Route("/{role}/{movie}/{person}/edit", name="app_back_casting_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Casting $casting, CastingRepository $castingRepository): Response
    {
        $form = $this->createForm(CastingType::class, $casting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $castingRepository->add($casting, true);

            return $this->redirectToRoute('app_back_casting_index', ['id' => $casting->getMovie()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/casting/edit.html.twig', [
            'casting' => $casting,
            'form' => $form,
        ]);
    }

    /**
     * @IsGranted("ROLE_ADMIN", message="No access! Get out!")
     * @Route("/{role}/{movie}/{person}", name="app_back_casting_delete", methods={"POST"})
     */
    public function delete(Request $request, Casting $casting, CastingRepository $castingRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$casting->getRole(), $request->request->get('_token'))) {
            $castingRepository->remove($casting, true);
        }

        return $this->redirectToRoute('app_back_casting_index', ['id' => $casting->getMovie()->getId()], Response::HTTP_SEE_OTHER);
    }
}
