<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Form\ClassroomType;
use App\Repository\ClassroomRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    #[Route('/classroom', name: 'app_classroom')]
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    #[Route('/classroomList', name: 'app_classroomList')]
    public function list(ClassroomRepository $repository)
    {
        $classroom=$repository->findAll();
        return $this->render("classroom/list.html.twig",array("tabClassrooms"=>$classroom));
    }

    #[Route('/addClassroom', name: 'app_addClassroom')]
    public function addClassroom(ManagerRegistry $doctrine, Request $request)
    {
       
        $class=new Classroom();
        $form=$this->createForm(ClassroomType::class,$class);
        $form->handleRequest($request);
        if($form->isSubmitted())
        {
            $em=$doctrine->getManager();
            $em->persist($class);
            $em->flush();
            return $this->redirectToRoute("app_classroomList");
        }
        return $this->renderForm("classroom/addClassroom.html.twig", array("formClass"=>$form));

        
    }

    #[Route('/updateClassroom/{id}', name: 'app_updateClassroom')]
    public function updateClassroom(ClassroomRepository $repository, $id, ManagerRegistry $doctrine, Request $request)
    {
        $classroom=$repository->find($id);
        $form = $this->createForm(ClassroomType::class, $classroom);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) { 
            $em=$doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute("app_classroomList");
        }
        return $this->renderForm("classroom/updateClassroom.html.twig",
        array("formClass"=>$form));
    }

    #[Route('/removeClassroom/{id}', name: 'app_removeClassroom')]
    public function removeClassroom(ManagerRegistry $doctrine, $id, ClassroomRepository $repository)
    {
        $classroom=$repository->find($id);
        $em=$doctrine->getManager();
        $em->remove($classroom);
        $em->flush();
        return $this->redirectToRoute("app_classroomList");
    }


}


