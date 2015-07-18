<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 7-6-2015
 * Time: 20:21
 */

namespace Nav\ToolBoxBundle\Controller;


use Guzzle\Http\Client;
use Guzzle\Http\Message\Response;


class FeedBurner {


    public function __construct($url = "http://feeds.feedburner.com/Tutorialzine")
    {
        // Loads the Guzzle\Http\Message\Response object into $response
        $this->response = $this->preLoadClient($this->jsonConverter.$url);
        $this->entries = $this->loadEntries($this->response);
    }
    /**
     * I Call this the json-converter, but
     * its actualy the Google Apis Ajax Service
     * for converting FeedsBurners content to
     * usable JSON format.
     * @var string
     */
    protected $jsonConverter = "http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=100&q=";


    /**
     * Storing the Entries from the feed
     * @var
     */
    public $entries;

    /**
     * The Guzzle Response object to work with.
     *
     * @var
     */
    protected $response;

    /*
     * Takes a url from feedburner.com and loads it content
     * into JSON format using the google apis ajax services.
     */
    public function load($url)
    {
        return new FeedBurner($url);
    }

    /**
     * Returns the Response object to work with.
     * @param $url
     * @return \Guzzle\Http\Message\Response
     */
    private function preLoadClient($url){
        $client = new Client();
        $request = $client->get($url);
        $response = $request->send();

        return $response;
    }


    /**
     * Throws Json format back when feeded
     * with the response from the guzzle client
     *
     * @param \Guzzle\Http\Message\Response $response
     * @return array|bool|float|int|string
     */
    private function toJson(\Guzzle\Http\Message\Response $response)
    {
        return $response->json();
    }


    /**
     * Give it your Response and it will
     * return you the clean entries from it.
     *
     * @param \Guzzle\Http\Message\Response $response
     */
    private function filterEntries(\Guzzle\Http\Message\Response $response)
    {

    }

    public function loadEntries(\Guzzle\Http\Message\Response $response)
    {
        $data = $response->json();
        $this->entries = $data['responseData']['feed']['entries'];
        return $this->entries;
    }

    public function getEntries()
    {
        return $this->entries;
    }

    public function getFiveEntries()
    {
        return array_slice($this->entries, 0, 5);
    }

    public function getThreeEntries()
    {
        return array_slice($this->entries, 0, 3);
    }
}