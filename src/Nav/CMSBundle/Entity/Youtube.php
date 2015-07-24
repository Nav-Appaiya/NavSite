<?php

namespace Nav\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Youtube.
 *
 * @ORM\Table("cms_youtube")
 * @ORM\Entity
 */
class Youtube
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="requested_ip", type="string", length=255)
     */
    private $requestedIp;

    /**
     * @var string
     *
     * @ORM\Column(name="computer_name", type="string", length=255)
     */
    private $computerName;

    /**
     * @return string
     */
    public function getComputerName()
    {
        return $this->computerName;
    }

    /**
     * @param string $computerName
     */
    public function setComputerName($computerName)
    {
        $this->computerName = $computerName;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return Youtube
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set requestedIp.
     *
     * @param string $requestedIp
     *
     * @return Youtube
     */
    public function setRequestedIp($requestedIp)
    {
        $this->requestedIp = $requestedIp;

        return $this;
    }

    /**
     * Get requestedIp.
     *
     * @return string
     */
    public function getRequestedIp()
    {
        return $this->requestedIp;
    }
}
