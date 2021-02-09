<?php

namespace App\Controller;

use App\Entity\Fournisseur;
use App\Form\FournisseurType;
use App\Repository\FournisseurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/fournisseur")
 */
class FournisseurController extends AbstractController
{
    /**
     * @Route("/", name="fournisseur_index", methods={"GET"})
     */
    public function index(FournisseurRepository $fournisseurRepository,Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info', 'Erreur de  Connection veuillez se connecter .... ....');
            return $this->redirectToRoute('user_login');
        }
        else
        {
        $name = $session->get('name');
        return $this->render('fournisseur/index.html.twig', ['name'=>$name,
            'fournisseurs' => $fournisseurRepository->findAll(),
        ]);
    }
    }
    /**
     * @Route("/new", name="fournisseur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info', 'Erreur de  Connection veuillez se connecter .... ....');
            return $this->redirectToRoute('user_login');
        }
        else
        {
        $name = $session->get('name');
        $fournisseur = new Fournisseur();
        $form = $this->createForm(FournisseurType::class, $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fournisseur);
            $entityManager->flush();

            return $this->redirectToRoute('fournisseur_index');
        }

        return $this->render('fournisseur/new.html.twig', ['name'=>$name,
            'fournisseur' => $fournisseur,
            'form' => $form->createView(),
        ]);
    }
    }
    /**
     * @Route("/{id}", name="fournisseur_show", methods={"GET"})
     */
    public function show(int $id,Request $request): Response
    {
        $session = $request->getSession();
        if (!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info', 'Erreur de  Connection veuillez se connecter .... ....');
            return $this->redirectToRoute('user_login');
        }
        else
        {
        $name = $session->get('name');
        $entityManager = $this->getDoctrine()->getManager();
        $fournisseur = $entityManager->getRepository(Fournisseur::class)->find($id);
        return $this->render('fournisseur/show.html.twig', ['name'=>$name,
            'fournisseur' => $fournisseur,
        ]);
    }
    }
    /**
     * @Route("/{id}/edit", name="fournisseur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, int $id): Response
    {
        $session = $request->getSession();
        if (!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info', 'Erreur de  Connection veuillez se connecter .... ....');
            return $this->redirectToRoute('user_login');
        }
        else
        {
        $name = $session->get('name');
        $entityManager = $this->getDoctrine()->getManager();
        $fournisseur = $entityManager->getRepository(Fournisseur::class)->find($id);
        $form = $this->createForm(FournisseurType::class, $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fournisseur_index');
        }

        return $this->render('fournisseur/edit.html.twig', [
            'fournisseur' => $fournisseur,'name'=>$name,
            'form' => $form->createView(),
        ]);
    }
    }
    /**
     * @Route("/{id}", name="fournisseur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
            $fournisseur = $entityManager->getRepository(Fournisseur::class)->find($id);
        if ($this->isCsrfTokenValid('delete'.$fournisseur->getId(), $request->request->get('_token'))) {
            
            $entityManager->remove($fournisseur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fournisseur_index');
    }
}