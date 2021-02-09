<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use App\Repository\ProduitRepository;
use App\Repository\ClientRepository;



/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository,Request $request): Response
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
        return $this->render('user/index.html.twig', [
            'name'=>$name,'users' => $userRepository->findAll(),
        ]);
        }
    }

    /**
     * @Route("/new", name="user_new", methods={"GET","POST"})
     */
    public function new(Request $request,UserRepository $userRepository): Response
    {
        $session=$request->getSession();
       
        $name = $session->get('name');
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            $this->get('session')->getFlashBag()->add('info','Validation Faite ....');
            return $this->render('user/dashboard.html.twig', [
                
              ]); 
            
        }

        return $this->render('user/new.html.twig', [
            'name'=>$name, 'user' => $user,
            'form' => $form->createView(),
        ]);
        
    }




     /**
     * @Route("/login", name="user_login", methods={"GET","POST"})
     */

     
    public function Login(Request $request,ProduitRepository $produitRepository,UserRepository $userRepository,ClientRepository $clientRepository): Response
    {
        
        $session=$request->getSession();
        $session->clear();
        $user = new User();
        $form = $this->createFormBuilder($user)
        ->add('login', TextType::class,[
         'attr' => [
             'placeholder' => 'Taper votre login',
                     ],
        
     ])
        ->add('pwd', PasswordType::class,[
         'attr' => [
             'placeholder' => 'Taper votre Password',
                     ],
        
     ])
 
         ->getForm();
        
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $pwd   = $user->getPwd();
            $login = $user->getLogin();
            $user1 = $userRepository->findOneBy(array('login'=>$login,
            'pwd'=>$pwd));
           if (!$user1)
           {
            $this->get('session')->getFlashBag()->add('info',
             'Login ou Password Incorrecte....');
           }
           else
           {
            if (!$session->has('name'))
            {
                $session->set('name',$user1->getUserName());
                $name = $session->get('name');
                
                
                    return $this->render('user/dashboard.html.twig', [
                      'name'=>$name
                    ]); 
                }
       }
     }
    
        return $this->render('user/login.html.twig', [
            
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }


 /**
     * @Route("/dash", name="dashboard")
     */
    public function dash(Request $request)
    {
        $session = $request->getSession();
        if(!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info','Erreur de connection veuillez se connecter...');
            return $this->redirectToRoute('user_login');
        }
        else
        {
        $name = $session->get('name');
        return $this->render('user/dashboard.html.twig', [
            'name' => $name,
            
        ]);
        }
    }



     /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(int $id): Response
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
        $user = $entityManager->getRepository(User::class)->find($id);
        $name = $session->get('name');
        return $this->render('user/show.html.twig', [
            'name'=>$name, 'user' => $user,
        ]);
        }
    }


   

    

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, int $id): Response
    {
        $session=$request->getSession();
        if(!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info','Erreur de connection veuillez se connecter...');
            return $this->render('user_login');
        }
        else
        {
        $name = $session->get('name');
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('user/edit.html.twig', [
            'name'=>$name, 'user' => $user,
            'form' => $form->createView(),
        ]);
        }
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, int $id): Response
    {
        $session=$request->getSession();
        if(!$session->has('name'))
        {
            $this->get('session')->getFlashBag()->add('info','Erreur de connection veuillez se connecter...');
            return $this->render('user_login');
        }
        else
        {
        $name = $session->get('name');
        $entityManager = $this->getDoctrine()->getManager();
        $user = $entityManager->getRepository(User::class)->find($id);    
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
}
