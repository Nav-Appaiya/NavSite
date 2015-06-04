<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 14-3-2015
 * Time: 0:05
 */

namespace Nav\NotificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class NotificationController
 * A Notification controller, ment to be used as
 * service throughout all other bundles.
 *
 * See:
 * http://symfony.com/doc/current/cookbook/controller/service.html
 * @package Nav\NotificationBundle\Controller
 */
class NotificationController extends Controller
{
    /**
     * Default flash message
     * @var array
     */
    private $defaults = ['type' => 'flash'];

    /**
     * @var array
     */
    private $flashes = [];

    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        // Nothing here, as this controller will be used as service.
    }


    /**
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        // Session Instance that is been injected
        // as described in services.yml.
        $this->session = $session;
    }

    /**
     * Adding messages to the flashbag
     *
     * @param string $name
     * @param array $arguments
     */
    public function add($name, array $arguments = [])
    {
        $arguments += $this->defaults;

        if ($arguments["type"] === "flash") {
            $this->session->getFlashBag()->add($name, $arguments);
        } elseif ($arguments["type"] === "instant") {
            if (!isset($this->flashes[$name])) {
                $this->flashes[$name] = array();
            }
            $this->flashes[$name][] = $arguments;
        }
    }

    /**
     * Check if notification exsists.
     */
    public function exists($name)
    {
        if ($this->session->getFlashBag()->has($name)) {
            return true;
        } else {
            return isset($this->flashes[$name]);
        }
    }

    /**
     * Get a notification
     */
    public function get($name)
    {
        if ($this->session->getFlashBag()->has($name) && isset($this->flashes[$name])) {
            return array_merge_recursive($this->session->getFlashBag()->get($name), $this->flashes[$name]);
        } elseif ($this->session->getFlashBag()->has($name)) {
            return $this->session->getFlashBag()->get($name);
        } else {
            return $this->flashes[$name];
        }
    }


    /**
     * Get all notifications
     */
    public function all()
    {
        return array_merge_recursive($this->session->getFlashBag()->all(), $this->flashes);
    }

}
