<?php
namespace AdminBundle\Controller ;
use AdminBundle\Entity\Epizy_demandeur_cvs;
use AdminBundle\Entity\Epizy_demandeur_emplois;
use AdminBundle\Entity\Epizy_demandeur_experiences;
use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

class DemandeurController extends Controller
{
    public function createAction(){
        return $this->render('AdminBundle:Demandeur:create.html.twig') ;
    }

    public function saveAction(Request $request){
        $demandeur             = $this->demandeurManager();
        $demandeur_emploi      = new Epizy_demandeur_emplois() ;
        $demandeur_cvs         = new Epizy_demandeur_cvs() ;
        $demandeur_experiences = new Epizy_demandeur_experiences() ;
        $demandeur_formations  = new Epizy_demandeur_emplois() ;

        if ($request->isMethod('POST')){
//            $demandeur_emploi->setAudition( $request->request->get('audition') ) ;
//            $demandeur_emploi->setEmploiTrouve( $request->request->get('emploi_trouve') ) ;
//            $demandeur_emploi->setNom( $request->request->get('nom') ) ;
//            $demandeur_emploi->setPrenom( $request->request->get('prenom') ) ;
//            $demandeur_emploi->setTitre( $request->request->get('titre') ) ;
//            $demandeur_emploi->setEmail( $request->request->get('email') ) ;
//            $demandeur_emploi->setAdresse( $request->request->get('adresse') ) ;
//            $demandeur_emploi->setChoixEmploi( $request->request->get('choix_emploi') ) ;
//            $demandeur_emploi->setChoixFormation( $request->request->get('choix_formation') ) ;
//            $demandeur_emploi->setDateDeNaissance( $request->request->get('date_de_naissance') ) ;
//            $demandeur_emploi->setNewsletter( $request->request->get('newsletter') ) ;
//            $demandeur_emploi->setNotificationEmploiPoste( $request->request->get('notification_emploi_poste') ) ;
//            $demandeur_emploi->setTelephone( $request->request->get('telephone') ) ;
//            $demandeur_emploi->setRegion( $request->request->get('region') ) ;
//            $demandeur_emploi->setStatus( $request->request->get('status') ) ;
//            $demandeur_emploi->setVille( $request->request->get('ville') ) ;
//
//            $demandeur->persist($demandeur_emploi) ;
//            $demandeur->flush();


            $data = $request->request->get('date_de_naissance') ;
            var_dump( );
        }
        return new Response('ok');
    }

    public function demandeurManager(){
        return $this->getDoctrine()->getManager();
    }

}