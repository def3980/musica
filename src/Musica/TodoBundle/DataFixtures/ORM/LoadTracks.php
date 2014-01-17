<?php

namespace Musica\TodoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Musica\TodoBundle\Entity\Tracks;
use Musica\TodoBundle\Util\Util;

/**
 * Description of LoadTracks
 *
 * @author Oswaldo
 */
class LoadTracks extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {
    
    public function getOrder() { return 3; }

    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager) {
        $albums = $manager->getRepository('TodoBundle:Albums')->findAll();
        foreach ($albums as $disco):
            switch($disco):
                case 'Kill \'Em All':
                    $tracks = array(
                        array('titulo' => 'Hit the Lights', 'long' => '4:15'),
                        array('titulo' => 'The Four Horsemen', 'long' => '7:10'),
                        array('titulo' => 'Motorbreath', 'long' => '3:05'),
                        array('titulo' => 'Jump in the Fire', 'long' => '4:40'),
                        array('titulo' => '(Anesthesia) Pulling Teeth', 'long' => '4:14'),
                        array('titulo' => 'Whiplash', 'long' => '4:08'),
                        array('titulo' => 'Phantom Lord', 'long' => '4:59'),
                        array('titulo' => 'No Remorse', 'long' => '6:23'),
                        array('titulo' => 'Seek and Destroy', 'long' => '6:51'),
                        array('titulo' => 'Metal Militia', 'long' => '5:11'),
                    );
                    foreach ($tracks as $cancion):
                        $tr = new Tracks();
                        $tr->setTrNombre(Util::getUCWord($cancion['titulo']));
                        $tr->setTrLongitud(new \DateTime($cancion['long']));
                        $tr->setAlbumsAl($disco);
                        $manager->persist($tr);
                    endforeach;
                break;
                case Util::getUCWord('Ride the Lightning'):
                    $tracks = array(
                        array('titulo' => 'Fight Fire with Fire', 'long' => '4:44'),
                        array('titulo' => 'Ride the Lightning', 'long' => '6:36'),
                        array('titulo' => 'For Whom the Bell Tolls', 'long' => '5:10'),
                        array('titulo' => 'Fade to Black', 'long' => '6:56'),
                        array('titulo' => 'Trapped Under Ice', 'long' => '4:03'),
                        array('titulo' => 'Escape', 'long' => '4:23'),
                        array('titulo' => 'Creeping Death', 'long' => '6:36'),
                        array('titulo' => 'The Call of Ktulu', 'long' => '8:52'),
                    );
                    foreach ($tracks as $cancion):
                        $tr = new Tracks();
                        $tr->setTrNombre(Util::getUCWord($cancion['titulo']));
                        $tr->setTrLongitud(new \DateTime($cancion['long']));
                        $tr->setAlbumsAl($disco);
                        $manager->persist($tr);
                    endforeach;
                break;
                case Util::getUCWord('Master of Puppets'):
                    $tracks = array(
                        array('titulo' => 'Battery', 'long' => '5:10'),
                        array('titulo' => 'Master of Puppets', 'long' => '8:38'),
                        array('titulo' => 'The Thing That Should Not Be', 'long' => '6:32'),
                        array('titulo' => 'Welcome Home (Sanitarium)', 'long' => '6:28'),
                        array('titulo' => 'Disposable Heroes', 'long' => '8:14'),
                        array('titulo' => 'Leper Messiah', 'long' => '5:38'),
                        array('titulo' => 'Orion', 'long' => '8:12'),
                        array('titulo' => 'Damage, Inc', 'long' => '5:08'),
                    );
                    foreach ($tracks as $cancion):
                        $tr = new Tracks();
                        $tr->setTrNombre(Util::getUCWord($cancion['titulo']));
                        $tr->setTrLongitud(new \DateTime($cancion['long']));
                        $tr->setAlbumsAl($disco);
                        $manager->persist($tr);
                    endforeach;
                break;
                case Util::getUCWord('...And Justice for All'):
                    $tracks = array(
                        array('titulo' => 'Blackened', 'long' => '6:42'),
                        array('titulo' => '...And Justice for All', 'long' => '9:45'),
                        array('titulo' => 'Eye of the Beholder', 'long' => '6:25'),
                        array('titulo' => 'One', 'long' => '7:26'),
                        array('titulo' => 'The Shortest Straw', 'long' => '6:35'),
                        array('titulo' => 'Harvester of Sorrow', 'long' => '5:45'),
                        array('titulo' => 'The Frayed Ends of Sanity', 'long' => '7:43'),
                        array('titulo' => 'To Live Is to Die', 'long' => '9:48'),
                        array('titulo' => 'Dyers Eve', 'long' => '5:13'),
                    );
                    foreach ($tracks as $cancion):
                        $tr = new Tracks();
                        $tr->setTrNombre(Util::getUCWord($cancion['titulo']));
                        $tr->setTrLongitud(new \DateTime($cancion['long']));
                        $tr->setAlbumsAl($disco);
                        $manager->persist($tr);
                    endforeach;
                break;
            endswitch;
        endforeach;
        
        $manager->flush();
    }

}