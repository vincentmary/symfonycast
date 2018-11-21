<?php
/**
 * Created by PhpStorm.
 * User: vmary
 * Date: 21/11/2018
 * Time: 16:41
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MainController extends Controller
{
    public function homePageAction()
    {
        return $this->render('main/homepage.html.twig');
    }

}