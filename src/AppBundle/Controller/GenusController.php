<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Genus;
use AppBundle\Entity\GenusNote;
use AppBundle\Service\MarkDownTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class GenusController extends Controller
{
    /**
     * @Route("/genus")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $genuses = $em->getRepository('AppBundle:Genus')
            ->findAllPublishedOrderedByRecentlyActive();

        return $this->render('genus/list.html.twig', [
            'genuses' => $genuses
        ]);

    }

    /**
     * @Route("/genus/new")
     */
    public function newAction()
    {
        $genus = new Genus();
        $genus->setName('Octopus'.rand(1,100));
        $genus->setSpeciesCount(rand(1, 100000));
        $genus->setIsPublished(true);

        $genusNote = new GenusNote();
        $genusNote->setNote('I counted 8 legs....as they wrapped around me');
        $genusNote->setUsername('Aquaweaver');
        $genusNote->setUserAvatarFileName('lenna.jpeg');
        $genusNote->setCreatedAt(new \DateTime('-1 month'));
        $genusNote->setGenus($genus);

        $em = $this->getDoctrine()->getManager();
        $em->persist($genusNote);
        $em->persist($genus);
        $em->flush();

        return new Response('<html><body>Genus created!</body></html>');
    }

    /**
     *
     * @param Genus $genus The genus object.
     *
     * @Route("/genus/{name}", name="genus_show")
     *
     * @return Response
     */
    public function showAction(Genus $genus)
    {

        $recentNotes = $this->getDoctrine()->getManager()
            ->getRepository('AppBundle:GenusNote')
            ->findAllRecentNotesForGenus($genus);

        return $this->render('genus/show.html.twig', array(
            'genus' => $genus,
            'recentNoteCount' => count($recentNotes)
        ));
    }

    /**
     * @Route("/genus/{name}/notes", name="genus_show_notes"), methods={"GET", "HEAD"})
     */
    public function getNotesAction(Genus $genus)
    {
        $notes = [];
        foreach ($genus->getNotes() as $note) {
            $notes[] = [
                'id' => $note->getId(),
                'username' => $note->getUsername(),
                'avatarUri' => '/images/'.$note->getUserAvatarFileName(),
                'note' => $note->getNote(),
                'date' => $note->getCreatedAt()->format('M, d, Y')
            ];
        }

        return new JsonResponse([
            'notes' => $notes
        ]);

    }

}
