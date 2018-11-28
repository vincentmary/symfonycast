<?php

namespace AppBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\GenusFormType;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class GenusAdminController extends Controller
{
    /**
     * @Route("/genus", name="admin_genus_list")
     */
    public function indexAction()
    {
        $genuses = $this->getDoctrine()
            ->getRepository('AppBundle:Genus')
            ->findAll();

        return $this->render('admin/genus/list.html.twig', array(
            'genuses' => $genuses
        ));
    }

    /**
     * @Route("/genus/new", name="admin_genus_new")
     */
    public function newAction()
    {
        $form = $this->createForm(GenusFormType::class);

        return $this->render(':admin/genus:new.html.twig', [
            'genusForm' => $form->createView()
        ]);
    }
}