<?php

/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 18-3-2015
 * Time: 19:59.
 *
 * @Usbstikje, a random twitterbot.
 */

namespace Nav\CMSBundle\Controller;

use GuzzleHttp\Client;
use Nav\CMSBundle\Entity\Joke;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\True;

/**
 * Class UsbstikController.
 */
class UsbstikController extends Controller
{
    public function indexAction(Request $request)
    {
        $joke = new Joke();
        $form = $this->createFormBuilder($joke)
            ->add('firstName', 'text', array('label' => 'First name:'))
            ->add('lastName', 'text', array('label' => 'Last name: '))
            ->add('save', 'submit', array(
                'label' => 'Tweet',
                'attr' => array('class' => 'btn btn-danger btn-sm'),
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $chucknorris = $this->get('scraper.chuck_norris');
            $twitter = $this->get('guzzle.twitter.client');

            $personalJoke = $chucknorris->makeOneChuckNorrisJokeByName(
                $joke->getFirstName(),
                $joke->getLastName()
            );
            $joke->setJoke($personalJoke);
            $this->tweetThis($personalJoke);

            $em = $this->getDoctrine()->getManager();
            $em->persist($joke);
            $em->flush();

            $notifications = $this->get('nav.notification');
            $notifications->add('notifications', array('title' => 'Success', 'message' => 'Personal Shots have been fired!'));

            return $this->redirect($this->generateUrl('nav_usbstikje'));
        }

        return $this->render('NavCMSBundle:Tweets:index.html.twig', [
            'joke' => $form->createView(),
            'tweets' => $this->getTweets(),
        ]);
    }

    public function getTweets()
    {
        $twitter = $this->get('guzzle.twitter.client');
        $statuses = $twitter->get('statuses/user_timeline.json')->send()->json();

        foreach ($statuses as $status) {
            $tweets[] = $status;
        }

        return $tweets;
    }

    /**
     * - /usbstikje.
     */
    public function startAction()
    {
        $tweet = $this->getLuckyTweetPost();
        $shortUrl = $this->getGooglShortUrl($tweet['link']);
        $composedTweet = substr($tweet['title'], 0, 120).' - '.$shortUrl->id;

        $response = $this->tweetThis($composedTweet);

        if ($response !== 200) {
            //@TODO: Error handling
        }

        var_dump($response);
        exit;
    }

    /**
     * @param $tweet
     *
     * @return int statuscode
     */
    public function tweetThis($tweet)
    {
        $twitter = $this->get('guzzle.twitter.client');
        $status = $twitter->post('statuses/update.json', null, ['status' => $tweet])
            ->send();

        return $status->getStatusCode();
    }

    /**
     * Returns a  tweet.
     */
    public function getLuckyTweetPost()
    {
        $chuck = $this->get('scraper.chuck_norris');
        $feedburner = $this->get('scraper.feedburner');
        $em = $this->getDoctrine()->getEntityManager();
        $allFeeds = $em->getRepository('NavCMSBundle:Page')->findAll();

        foreach ($allFeeds as $feed) {
            $feeds[] = $feed->getFeed();
        }

        // And the lucky feed is:
        $luckyFeed = $feeds[rand(0, 5)];
        $feedburner->loadFeed($luckyFeed);
        $luckyArticle = $feedburner->getOneEntry();

        // Some feeds dont return contentSnippet,
        // load the title instead if contentSnippet strlen < 10
        if (strlen($luckyArticle['contentSnippet']) < 10) {
            $luckyArticle['contentSnippet'] = substr($luckyArticle['title'], 0, 135).'...';
        }

        return $luckyArticle;
    }

    public function getGooglShortUrl($url)
    {
        $client = new Client();
        $key = $this->container->getParameter('googl_key');
        $requestUrl = 'https://www.googleapis.com/urlshortener/v1/url?key='.$key;

        $response = $client->post($requestUrl, [
            'verify' => false,
            'body' => json_encode(['longUrl' => $url]),
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        return $response->json([
            'object' => true,
        ]);
    }

    public function getOneChuckNorrisJoke()
    {
        $chuck = $this->get('scraper.chuck_norris');

        return $chuck->getOneRandomChuckNorrisJoke();
    }
}
