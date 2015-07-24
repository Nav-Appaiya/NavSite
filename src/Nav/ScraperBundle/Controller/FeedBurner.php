<?php

/**
 * Created by PhpStorm.
 * User: Nav Appaiya
 * Date: 16-3-2015
 * Time: 20:33.
 */

namespace Nav\ScraperBundle\Controller;

use GuzzleHttp\Client;

/**
 * Class FeedBurner.
 */
class FeedBurner
{
    protected $client;
    protected $entries;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=100&q=']);
    }

    public function loadFeed($url)
    {
        $googleApi = 'http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=100&q=http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=100&q=';
        $request = $this->client->get($googleApi, ['verify' => false]);

        return $request->getBody();

        $resultObject = ['object' => false];

        $result = $this->client->get($googleApi.$url);
        $filter = $result->json($resultObject);

        $responseData = $filter['responseData'];
        $feed = $responseData['feed'];

        $this->entries = $feed['entries'];

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getEntries()
    {
        return $this->entries;
    }

    /**
     * @return mixed
     */
    public function getOneEntry()
    {
        $total = count($this->entries) - 1;

        return $this->entries[$total];
    }

    /**
     * @param mixed $entries
     */
    public function setEntries($entries)
    {
        $this->entries = $entries;
    }

    /**
     * @return int
     */
    public function count()
    {
        return isset($this->entries) ? count($this->entries) : 'No entries loaded, first load the feed';
    }
}
