<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Form\UsuarioType;
use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;



/**
 * @Route("/usuario")
 */
class UsuarioController extends AbstractController{


    protected $authorizationChecker;


    public function __construct(AuthorizationCheckerInterface $authorizationChecker){
        $this->authorizationChecker = $authorizationChecker;
    }
    /**
     * @Route("{_locale}/intranet", methods={"GET"}, name="intranet")
     */
    public function entrar(){

        if ($this->authorizationChecker->isGranted('ROLE_ADMINISTRADOR')) {
            return $this->redirectToRoute('administrador');

        }
        elseif ($this->authorizationChecker->isGranted('ROLE_COMERCIAL')) {
            return $this->redirectToRoute('comercial');
        }
        elseif ($this->authorizationChecker->isGranted('ROLE_JEFEPROYECTO')) {
            return $this->redirectToRoute('jefeproyecto');

        }else{
            return $this->redirectToRoute('administrador');
        }
    }
    /**
     * @Route("{_locale}/administrador",methods={"GET"}, name="administrador")
     * @IsGranted("ROLE_ADMINISTRADOR")
     */
    function panel_admin(){
        return $this->render('administrador/index.html.twig');
    }
    /**
     * @Route("{_locale}/comercial", methods={"GET"}, name="comercial")
     * @IsGranted("ROLE_COMERCIAL")
     */
    function panel_comercial(){
        return $this->render('comercial/index.html.twig');
    }

    /**
     * @Route("{_locale}/jefeproyecto", methods={"GET"}, name="jefeproyecto")
     * @IsGranted("ROLE_JEFEPROYECTO")
     */
    function panel_jefeproyecto(){
        return $this->render('jefeproyecto/index.html.twig');
    }

    public function edit_login( Usuario $usuario){

        $form = $this->createForm(UsuarioType::class, $usuario);

     return $this->render('login/index.html.twig', array('form'=>$form,'usuario'=>$usuario));
    }

    /**
     * @Route("/", name="usuario_index", methods="GET")
     */
    public function index(UsuarioRepository $usuarioRepository): Response
    {
        return $this->render('usuario/index.html.twig', ['usuarios' => $usuarioRepository->findAll()]);
    }

    /**
     * @Route("/new", name="usuario_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($usuario);
            $em->flush();

            return $this->redirectToRoute('usuario_index');
        }

        return $this->render('usuario/nueva.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="usuario_show", methods="GET")
     */
    public function show(Usuario $usuario): Response
    {
        return $this->render('usuario/show.html.twig', ['usuario' => $usuario]);
    }

    /**
     * @Route("/{id}/edit", name="usuario_edit", methods="GET|POST")
     */
    public function edit(Request $request, Usuario $usuario): Response
    {
        $form = $this->createForm(UsuarioType::class, $usuario);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('usuario_edit', ['id' => $usuario->getId()]);
        }

        return $this->render('usuario/edit.html.twig', [
            'usuario' => $usuario,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="usuario_delete", methods="DELETE")
     */
    public function delete(Request $request, Usuario $usuario): Response
    {
        if ($this->isCsrfTokenValid('delete'.$usuario->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($usuario);
            $em->flush();
        }

        return $this->redirectToRoute('usuario_index');
    }
}
