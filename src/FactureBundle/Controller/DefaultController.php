<?php

namespace FactureBundle\Controller ;

use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Doctrine\ORM\EntityRepository ;
use Symfony\Component\HttpFoundation\Session\Session ;
use FactureBundle\Entity\Tva ;
use FactureBundle\Form\TvaType ;
use FactureBundle\Entity\Produit ;
use FactureBundle\Form\ProduitType ;
use UserBundle\Entity\User ;
use UserBundle\Form\RegistrationFormType ;
use FactureBundle\Entity\Entete ;
use FactureBundle\Form\EnteteType ;
use FactureBundle\Entity\Ligne ;
use FactureBundle\Form\LigneType ;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('FactureBundle::dashboard.html.twig') ;
    }

    public function tvaAction($id)
    {
        $em = $this->getDoctrine()->getManager() ;
        $session = $this->getRequest()->getSession() ;
        if ($id == NULL)
            $tva = new Tva() ;
        else
            $tva = $em->getRepository("FactureBundle:Tva")->find($id) ;
        $form = $this->createForm(new TvaType() , $tva) ;
        $tvas = $em->getRepository("FactureBundle:Tva")->findAll() ;
        $request = $this->getRequest() ;
        if ($request->isMethod("POST"))
        {
            $form->bind($request) ;
            if ($form->isValid())
            {
                $tva = $form->getData() ;
                $em->persist($tva) ;
                $em->flush() ;
                $session->getFlashBag()->add('success' , "Votre traitement a été effectué avec succées") ;
                return $this->redirect($this->generateUrl("tva")) ;
            }
        }
        return $this->render("FactureBundle:ref:tva.html.twig" , array (
                    'form' => $form->createView() ,
                    'tvas' => $tvas ,
                    'tva' => $tva
                )) ;
    }

    public function tvaDeleteAction(Tva $tva)
    {
        $em = $this->getDoctrine()->getManager() ;
        $session = $this->getRequest()->getSession() ;
        try
        {
            $em->remove($tva) ;
            $em->flush() ;
            $session->getFlashBag()->add('success' , " Votre tva a été supprimée avec succées ") ;
        } catch (\Exception $ex)
        {
            $session->getFlashBag()->add('danger' , 'Ce TVA est utilisé dans une autre table ') ;
        }
        return $this->redirect($this->generateUrl("tva")) ;
    }

    public function produitAction($id)
    {
        $em = $this->getDoctrine()->getManager() ;
        $session = $this->getRequest()->getSession() ;
        if ($id == NULL)
            $produit = new Produit() ;
        else
            $produit = $em->getRepository("FactureBundle:Produit")->find($id) ;
        $form = $this->createForm(new ProduitType() , $produit) ;
        $produits = $em->getRepository("FactureBundle:Produit")->findAll() ;
        $request = $this->getRequest() ;
        if ($request->isMethod("POST"))
        {
            $form->bind($request) ;
            if ($form->isValid())
            {
                $produit = $form->getData() ;
                $em->persist($produit) ;
                $em->flush() ;
                $session->getFlashBag()->add('success' , "Votre traitement a été effectué avec succées") ;
                return $this->redirect($this->generateUrl("produit")) ;
            }
        }
        return $this->render("FactureBundle:ref:produit.html.twig" , array (
                    'form' => $form->createView() ,
                    'produits' => $produits ,
                    'produit' => $produit
                )) ;
    }

    public function produitDeleteAction(Produit $produit)
    {
        $em = $this->getDoctrine()->getManager() ;
        $session = $this->getRequest()->getSession() ;
        try
        {
            $em->remove($produit) ;
            $em->flush() ;
            $session->getFlashBag()->add('success' , " Votre produit a été supprimée avec succées ") ;
        } catch (\Exception $ex)
        {
            $session->getFlashBag()->add('danger' , 'Ce produit est utilisé dans une autre table ') ;
        }
        return $this->redirect($this->generateUrl("produit")) ;
    }

    public function userAction($id)
    {
        $em = $this->getDoctrine()->getManager() ;
        $currentUser = $this->container->get('security.context')->getToken()->getUser() ;
        $session = $this->getRequest()->getSession() ;
        if ($id == NULL)
        {
            $user = new User() ;
            $user->setEnabled(true)->addRole('ROLE_ADMIN') ;
        }
        else
            $user = $em->getRepository("UserBundle:User")->find($id) ;
        $form = $this->createForm(new RegistrationFormType() , $user) ;
        $users = $em->getRepository("UserBundle:User")->findAll() ;
        $request = $this->getRequest() ;
        if ($request->isMethod("POST"))
        {
            $form->bind($request) ;
            if ($form->isValid())
            {
                $user = $form->getData() ;
                $em->persist($user) ;
                $em->flush() ;
                $session->getFlashBag()->add('success' , "Votre traitement a été effectué avec succées") ;
                return $this->redirect($this->generateUrl("user")) ;
            }
        }
        return $this->render("FactureBundle:ref:user.html.twig" , array (
                    'form' => $form->createView() ,
                    'users' => $users ,
                    'user' => $user ,
                    'currentUser' => $currentUser
                )) ;
    }

    public function userDeleteAction(User $user)
    {
        $em = $this->getDoctrine()->getManager() ;
        $session = $this->getRequest()->getSession() ;
        try
        {
            $em->remove($user) ;
            $em->flush() ;
            $session->getFlashBag()->add('success' , " Votre utilisateur a été supprimée avec succées ") ;
        } catch (\Exception $ex)
        {
            $session->getFlashBag()->add('danger' , 'Cet utilisateur est utilisé dans une autre table ') ;
        }
        return $this->redirect($this->generateUrl("user")) ;
    }

    public function enableUserAction(User $user)
    {
        $em = $this->getDoctrine()->getManager() ;
        $session = $this->getRequest()->getSession() ;
        if ($user->isEnabled())
            $user->setEnabled(FALSE) ;
        else
            $user->setEnabled(TRUE) ;
        $em->persist($user) ;
        $em->flush() ;
        $session->getFlashBag()->add('success' , " Votre utilisateur a été modifié avec succées ") ;
        return $this->redirect($this->generateUrl("user")) ;
    }

    public function addEnteteAction()
    {
        $em = $this->getDoctrine()->getManager() ;
        $session = $this->getRequest()->getSession() ;
        $currentUser = $this->container->get('security.context')->getToken()->getUser() ;
        $entete = new Entete() ;
        $form = $this->createForm(new EnteteType() , $entete) ;
        $request = $this->getRequest() ;
        if ($request->isMethod("POST"))
        {
            $form->submit($request) ;
            if ($form->isValid())
            {
                $entete = $form->getData() ;
                $em->persist($entete->setDateCreation(new \DateTime("now"))->setEtat(1)->setSuiviPar($currentUser)->setTimbre(0.5)) ;
                $em->flush() ;
                $session->getFlashBag()->add('success' , "Facutre crée avec succées avec succées ") ;
                return $this->redirect($this->generateUrl("addligne" , array ('id' => $entete->getId()))) ;
            }
        }
        return $this->render("FactureBundle:facture:entete.html.twig" , array (
                    'form' => $form->createView()
                )) ;
    }

    public function listeEnteteAction()
    {
        $em = $this->getDoctrine()->getManager() ;
        $session = $this->getRequest()->getSession() ;
        $request = $this->getRequest() ;
        $entetes = $em->getRepository("FactureBundle:Entete")->findAll() ;
        $paginator = $this->get('knp_paginator') ;
        $entetes = $paginator->paginate($entetes , $request->query->get('page' , 1) , 10) ;
        return $this->render("FactureBundle:facture:liste.html.twig" , array ('entetes' => $entetes)) ;
    }

    public function addLigneAction(Entete $entete , $ligne)
    {
        $em = $this->getDoctrine()->getManager() ;
        $session = $this->getRequest()->getSession() ;
        if ($ligne == NULL)
        {
            $ligne = new Ligne() ;
            $id = 0 ;
        }
        else
        {
            $ligne = $em->getRepository("FactureBundle:Ligne")->find($ligne) ;
            $id = $ligne->getId() ;
        }
        $form = $this->createForm(new LigneType() , $ligne) ;
        $form->add("parent" , "entity" , array (
            'class' => 'FactureBundle:Ligne' ,
            'required' => false ,
            'query_builder' => function($er) use ($entete , $id)
    {
        return $er->createQueryBuilder('l')
                        ->where('l.id <> :idligne')
                        ->andWhere('l.parent is null')
                        ->join("l.entete" , "f")
                        ->andWhere('f.id = :id')
                        ->setParameter('id' , $entete->getId())
                        ->setParameter('idligne' , $id) ;
        ;
    } ,
            'empty_value' => '' ,
        )) ;
        $request = $this->getRequest() ;
        if ($request->isMethod("POST"))
        {
            $form->submit($request) ;
            if ($form->isValid())
            {
                $ligne = $form->getData() ;
                $ligne->setMontantNonTaxable((($ligne->getPuhtAdulte() * $ligne->getNbrAdulte()) + ($ligne->getPuhtEnfant() + $ligne->getNbrEnfant())) * $ligne->getQuantite()) ;
                $ligne->setEntete($entete)
                        ->setTauxTva($ligne->getProduit()->getTva()->getValeur())
                        ->calculMontantNonTaxable()
                        ->calculMontantTaxable()
                        ->calculeTva()
                ;
                $em->persist($ligne) ;
                $entete->addLigne($ligne)->update() ;
                $em->persist($entete) ;
                $em->flush() ;
                $session->getFlashBag()->add('success' , "ligne crée avec succées avec succées ") ;
                return $this->redirect($this->generateUrl("addligne" , array (
                                    'id' => $entete->getId() ,
                        ))) ;
            }
        }
        return $this->render("FactureBundle:facture:ligne.html.twig" , array (
                    'form' => $form->createView() ,
                    'entete' => $entete ,
                    'ligne' => $ligne
                )) ;
    }

    public function deleteLigneAction(Ligne $ligne)
    {
        $em = $this->getDoctrine()->getManager() ;
        $session = $this->getRequest()->getSession() ;
        $entete = $ligne->getEntete() ;
        $entete->removeLigne($ligne) ;
        $entete->update() ;
        $em->remove($ligne) ;
        $em->persist($entete) ;
        $em->flush() ;
        $session->getFlashBag()->add('success' , "ligne crée avec succées ") ;
        return $this->redirect($this->generateUrl("addligne" , array ('id' => $ligne->getEntete()->getId()))) ;
    }

    public function validerAction(Entete $entete)
    {
        $em = $this->getDoctrine()->getManager() ;
        $session = $this->getRequest()->getSession() ;
        $entete->setEtat(2)->setReference($this->container->get('setNewReference')->reference()) ;
        $em->persist($entete) ;
        $em->flush() ;
        $session->getFlashBag()->add('success' , "Votre facture est validée avec succées ") ;
        return $this->redirect($this->generateUrl("liste")) ;
    }

    public function annulerAction(Entete $entete)
    {
        $em = $this->getDoctrine()->getManager() ;
        $session = $this->getRequest()->getSession() ;
        $entete->setEtat(9) ;
        $em->persist($entete) ;
        $em->flush() ;
        $session->getFlashBag()->add('success' , "Votre facture est validée avec succées ") ;
        return $this->redirect($this->generateUrl("liste")) ;
    }

    public function printAction(Entete $entete)
    {
        return $this->render("FactureBundle:Facture:print.html.twig",array(
            'entete'=>$entete
        ));
    }
}
