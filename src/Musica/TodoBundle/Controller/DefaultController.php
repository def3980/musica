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
                ->useResultCache(true)
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
                    ->useResultCache(true)
                    ->getArrayResult();

        return new Response(Util::getJSON($combo));
    }
    
    public function dataAction(Request $request) {
//        $em = $this->getDoctrine()->getEntityManager();
//        $data = $em->createQueryBuilder()
//                    ->select('tr','al')
//                    ->from('TodoBundle:Tracks', 'tr')
//                    ->innerJoin('tr.albumsAl', 'al');
//        if (gettype($request->get('id')) == 'string'):
//            $data->where('al.alNombre LIKE :id')
//                    ->setParameter('id', '%'.$request->get('id').'%');
//        else:
//            $data->where('al.alId = :id')
//                    ->setParameter('id', $request->get('id'));
//        endif;
//            $data->getQuery()->getArrayResult();
        $qb = $this->getDoctrine()->getEntityManager()
                ->createQueryBuilder()
                ->select('tr','al')
                ->from('TodoBundle:Tracks', 'tr')
                ->innerJoin('tr.albumsAl', 'al');
                $qb->where('al.alNombre LIKE :id')
                ->setParameter('id', '%ri%')
                ->getQuery()
                ->getArrayResult();
        Util::getMyDump($qb);
        $html = '';
        foreach ($data as $k => $tracks):
            $html .= '<tr>'."\n";
            $html .= '  <td>'.($k+1).'</td>'."\n";
            $html .= '  <td>'.$tracks['trNombre'].'</td>'."\n";
            $html .= '  <td>'.$tracks['trLongitud'].'</td>'."\n";
            $html .= '</tr>'."\n";
        endforeach;
        return new Response($html);
//        return new Response(Util::getJSON($data));
    }
    
    public function searchAction() {
        $em = $this->getDoctrine()->getManager();
        $search = $em->createQuery('SELECT al.alNombre FROM TodoBundle:Albums al ORDER BY al.alNombre')
                    ->useResultCache(true)
                    ->getArrayResult();

        return new Response(Util::getJSON($search));
    }
}
