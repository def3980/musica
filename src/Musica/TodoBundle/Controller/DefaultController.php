<?php

namespace Musica\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Doctrine\ORM\EntityManager;
use Musica\TodoBundle\Util\Util;
use Musica\TodoBundle\Entity\Binarios;

class DefaultController extends Controller
{   
    public function indexAction() {
        $dql = Util::getAllArAlTr();        
        $em = $this->getDoctrine()->getManager();
        $dql .= 'WHERE al.alId = :album '
                . 'ORDER BY al.alNombre ASC';
        $q = $em->createQuery($dql)
                ->setParameter('album', 1)
                ->getArrayResult();
        
        $dql1 = Util::getAllAlBi();
        $dql1 .= 'WHERE al.alId = :album ';
        $q1 = $em->createQuery($dql1)
                ->setParameter('album', 1)
                ->getArrayResult();
        return $this->render('TodoBundle:Default:index.html.twig', array('tracks' => $q, 'cover' => $q1));
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
        $dql = Util::getAllAl();
        $em = $this->getDoctrine()->getManager();
        $combo = $em->createQuery($dql)
                    ->getArrayResult();

        return new Response(Util::getJSON($combo));
    }
    
    public function dataAction(Request $request) {
        $dql = Util::getAllArAlTr();
        $dql1 = Util::getAllAlBi();
        switch ($request->get('opc')):
            case 'like':
                $dql .= 'WHERE al.alNombre LIKE :id';
                $dql1 .= 'WHERE al.alNombre LIKE :id';
            break;
            default:
                $dql .= 'WHERE al.alId = :id';
                $dql1 .= 'WHERE al.alId = :id';
            break;
        endswitch;
        $em = $this->getDoctrine()->getManager();
        $q = $em->createQuery($dql)
                ->setParameter(
                    'id', (
                        $request->get('opc') == 'like' ? 
                        '%'.$request->get('id').'%' : 
                        $request->get('id')
                    )
                )
                ->getArrayResult();
        $q1 = $em->createQuery($dql1)
                ->setParameter(
                    'id', ($request->get('opc') == 'like' ? '%'.$request->get('id').'%' : $request->get('id'))
                )
                ->getArrayResult();
        $html = '';
        foreach ($q as $k => $tracks):
            $html .= '<tr>'."\n";
            $html .= '  <td>'.($k+1).'</td>'."\n";
            $html .= '  <td>'.$tracks['trNombre'].'</td>'."\n";
            $html .= '  <td>'.$tracks['trLongitud'].'</td>'."\n";
            $html .= '</tr>'."\n";
        endforeach;
        if (count($q1))
            $q = array_merge($q, array(array('biId' => $q1[0]['biId'])));

        return new Response(Util::getJSON(array_merge($q, array(array('html' => $html)))));
    }
    
    public function searchAction() {
        $dql = Util::getAllAl();
        $em = $this->getDoctrine()->getManager();
        $search = $em->createQuery($dql)->getArrayResult();

        return new Response(Util::getJSON($search));
    }
    
    public function uploadAction(Request $request) {
        
        if ($request->getMethod() == 'POST'):
            $imagen = $request->files->get('cover');
            if ($imagen instanceof UploadedFile && $imagen->getError() == '0'):
                $al = $this->getDoctrine()->getRepository('TodoBundle:Albums')->find($request->get('alId'));
                $bi = new Binarios();
                $bi->setBiNombre(stristr($imagen->getClientOriginalName(), '.', true));
                $bi->setBiTamanioBytes(intval($imagen->getClientSize()));
                $bi->setBiBin(file_get_contents($imagen->getFileInfo()));
                $bi->setBiExt($imagen->getClientOriginalExtension());
                $bi->setAlbumsAl($al);

                $em = $this->getDoctrine()->getManager();
                $em->persist($bi);
                $em->flush();                
                echo "<pre>";
                echo stristr($imagen->getClientOriginalName(), '.', true).'<br />';
                echo ceil($imagen->getClientSize() / 1024).' KB<br />';
                echo $imagen->getFileInfo().'<br />';
                echo $imagen->getClientOriginalExtension().'<br />';
                echo "</pre>";

                return new RedirectResponse($this->generateUrl('todo_homepage'));
            endif;
        endif;        
    }
    
    public function viewImageAction($id) {
        $dql = Util::getAllAlBi();
        $dql .= 'WHERE al.alId = :id ';
        $em = $this->getDoctrine()->getEntityManager();
        $q = $em->createQuery($dql)
                ->setParameter('id', $id)
                ->getScalarResult();
//        $response = new Response();
//        $response->setContent(stream_get_contents($q[0]['bi_biBin']));
//        $response->setStatusCode(Response::HTTP_OK);
//        $response->headers->set('Content-type', 'image/jpeg');
//        $response->send();
//        $response = new Response(stream_get_contents($q[0]['bi_biBin']), 200, array('Content-Type' => 'image/jpeg'));
//        return $response;
        
//        $response = new Response(stream_get_contents($q[0]['bi_biBin']), 200);
//        $response->headers->set('Content-Type', 'image/jpeg');
//
//        return $response;
        
        $image  = "3_door_down_tgh.jpg";
        $file   = readfile("C:/xampp/htdocs/musica/web/uploads/images");
        $headers= array(
        'Content-Type'     => 'image/jpeg',
        'Content-Disposition' => 'inline; filename="'.$image.'"');
        return new Response($file, 200, $headers);
        
//        echo "<pre>";
//        echo __DIR__.'\..\..\..\..\web\\';
//        echo "</pre>";
//        die();
        
//        echo "<pre>";
//        print_r($q);
//        echo "</pre>";
//        die();
    }
}