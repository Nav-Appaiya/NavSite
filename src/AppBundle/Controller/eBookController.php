<?php

namespace AppBundle\Controller;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class eBookController extends Controller
{
    public function indexAction()
    {
        $books = $this->collectBooks();



        /* TODO: REMOVE Me AFTER DEBUGGING PLEASE. */
        header('Content-Type: text/plain');
        print_r(
            $books
        );
        exit;


        die('hi ebooks');
    }

    private function collectBooks($param = 'php')
    {
        $client = new Client();
        $request = $client->request('GET', 'http://it-ebooks-api.info/v1/search/'.$param);
        $response = json_decode($request->getBody()->getContents());
        $books = $response->Books;

        /* TODO: REMOVE Me AFTER DEBUGGING PLEASE. */
        header('Content-Type: text/plain');
        print_r($books);
        exit;

    }
}
