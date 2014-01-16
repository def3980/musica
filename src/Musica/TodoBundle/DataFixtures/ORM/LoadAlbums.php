<?php

namespace Musica\TodoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Musica\TodoBundle\Entity\Albums;
use Musica\TodoBundle\Util\Util;

/**
 * Description of LoadAlbums
 *
 * @author Oswaldo
 */
class LoadAlbums extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {
    
    public function getOrder() { return 2; }

    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager) {
        $artistas = $manager->getRepository('TodoBundle:Artistas')->findAll();
        foreach ($artistas as $nombre):
            switch($nombre):
                case 'Metallica':
                    $albums = array(
                        array('album' => 'Kill \'Em All', 'anio' => 1983),
                        array('album' => 'Ride the Lightning', 'anio' => 1984),
                        array('album' => 'Master of Puppets', 'anio' => 1986),
                        array('album' => '...And Justice for All', 'anio' => 1988),
                    );
                    foreach ($albums as $disco):
                        $al = new Albums();
                        $al->setAlNombre($disco['album']);
                        $al->setAlAnio(new \DateTime($disco['anio']));
                        $al->setArtistasAr($nombre);
                        $manager->persist($al);
                    endforeach;
                break;
            endswitch;
        endforeach;
        
        $manager->flush();
    }

}