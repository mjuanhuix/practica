<?php
namespace App\Controller;
use App\Entity\Solicitud;
use App\Entity\Cliente;
use App\Entity\AplicacionTraduccion;
use App\Form\SolicitudType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Workflow\Registry;

/**
*@Route("{_locale}/solicitud")
*/

class SolicitudController extends AbstractController {

    /**
     * @Route("/nueva/{cliente}", methods={"GET", "POST"}, name="nuevasolicitud")
     */
    public function nueva(Request $request, Registry $workflows, cliente $cliente):Response
    {

        $solicitud=new Solicitud();
        $form=$this->createForm(SolicitudType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $workflow = $workflows->get($solicitud);

            $workflow->getEnabledTransitions($solicitud);
            $solicitud->setFecha(new \DateTime());
            $solicitud->setCliente($cliente);



            //-----------------------------------------No se como añadir la aplicación a solicitud

            //$variables=$form->GetData();
            //dump($form["aplicacion"]->getData());
            //echo $_POST["aplicacion"];
            //  $aplicacion=$form["aplicacionTraduccion"]->getData();

            // dump($aplicacion);


            $em->persist($solicitud);
            $em->flush();

            return $this->redirectToRoute('caracteristicas',array('solicitud'=>$solicitud->getId()));
        }

        $locale = $request->getLocale();
        $aplicaciones=$this->getDoctrine()
            ->getRepository(AplicacionTraduccion::class)
            ->llistadoAplicacion($locale);


        return ($this->render('solicitud/nueva.html.twig',[
            'solicitud'=>$solicitud,
            'form'=> $form->createView(),
            'aplicaciones'=>$aplicaciones])
        );


    }

    /**
     *  @Route("/caracteristicas/{solicitud}", methods={"GET", "POST"}, name="caracteristicas")
     */
    public function caracteristicas(Request $request,Solicitud $solicitud){


    }

}