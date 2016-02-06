<?php
/**
 * Created by PhpStorm.
 * User: nav
 * Date: 06-02-16
 * Time: 22:17
 */

namespace AppBundle\Tests;


use AppBundle\Controller\eBookController;

class eBookControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testGetBooksArray()
    {
        $book = new eBookController();
        $this->assertArrayNotHasKey('Book1', $book->getBooksArray());
    }
}
