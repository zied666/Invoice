<?php

namespace FactureBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use FactureBundle\Entity\Tva;
use FactureBundle\Form\TvaType;
use FactureBundle\Entity\Produit;
use FactureBundle\Form\ProduitType;
use UserBundle\Entity\User;
use UserBundle\Form\RegistrationFormType;
use FactureBundle\Entity\Entete;
use FactureBundle\Form\EnteteType;
use Symfony\Component\HttpFoundation\Response;

class AjaxController extends Controller
{

    public function listeClientAction()
    {
        $host=$this->container->getParameter('database_host');
        $user=$this->container->getParameter('database_user');
        $bdd=$this->container->getParameter('database_name');
        $passwd=$this->container->getParameter('database_password');
        $link=mysqli_connect($host, $user, $passwd, $bdd) or die("erreur de connexion au serveur");
        $json=array();
        mysqli_query($link, "SET NAMES 'utf8'");
        $requete="SELECT * FROM ttt_clients";
        $result=mysqli_query($link, $requete);
        while($row=mysqli_fetch_array($result))
        {
            $json[$row['id']][]=$row['nom'].' '.$row['prenom'];
        }
        return new Response(json_encode($json));
    }

    public function detailsClientAction()
    {
        $host=$this->container->getParameter('database_host');
        $user=$this->container->getParameter('database_user');
        $bdd=$this->container->getParameter('database_name');
        $passwd=$this->container->getParameter('database_password');
        $link=mysqli_connect($host, $user, $passwd, $bdd) or die("erreur de connexion au serveur");
        $json=array();
        mysqli_query($link, "SET NAMES 'utf8'");
        $requete="SELECT * FROM ttt_clients where id=".$this->getRequest()->get("id");
        $result=mysqli_query($link, $requete);
        $row=mysqli_fetch_array($result);
        $json['nom']=$row['nom'].' '.$row['prenom'];
        $json['adresse']=$row['adresse'];
        $json['matricule']=$row['matricule_fiscale'];
        $json['tel']=$row['tel'];
        $json['email']=$row['email'];
        return new Response(json_encode($json));
    }

}
