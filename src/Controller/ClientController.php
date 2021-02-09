<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/", name="client_index", methods={"GET"})
     */
    public function index(ClientRepository $clientRepository,Request $request): Response
    {
        $session=$request->getSession();
        if(!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info','Erreur de connection veuillez se connecter...');
            return $this->redirectToRoute('user_login');
        }
        else
        {
            $name = $session->get('name');
        return $this->render('client/index.html.twig', [
            'name'=>$name, 'clients' => $clientRepository->findAll(),
        ]);
        }
    }

    /**
     * @Route("/new", name="client_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $session=$request->getSession();
        if(!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info','Erreur de connection veuillez se connecter...');
            return $this->redirectToRoute('user_login');
        }
        else
        {
            $name = $session->get('name');
        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('client_index');
        }

        return $this->render('client/new.html.twig', [
            'client' => $client,'name'=>$name,
            'form' => $form->createView(),
        ]);
        }
    }

    /**
     * @Route("/{id}", name="client_show", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(int $id,Request $request): Response
    {
        $session=$request->getSession();
        if(!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info','Erreur de connection veuillez se connecter...');
            return $this->redirectToRoute('user_login');
        }
        else
        {
        $name = $session->get('name');
        $entityManager = $this->getDoctrine()->getManager();
        $client = $entityManager->getRepository(Client::class)->find($id);
        return $this->render('client/show.html.twig', [
            'client' => $client,'name'=>$name,
        ]);
        }
    }

    /**
     * @Route("/{id}/edit", name="client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, int $id): Response
    {
        $session=$request->getSession();
        if(!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info','Erreur de connection veuillez se connecter...');
            return $this->redirectToRoute('user_login');
        }
        else
        {
        $name = $session->get('name');
        $entityManager = $this->getDoctrine()->getManager();
        $client = $entityManager->getRepository(Client::class)->find($id);
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('client_index');
        }

        return $this->render('client/edit.html.twig', [
            'client' => $client,'name'=>$name,
            'form' => $form->createView(),
        ]);
        }
    }

    /**
     * @Route("/{id}/delete", name="client_delete", methods={"DELETE"}, requirements={"id":"\d+"})
     */
    public function delete(Request $request, int $id): Response
    {
        $session=$request->getSession();
        if(!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info','Erreur de connection veuillez se connecter...');
            return $this->redirectToRoute('user_login');
        }
        else
        {
            $name = $session->get('name');
            $entityManager = $this->getDoctrine()->getManager();
            $client = $entityManager->getRepository(Client::class)->find($id);
        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
            
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('client_index');
    }
}
}
