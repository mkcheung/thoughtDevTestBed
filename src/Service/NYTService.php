<?php
/**
 * Created by PhpStorm.
 * User: marscheung
 * Date: 8/21/18
 * Time: 9:02 AM
 */

namespace App\Service;

use App\Constants\ErrorMessages;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\Definition\Exception\Exception;

class NYTService
{

    protected $em;

    private $nytKey;
    private $nytURL;

    public function __construct(
        EntityManagerInterface $em,
        $nytURL,
        $nytKey
    ) {
        $this->em               = $em;
        $this->nytURL           = $nytURL;
        $this->nytKey           = $nytKey;
    }

    private function sortByDate($a, $b){

        if ($a['publishDate'] == $b['publishDate']) {
            return 0;
        }

        return ($a['publishDate'] < $b['publishDate']) ? -1 : 1;
    }

    private function organizeAndSort($archives){

        $organizedArchives = [];
        foreach($archives->response->docs as $archive){

            $organizedArchives[] = [
                'headline' => $archive->headline->main,
                'publishDate' => $archive->pub_date,
                'link' => $archive->web_url,
                'authors' => !empty($archive->byline) ? $archive->byline->original : null
            ];
        }

        usort($organizedArchives, [$this, 'sortByDate']);

        return $organizedArchives;
    }

    public function searchArchives(Request $request){

        $results = $request->query->all();

        if(empty($results['article_filter']['year']) && empty($results['article_filter']['month']) && empty($results['article_filter']['month']) ){
            throw new Exception("Missing year or month for archives request.");
        }

        $client = new GuzzleClient();

        $res = $client->request('GET', $this->nytURL.'svc/archive/v1/'.$results['article_filter']['year'].'/'.$results['article_filter']['month'].'.json?api-key='.$this->nytKey);

        $archives = json_decode($res->getBody()->getContents());
        $archives = $this->organizeAndSort($archives);

        return $archives;
    }

}