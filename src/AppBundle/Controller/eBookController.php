<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
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

    private function collectBooks($param = 'php', $page = 1)
    {
        $client = new Client();
        $request = $client->request('GET', 'http://it-ebooks-api.info/v1/search/'.$param    );
        $response = json_decode($request->getBody()->getContents());
        $books = $response->Books;
        $bookCounter = count($books);

        header('Content-Type: text/plain');
        foreach ($books as $book) {
            $foundBook = $this->getDoctrine()->getRepository('AppBundle:Book')->findOneBy(array(
                'isbn' => $book->isbn
            ));
            if(!$foundBook){
                $foundBook = new Book();
                $foundBook->setIsbn($book->isbn);
                $foundBook->setCreatedAt(new \DateTime());
            }
            $foundBook->setTitle($book->Title);
            $foundBook->setSubtitle(isset($book->SubTitle) ? $book->SubTitle : '');
            $foundBook->setDescription($book->Description);
            $foundBook->setImage($book->Image);
            $foundBook->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->persist($foundBook);
            $this->getDoctrine()->getManager()->flush();

            $bookCounter++;
        }

        if($bookCounter){
            echo 'imported ' . $bookCounter . ' Books!';
        }
        exit;

    }
}
