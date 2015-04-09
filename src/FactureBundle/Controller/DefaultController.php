<?php

namespace FactureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use FactureBundle\Entity\Tva;
use FactureBundle\Form\TvaType;
use FactureBundle\Entity\Produit;
use FactureBundle\Form\ProduitType;

class DefaultController extends Controller
{

    public function indexAction()
    {
        return $this->render('FactureBundle::dashboard.html.twig');
    }

    public function tvaAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if($id==NULL)
            $tva=new Tva();
        else
            $tva=$em->getRepository("FactureBundle:Tva")->find($id);
        $form=$this->createForm(new TvaType(), $tva);
        $tvas=$em->getRepository("FactureBundle:Tva")->findAll();
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $tva=$form->getData();
                $em->persist($tva);
                $em->flush();
                $session->getFlashBag()->add('success', "Votre traitement a été effectué avec succées");
                return $this->redirect($this->generateUrl("tva"));
            }
        }
        return $this->render("FactureBundle:ref:vue.html.twig", array(
                    'form'=>$form->createView(),
                    'tvas'=>$tvas,
                    'tva' =>$tva
        ));
    }

    public function tvaDeleteAction(Tva $tva)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        try
        {
            $em->remove($tva);
            $em->flush();
            $session->getFlashBag()->add('success', " Votre tva a été supprimée avec succées ");
        }
        catch(\Exception $ex)
        {
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }
        return $this->redirect($this->generateUrl("tva"));
    }

    public function produitAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        if($id==NULL)
            $produit=new Produit();
        else
            $produit=$em->getRepository("FactureBundle:Produit")->find($id);
        $form=$this->createForm(new ProduitType(), $produit);
        $produits=$em->getRepository("FactureBundle:Produit")->findAll();
        $request=$this->getRequest();
        if($request->isMethod("POST"))
        {
            $form->bind($request);
            if($form->isValid())
            {
                $produit=$form->getData();
                $em->persist($produit);
                $em->flush();
                $session->getFlashBag()->add('success', "Votre traitement a été effectué avec succées");
                return $this->redirect($this->generateUrl("produit"));
            }
        }
        return $this->render("FactureBundle:ref:produit.html.twig", array(
                    'form'=>$form->createView(),
                    'produits'=>$produits,
                    'produit' =>$produit
        ));
    }

    public function produitDeleteAction(Produit $produit)
    {
        $em=$this->getDoctrine()->getManager();
        $session=$this->getRequest()->getSession();
        try
        {
            $em->remove($produit);
            $em->flush();
            $session->getFlashBag()->add('success', " Votre produit a été supprimée avec succées ");
        }
        catch(\Exception $ex)
        {
            $session->getFlashBag()->add('danger', $ex->getMessage());
        }
        return $this->redirect($this->generateUrl("produit"));
    }

}
