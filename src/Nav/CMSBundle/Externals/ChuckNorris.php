<?php
/**
 * Created by PhpStorm.
 * User: Nav Appaiya
 * Date: 16-3-2015
 * Time: 23:33
 */

namespace Nav\ScraperBundle\Controller;


use GuzzleHttp\Client;
use Symfony\Component\Security\Acl\Exception\Exception;

class ChuckNorris
{
    protected $client;
    protected $entry;

    public function __construct()
    {
        $this->client = new Client();
    }


    public function getOneRandomChuckNorrisJoke()
    {
        $response = $this->client->get("http://api.icndb.com/jokes/random")->json(['object' => true]);
        if ($response->type !== "success") {
            return new Exception("Could not fetch from icndb.com. Sorry mate.");
        }
        return $response->value->joke;
    }

    public function makeOneChuckNorrisJokeByName($first, $last = "")
    {
        $url = sprintf("http://api.icndb.com/jokes/random?firstName=%s&lastName=%s", $first, $last);
        $response = $this->client->get($url)->json(['object' => true]);

        if ($response->type !== "success") {
            return new Exception("Could not fetch from icndb.com. Sorry mate.");
        }
        return $response->value->joke;
    }

}