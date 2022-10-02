<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    #[Route('/club', name: 'app_club')]
    public function index(): Response
    {
        return $this->render('club/index.html.twig', [
            'controller_name' => 'ClubController',
        ]);
    }

    #[Route('/list', name: 'list_formation')]
    public function listFormation()
    {
        $var1="3A32";
        $var2="j12";
        $formations = array(
            array('ref' => 'form147', 'Titre' => 'Formation Symfony
            4','Description'=>'pratique',
            'date_debut'=>'12/06/2020', 'date_fin'=>'19/06/2020',
            'nb_participants'=>19) ,
            array('ref'=>'form177','Titre'=>'Formation SOA' ,
            'Description'=>'theorique','date_debut'=>'03/12/2020','date_fin'=>'10/12/2020',
            'nb_participants'=>0),
            array('ref'=>'form178','Titre'=>'Formation Angular' ,
            'Description'=>'theorique','date_debut'=>'10/06/2020','date_fin'=>'14/06/2020',
            'nb_participants'=>12));
        $max = 0;
        $type_formation = "";
        for($i=0 ; $i<count($formations) ; $i++)
        {
            if ($formations[$i]['nb_participants'] >= $max)
            {
                $max = $formations[$i]['nb_participants'];
                $type_formation = $formations[$i]['Titre'];
            }
        }

        $nb_max = 0;
        for($i=0; $i<count($formations); $i++)
        {
            $nb_max += $formations[$i]['nb_participants'];
        }

        return $this->render("club/list.html.twig", array("x"=>$var1,"y"=>$var2, "tabFormations"=>$formations, "max"=>$type_formation, "nb_max"=>$nb_max));
    }
    

    #[Route('/participer', name: 'reservation_formation')]
    public function reservation()
    {

       return new Response("Nouvelle page");
       
        
    }
}      

