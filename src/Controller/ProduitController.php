<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Component\Form\Forms;

/**
 * @Route("/produit")
 */
class ProduitController extends AbstractController
{
    

     /**
     * @Route("/listep", name="produit_list", methods={"GET"})
     */
    public function listep(ProduitRepository $produitRepository,Request $request): Response
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
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        $produits =  $produitRepository->findAll();
           
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('produit/listep.html.twig', ['name'=>$name,
            'produits' => $produits,
        
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("mypdf.pdf", [
            "Attachment" => false
        ]);
    }
    }


    /**
     * @Route("/", name="produit_index", methods={"GET"})
     */
    public function index(ProduitRepository $produitRepository,Request $request): Response
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
        return $this->render('produit/index.html.twig', [
            'name'=>$name, 'produits' => $produitRepository->findAll(),
        ]);
        }
    }

    /**
     * @Route("/new", name="produit_new", methods={"GET","POST"})
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
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);


         if ($form->isSubmitted() && $form->isValid()) {
            $file = $produit->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            try {
                $file->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }
            $entityManager = $this->getDoctrine()->getManager();
            $produit->setImage($fileName);
            $entityManager->persist($produit);
            $entityManager->flush();

            return $this->redirectToRoute('produit_index');
        } 

        return $this->render('produit/new.html.twig', [
            'name'=>$name, 'produit' => $produit,
            'form' => $form->createView(),
        ]);
        }
    }

    /**
     * @Route("/{id}", name="produit_show", methods={"GET"}, requirements={"id":"\d+"})
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
        $entityManager = $this->getDoctrine()->getManager();
        $produit = $entityManager->getRepository(Produit::class)->find($id);    
        $name = $session->get('name');
        return $this->render('produit/show.html.twig', [
            'name'=>$name, 'produit' => $produit,
        ]);
        }
    }

    /**
     * @Route("/{id}/edit", name="produit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request,int $id): Response
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
        $produit = $entityManager->getRepository(Produit::class)->find($id);
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('produit/edit.html.twig', [
            'name'=>$name,'produit' => $produit,
            'form' => $form->createView(),
        ]);
        }
    }

    /**
     * @Route("/{id}/delete", name="produit_delete", methods={"DELETE"},requirements={"id":"\d+"})
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
        $produit = $entityManager->getRepository(Produit::class)->find($id);
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit_index');
    }
}
}
