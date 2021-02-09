<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Famille;
use App\Form\FamilleType;
use App\Repository\FamilleRepository;
use Symfony\Component\Form\Forms;

/**
 * @Route("/famille")
 */
class FamilleController extends AbstractController
{
    /**
     * @Route("/", name="famille_index")
     */
    public function index(FamilleRepository $familleRepository,Request $request): Response
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
        return $this->render('famille/index.html.twig', ['name'=>$name,
         'familles' => $familleRepository->findAll(),
        ]);
        }
    }

     /**
     * @Route("/new", name="famille_new")
     */
    public function new(Request $request)
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
        $famille = new Famille();
        $form = $this->createForm(FamilleType::class, $famille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($famille);
            $entityManager->flush();

            return $this->redirectToRoute('famille_index');
        }

        return $this->render('famille/new.html.twig', ['name'=>$name,
            'famille' => $famille,
            'form' => $form->createView(),
        ]);
    }
    }

    /**
     * @Route("/{id}/edit", name="famille_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, int $id ): Response
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
        $famille = $entityManager->getRepository(Famille::class)->find($id); 
        $form = $this->createForm(FamilleType::class, $famille);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('famille_index');
        }

        return $this->render('famille/edit.html.twig', ['name'=>$name,
            'famille' => $famille,
            'form' => $form->createView(),
        ]);
    }
    }


    /**
     * @Route("/delete_famille/{id}", name="famille_delete")
     */
    public function delFamille(Request $request,  int $id): Response
    {
        $session=$request->getSession();
        if(!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info','Erreur de connection veuillez se connecter...');
            return $this->render('user/erreur.html.twig');
        }
        else
        {
            $name = $session->get('name');
            $entityManager = $this->getDoctrine()->getManager(); 
            $famille = $entityManager->getRepository(Famille::class)->find($id);
        if ($this->isCsrfTokenValid('delete'.$famille->getId(), $request->request->get('_token'))) {
           
            $entityManager->remove($famille);
            $entityManager->flush();
        }

        return $this->redirectToRoute('famille_index');
    }
  }

/**
     * @Route("/{id}", name="famille_show", methods={"GET"})
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
        $famille = $entityManager->getRepository(Famille::class)->find($id);
        return $this->render('famille/show.html.twig', ['name'=>$name,
            'famille' => $famille,
        ]);
        }
    }



}



