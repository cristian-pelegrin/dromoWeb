<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\DependencyInjection\Parameter;
use Doctrine\Common\Collections\Criteria;
/**
 * PromocionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PromocionRepository extends EntityRepository
{
   /**
    * Retorna un array con las promociones de el local pasado por id y que no esten eliminadas
    * @param integer $idLocal
    * @return array
    */
    function getPromocionesLocal($idLocal){
        $promociones = $this->getEntityManager()
                ->createQuery('SELECT p FROM AppBundle:Promocion p '
                        . 'LEFT JOIN p.localComercial l '
                        . 'LEFT JOIN p.estadoPromocion e '
                        . 'WHERE l.id = :idLocal AND e.nombre != :nombreEstado')
                    ->setParameters(array(
                        'idLocal' => $idLocal,
                        'nombreEstado' => 'eliminada'))
                    ->getResult();
        return $promociones;
    }
}
