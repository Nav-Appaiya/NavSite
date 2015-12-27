<?php

namespace AppBundle\Controller;

use Nav\WooBundle\Client\WooClient;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WooController.
 * By Nav 27 December 2015 for navappaiya.nl/project/woo
 * Requirements:
 *  - Woocommerce dummy shop (navappaiya.nl/wooshop)
 *  - My own custom WooBundle, written to use woocommerce rest-api-client within symfony2.
 *  - Working with Woo API-Keys to get data (orders,producst,customers etc.)
 *  - Show off every datastream on overview
 *
 * path: /project/woo
 */
class WooController extends Controller
{
    /**
     * Holds the wc_client
     * to do requests with.
     * @var
     */
    protected $wc;

    /**
     * Initialy starting with the wc_client
     * loaded to work with.
     *
     * WooController constructor.
     */
    public function __construct() {
        $this->wc = new WooClient("http://149.210.236.249/wooshop/",
            "ck_05bc2735f2574a43a0cc6d54f1e1eee7ad57b541",
            "cs_55a07f7f53d8d6ff2791319585719cda1a3da572");
    }

    public function indexAction(Request $request) {
        $customers = $this->getCustomers();
        $orders = $this->getOrders();
        $products = $this->getProducts();

        return $this->render('@App/Project/woo.html.twig',[
            'orders' => $orders->orders,
            'products' => $products->products,
            'customers' => $customers->customers,
        ]);
    }

    private function getProducts() {
        return $this->wc->products->get();
    }

    public function getCustomers() {
        return $this->wc->customers->get();
    }

    public function getOrders() {
        return $this->wc->orders->get();
    }
}
