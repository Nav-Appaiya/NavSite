<?php

namespace Nav\CMSBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $pages = $em->getRepository('NavCMSBundle:Page')->findAll();

        return $this->render('NavCMSBundle:Default:index.html.twig', array(
            'pages' => $pages,
        ));
    }

    public function displayAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository('NavCMSBundle:Page')->find($id);

        // Get the articles
        $articles = $this->getFeedArticles($page->getFeed());

        return $this->render('NavCMSBundle:Default:display.html.twig', array(
            'page' => $page,
            'articles' => $articles,
        ));
    }

    /**
     * RSS to JSON with the
     * Google API's.
     *
     * @param $feed
     *
     * @return mixed
     */
    private function getFeedArticles($feed)
    {
        $content = file_get_contents('http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=10&q='.$feed);

        return json_decode($content)->responseData->feed;
    }
}
