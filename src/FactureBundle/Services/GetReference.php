<?php

namespace FactureBundle\Services ;

use Symfony\Component\Security\Core\SecurityContextInterface ;

class GetReference
{

    public function __construct($securityContext , $entityManager)
    {
        $this->securityContext = $securityContext ;
        $this->em = $entityManager ;
    }

    public function reference()
    {
        $qb = $this->em->createQueryBuilder() ;
        $qb->select('u', $qb->expr()->max('u.reference'))
                ->from('FactureBundle:Entete' , 'u');
        $reference=$qb->getQuery()->getSingleResult();
                
        if (!$reference[1])
            return Date("Ym") . "0001" ;
        else
            return $reference[1] + 1 ;
    }

}
