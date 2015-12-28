<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CuponRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CuponRepository extends EntityRepository
{
    public function crearNuevoCupon(ProgramacionEnDia $programacionEnDia, UsuarioMovil $usuarioMovil){
        $cupon = new Cupon();
        $cupon->setCodigo(uniqid());
        $cupon->setEstadoCupon(
                $this->getEntityManager()->getRepository('AppBundle:EstadoCupon')->findOneByNombre('porCanjear')
            );
        $cupon->setFecha(new \DateTime("now"));
        $cupon->setVencimiento($programacionEnDia->getVencimiento());
        $cupon->setProgramacion($programacionEnDia->getProgramacion());
        $cupon->setTipoCupon(
                $this->getEntityManager()->getRepository('AppBundle:TipoCupon')->findOneByNombre('promocion')
            );
        $cupon->setUsuarioMovil($usuarioMovil);
        $this->getEntityManager()->persist($cupon);
        $this->getEntityManager()->flush();
        return $cupon;
    }
}