<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 23-3-2015
 * Time: 15:58
 */

namespace Nav\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{

    public function indexAction(Request $request)
    {
        $searchTerm = $request->get('search');
        $em = $this->getDoctrine();

        $results = $em->getRepository("NavCMSBundle:Page")->createQueryBuilder('p')
            ->where('p.title LIKE :searchTerm')
            ->orWhere('p.content LIKE :searchTerm')
            ->orWhere('p.feed LIKE :searchTerm')
            ->setParameter('searchTerm', '%' . $searchTerm . '%')
            ->getQuery()
            ->getResult();

        return $this->render('@NavCMS/Default/search.html.twig', [
            'results' => $results
        ]);
    }


}