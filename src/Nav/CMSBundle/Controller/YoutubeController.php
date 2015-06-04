<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 24-3-2015
 * Time: 1:19
 *
 * Youtube downloader Controller
 * - Render form
 * - Take postdata
 * - Process and return download
 */

namespace Nav\CMSBundle\Controller;

use Nav\CMSBundle\Entity\Youtube;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class YoutubeController
 *
 * @package Nav\CMSBundle\Controller
 */
class YoutubeController extends Controller
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {

        $youtube = new Youtube();
        $mp4Form = $this->youtubeToMp4Form($youtube);
        $mp4Form->handleRequest($request);

        // Now we got the url, lets request a download
        // By hitting /bin/getvideo.php with videoid=url
        if ($mp4Form->isValid()) {
            $data = $this->get('request')->request->all();
            $youtube->setUrl($this->getCleanVideoId($data['form']['url']));
            $em = $this->getDoctrine()->getManager();
            $youtube->setRequestedIp($this->get('request')->getClientIp());
            $youtube->setComputerName($this->get('request')->getHost());
            $em->persist($youtube);
            $em->flush();
            $notify = $this->get('nav.notification');
            $notify->add('notification', ['title' => 'Success', 'message' => 'Done!']);
            return new RedirectResponse("http://navappaiya.nl/bin/getvideo.php?videoid=" . $youtube->getUrl() . "&format=free");
        }
        return $this->render('NavCMSBundle:Media:youtube.html.twig', [
            'mp4form' => $mp4Form->createView()
        ]);
    }

    /**
     * @param $url
     * @return string
     */
    public function getCleanVideoId($url)
    {
        // https://www.youtube.com/watch?v=uBRhI4Rn7hQ
        $first = explode('/', $url);

        // watch?v=uBRhI4Rn7hQ
        $last = $first[count($first) - 1];

        // TODO: Find out if this is always true (11 chars chopped of the end)
        $final = substr($last, -11);

        return $final;
    }

    /**
     * @param $youtube
     * @return \Symfony\Component\Form\Form
     */
    public function youtubeToMp4Form($youtube)
    {
        $form = $this->createFormBuilder($youtube)
            ->add('url', 'text', array('label' => 'Youtube to mp4'))
            ->add('download', 'submit', array(
                'label' => 'Get Download',
                'attr' => array('class' => 'btn btn-danger btn-sm')
            ))->getForm();
        return $form;
    }


}