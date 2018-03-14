<?php
/**
 * Created by PhpStorm.
 * User: Nambinina
 * Date: 13/03/2018
 * Time: 09:53
 */
namespace AdminBundle\Controller;
use AdminBundle\Entity\epizy_entreprises;
use AdminBundle\Entity\epizy_secteur_activites;
use AdminBundle\Entity\epizy_roles;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
class EntrepriseController extends Controller
{
    /**
     * Matches /blog exactly
     *
     * @Route("/entreprise/index", name="admin_entreprise_index")
     */
    public function indexAction(){
        $entreprise = new epizy_entreprises();
        $em = $this->getDoctrine()->getManager();
        $listEntreprise= $em->getRepository('AdminBundle:epizy_entreprises')->findAll();
        return $this->render('AdminBundle:OffreEmploi:liste_entreprise.html.twig', array('listEntreprise'=>$listEntreprise));
    }
    /**
     * Matches /blog exactly
     *
     * @Route("/entreprise/create", name="admin_entreprise_create")
     * * @Method({"GET", "POST"})
     */
    public function createAction(Request $request){
        $epizy_entreprise = new Epizy_entreprise();
        $form = $this->createForm('AdminBundle\Form\epizy_entreprisesType', $epizy_entreprise);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($epizy_entreprise);
            $em->flush($epizy_entreprise);

            return $this->redirectToRoute('admin_entreprise_index');
        }

        return $this->render('AdminBundle:OffreEmploi:create_entreprise.html.twig', array(
            'epizy_entreprise' => $epizy_entreprise,
            'form' => $form->createView(),
        ));
    }

    /**
     * Matches /blog exactly
     *
     * @Route("/entreprise/secteur", name="admin_entreprise_secteur_index")
     */
    public function listeSecteurAction(){
        $em =  $this->getDoctrine()->getManager();
        $listSecteur = $em->getRepository('AdminBundle:epizy_secteur_activites')->findAll();
        return  $this->render('AdminBundle:OffreEmploi:liste_secteur.html.twig', array('listSecteur'=>$listSecteur));
    }

    /**
     * Finds and displays a epizy_entreprise entity.
     *
     * @Route("/detail/{id}", name="entreprise_show")
     * @Method("GET")
     */
    public function showAction($id)
    {
        $em =  $this->getDoctrine()->getManager();
        $epizy_entreprise = $em->getRepository('AdminBundle:epizy_entreprises')->find($id);
        if(null == $epizy_entreprise){
            throw new NotFoundHttpException('entreprise introuvable');
        }
        $deleteForm = $this->createDeleteForm($epizy_entreprise);

        return $this->render('AdminBundle:OffreEmploi:liste_secteur.html.twig', array(
            'epizy_entreprise' => $epizy_entreprise,
            'delete_form' => $deleteForm->createView(),
        ));
    }


}