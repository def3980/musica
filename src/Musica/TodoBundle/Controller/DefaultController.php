<?php

namespace Musica\TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;
use Musica\TodoBundle\Util\Util;
use Musica\TodoBundle\Entity\Binarios;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
        return $this->render('TodoBundle:Default:index.html.twig', array('tracks' => $q));
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
        switch ($request->get('opc')):
            case 'like':
                $dql .= 'WHERE al.alNombre LIKE :id';
            break;
            default:
                $dql .= 'WHERE al.alId = :id';
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
        $html = '';
        foreach ($q as $k => $tracks):
            $html .= '<tr>'."\n";
            $html .= '  <td>'.($k+1).'</td>'."\n";
            $html .= '  <td>'.$tracks['trNombre'].'</td>'."\n";
            $html .= '  <td>'.$tracks['trLongitud'].'</td>'."\n";
            $html .= '</tr>'."\n";
        endforeach;

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
                $bi->setBiNombre($imagen->getClientOriginalName());
                $bi->setBiTamanioBytes(intval($imagen->getClientSize()));
                $bi->setBiBin(file_get_contents($imagen->getFileInfo()));
                $bi->setBiExt($imagen->getMimeType());
                $bi->setAlbumsAl($al);

                $em = $this->getDoctrine()->getManager();
                $em->persist($bi);
                $em->flush();
                echo "<pre>";
                echo $imagen->getClientOriginalName().'<br />';
                echo ceil($imagen->getClientSize() / 1024).' KB<br />';
                echo $imagen->getFileInfo().'<br />';
                echo $imagen->getMimeType().'<br />';
                echo "</pre>";
                die();
            endif;
        endif;
        
    }
}