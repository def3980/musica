<?php

namespace Musica\TodoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Musica\TodoBundle\Entity\Artistas;

/**
 * Description of LoadArtistas
 *
 * @author Oswaldo
 */
class LoadArtistas extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {
    
    public function getOrder() { return 1; }

    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager) {
        $artistas = array(
            'Metallica',
            'Megadeth',
            'Kreator',
            'Slayer',
        );
        foreach ($artistas as $nombre):
            $ar = new Artistas();
            $ar->setArNombre($nombre);
            $manager->persist($ar);
        endforeach;
        $manager->flush();
    }

}