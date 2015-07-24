<?php

namespace Nav\SEOShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * shop.
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class shop
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="api_key", type="string", length=255, nullable=true)
     */
    private $apiKey;

    /**
     * @var string
     *
     * @ORM\Column(name="api_secret", type="string", length=255, nullable=true)
     */
    private $apiSecret;

    /**
     * @var string
     *
     * @ORM\Column(name="info", type="string", length=255, nullable=true)
     */
    private $info;

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
     * Set name.
     *
     * @param string $name
     *
     * @return shop
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set apiKey.
     *
     * @param string $apiKey
     *
     * @return shop
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get apiKey.
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set apiSecret.
     *
     * @param string $apiSecret
     *
     * @return shop
     */
    public function setApiSecret($apiSecret)
    {
        $this->apiSecret = $apiSecret;

        return $this;
    }

    /**
     * Get apiSecret.
     *
     * @return string
     */
    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    /**
     * Set info.
     *
     * @param string $info
     *
     * @return shop
     */
    public function setInfo($info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get info.
     *
     * @return string
     */
    public function getInfo()
    {
        return $this->info;
    }
}
