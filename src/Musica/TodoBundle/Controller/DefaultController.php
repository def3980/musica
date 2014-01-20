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
                    . 'WHERE al.alId = :album'
                )->setParameter('album', 4)
//                ->useResultCache(true)
                ->getArrayResult();
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
        $combo = $em->createQuery('SELECT al FROM TodoBundle:Albums al ORDER BY al.alNombre')
//                    ->useResultCache(true)
                    ->getArrayResult();

        return new Response(Util::getJSON($combo));
    }
    
    public function dataAction(Request $request) {
        $dql = 'SELECT tr, al, ar '
                . 'FROM TodoBundle:Tracks tr '
                . 'JOIN tr.albumsAl al '
                . 'JOIN al.artistasAr ar ';
        switch ($request->get('opc')):
            case 'like':
                $dql .= 'WHERE al.alNombre LIKE :id';
            break;
            default:
                $dql .= 'WHERE al.alId = :id';
            break;
        endswitch;
        $q = $this->getDoctrine()
                    ->getManager()
                    ->createQuery($dql)
                    ->setParameter('id', ($request->get('opc') == 'like' ? '%'.$request->get('id').'%' : $request->get('id')))
//                    ->useResultCache(true)
                    ->getArrayResult();
        $html = '';
        foreach ($q as $k => $tracks):
            $html .= '<tr>'."\n";
            $html .= '  <td>'.($k+1).'</td>'."\n";
            $html .= '  <td>'.$tracks['trNombre'].'</td>'."\n";
            $html .= '  <td>'.$tracks['trLongitud'].'</td>'."\n";
            $html .= '</tr>'."\n";
        endforeach;
        $q = array_merge($q, array(array('html' => $html)));
//        Util::getMyDump($q);
//        return new Response($html);
        return new Response(Util::getJSON($q));
    }
    
    public function searchAction() {
        $em = $this->getDoctrine()->getManager();
        $search = $em->createQuery('SELECT al.alNombre FROM TodoBundle:Albums al ORDER BY al.alNombre')
//                    ->useResultCache(true)
                    ->getArrayResult();

        return new Response(Util::getJSON($search));
    }
}
