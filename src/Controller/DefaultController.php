<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 8/21/18
 * Time: 9:00 AM
 */

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleFilter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{

    public function indexAction(){

        $form = $this->createForm(ArticleFilter::class, null, [
            'action' => $this->generateUrl('new_york_times'),
            'method' => 'GET',
        ])->createView();

        return $this->render('base.html.twig', [
            'form'       => $form,
            ]);
    }
}