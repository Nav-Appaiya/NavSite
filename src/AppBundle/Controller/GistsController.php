<?php

namespace AppBundle\Controller;

use Github\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GistsController.
 *
 * Requirements:
 *  - Github Client
 *  - No oAuth implementation
 *  - For now only getting my public gists
 *	- Using PrismJs for syntax highlighting http://prismjs.com/
 */
class GistsController extends Controller
{
    protected $githubClient;

    public function __construct()
    {
        $this->githubClient = new Client();
    }

    public function indexAction(Request $request)
    {
        return $this->render('AppBundle:Project:gists.html.twig', array(
			'gists' => $this->getAllMyGists()
		));
    }

	/**
	 * Returns gists array from my
	 * public stream @gists.github.com/nav-appaiya
	 *
	 * @return array
	 */
	protected function getAllMyGists()
	{
		return $this->githubClient->user()->gists('Nav-Appaiya');
	}
}
