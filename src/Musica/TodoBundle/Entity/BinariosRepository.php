<?php

namespace Musica\TodoBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Description of BinariosRepository
 *
 * @author Oswaldo
 */
class BinariosRepository extends EntityRepository {

    /**
     * returns el numero de imagen de acuerdo al album
     * @return int
     */
    public function count($alId) {
        return $this->createQueryBuilder('bi')
                    ->select('count(bi)')
                        ->join('bi.albumsAl', 'al')
                            ->where('al.alId = :alId')
                                ->setParameter('alId', $alId)
                                    ->getQuery()
                                        ->getSQL();
    }
    
    /**
     * returns true guardar el archivo binario
     * @return int
     */
    public function insertar($alId, $params) {
        $al = $this->getEntityManager()->getRepository('TodoBundle:Albums')->find($alId);
        $bi = new Binarios();
        $bi->setBiNombre($params['biNombre']);
        $bi->setBiTamanioBytes($params['biTamanioBytes']);
        $bi->setBiBin($params['biBin']);
        $bi->setBiExtension($params['biExtension']);
        $bi->setAlbumsAl($al);

        $em = $this->getEntityManager();
        $em->persist($bi);
        $em->flush();

        return true;
    }
    
    /**
     * returns true al acutalizar la fila del archivo binario
     * @return int
     */
    public function actualizar($alId, $params) {
        $em = $this->getEntityManager();
        $bi = $em->getRepository('TodoBundle:Binarios')->find($this->getEntityManager()->getRepository('TodoBundle:Albums')->find($alId));
        $bi->setBiNombre($params['biNombre']);
        $bi->setBiTamanioBytes($params['biTamanioBytes']);
        $bi->setBiBin($params['biBin']);
        $bi->setBiExtension($params['biExtension']);
        $bi->setAlbumsAl($this->getEntityManager()->getRepository('TodoBundle:Albums')->find($alId));
        $em->flush();
        
        return true;
    }

}