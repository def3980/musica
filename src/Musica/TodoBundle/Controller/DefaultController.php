<?php

namespace Musica\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use Musica\TodoBundle\Util\Util;

class DefaultController extends Controller
{
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $dql = $em->createQuery(
                    'SELECT tr, al, ar '
                    . 'FROM TodoBundle:Tracks tr '
                    . 'JOIN tr.albumsAl al '
                    . 'JOIN al.artistasAr ar '
                    . 'WHERE al.alNombre '
                    . 'LIKE :album'
                )->setParameter('album', '%And%')
                ->getArrayResult();
//        Util::getMyDump($dql);
        return $this->render('TodoBundle:Default:index.html.twig', array('tracks' => $dql));
    }
    
    public function loginAction (Request $request) {
        if ($request->getMethod() == 'POST'):
            $usr = $request->get('usr');
            $pwd = $request->get('pwd');
            $user = $this->getDoctrine()
                            ->getManager()
                                ->getRepository('TodoBundle:Usuarios')
                                    ->findOneBy(array('usUsuario' => $usr, 'usContrasenia' => $pwd));
            if ($user):
                return $this->redirect($this->generateUrl('todo_homepage'));
            else:
                return $this->render('TodoBundle:Default:login.html.twig', array('name' => 'Usuario o contraseÃ±a invalidos'));
            endif;
        else:
            return $this->render('TodoBundle:Default:login.html.twig');
        endif;
    }
    
    public function registerAction (Request $request) {
        if ($request->getMethod() == 'POST'):
            $name = $request->get('name');
            $usr = $request->get('usr');
            $pwd = $request->get('pwd');
            
            $us = new Usuarios();
            $us->setUsNombre($name);
            $us->setUsUsuario($usr);
            $us->setUsContrasenia($pwd);
            $em = $this->getDoctrine()->getManager();
            $em->persist($us);
            $em->flush();
        endif;
        
        return $this->render('TodoBundle:Default:register.html.twig');
    }
    
    public function comboAlbumsAction() {
        $em = $this->getDoctrine()->getManager();
        $combo = $em->createQueryBuilder()
                    ->select('al')
                    ->from('TodoBundle:Albums','al')
                    ->orderBy('al.alNombre','ASC')
                    ->getQuery()
                    ->getArrayResult()
                ;
        
//        return $this->render('TodoBundle:Default:comboAlbums.html.twig', array('combo' => $combo));
        return new Response(Util::getJSON($combo));
    }
    
    public function dataAction(Request $request) {
        $em = $this->getDoctrine()->getEntityManager();
        $data = $em->createQuery(
                        'SELECT tr, al '
                        . 'FROM TodoBundle:Tracks tr '
                        . 'JOIN tr.albumsAl al '
                        . 'WHERE al.alId = :id'
                    )->setParameter('id', $request->get('id'))
                    ->getArrayResult();
//        Util::getMyDump($data);
        return new Response(Util::getJSON($data));
    }
}
