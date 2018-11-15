<?php
/**
 * Created by PhpStorm.
 * User: vmary
 * Date: 15/11/2018
 * Time: 15:45
 */

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;

class GenusController
{
    /**
     * @Route("/genus")
     */
    public function showAction()
    {
        return new Response('Under the sea');
    }

}