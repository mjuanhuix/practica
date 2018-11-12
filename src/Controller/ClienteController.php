<?php

namespace App\Controller;

use App\Entity\Cliente;
use App\Form\ClienteType;
use App\Repository\ClienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("{_locale}/cliente")
 */
class ClienteController extends AbstractController
{
    /**
     * @Route("/", name="cliente_index", methods="GET")
     */
    public function index(ClienteRepository $clienteRepository): Response
    {
        return $this->render('cliente/index.html.twig', ['clientes' => $clienteRepository->findAll()]);
    }

    /**
     * @Route("/nuevo", name="cliente_nuevo", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $cliente = new Cliente();
        $form = $this->createForm(ClienteType::class, $cliente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $locale = $request->getLocale();
            $cliente->setIdioma($locale);
            $em->persist($cliente);
            $em->flush();


            //Una vez guardado el cliente: se va al formuario de solicitud
            return $this->redirectToRoute('nuevasolicitud',array('cliente'=>$cliente->getId()));
        }

        return $this->render('cliente/nuevo.html.twig', [
            'cliente' => $cliente,
            'form' => $form->createView(),
        ]);
    }


}
