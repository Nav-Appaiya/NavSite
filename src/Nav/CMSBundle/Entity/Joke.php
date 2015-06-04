<?php
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 22-3-2015
 * Time: 20:12
 */

namespace Nav\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Joke
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Joke extends TimestampableEntity
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="string", length=36)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="text", nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="joke", type="text", nullable=true)
     */
    private $joke;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getJoke()
    {
        return $this->joke;
    }

    /**
     * @param mixed $joke
     */
    public function setJoke($joke)
    {
        $this->joke = $joke;
    }
}