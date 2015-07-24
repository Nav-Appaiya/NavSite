<?php

/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 31-3-2015
 * Time: 22:16.
 */

namespace Nav\CMSBundle\Externals;

class Track
{
    protected $hostname;

    public function __construct($hostname)
    {
        $this->hostname = $hostname;
    }

    /**
     * @return mixed
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * @param mixed $hostname
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;
    }
}
