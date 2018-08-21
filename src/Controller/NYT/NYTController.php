<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 8/21/18
 * Time: 10:57 AM
 */
namespace App\Controller\NYT;

use App\Service\NYTService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class NYTController extends AbstractController
{

    protected $requestErrors = [];
    protected $requestBody = [];
    protected $nytService ;

    public function __construct(NYTService $nytService)
    {
        $this->nytService = $nytService;
    }

    /**
     * @param Request $request
     * @return null
     * @Route("/nyt", methods={"GET"})
     */
    public function indexAction(Request $request){
        $results = $request->query->all();

        $archives = $this->nytService->searchArchives($request);

        return $this->render('NYT/index.html.twig', [
            'year' => $results['article_filter']['year'],
            'month' => $results['article_filter']['month'],
            'terms' => $results['article_filter']['month'],
            'archives'       => $archives,
        ]);
    }

}