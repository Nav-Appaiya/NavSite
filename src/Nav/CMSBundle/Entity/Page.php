<?php namespace Nav\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** * Page * * @ORM\Table("page") * @ORM\Entity */
class Page extends TimestampableEntity
{
    /**     * @var integer     *     * @ORM\Column(name="id", type="integer")     * @ORM\Id     * @ORM\GeneratedValue(strategy="AUTO") */
    private $id;
    /**     * @var string     *     * @ORM\Column(name="title", type="string", length=255) */
    private $title;
    /**     * @var string     *     * @ORM\Column(name="content", type="text") */
    private $content;
    /**     * @ORM\ManyToOne(targetEntity="Category", inversedBy="pages")     * @ORM\JoinColumn(name="category_id", referencedColumnName="id") */
    private $category;

    /**     * @return string */
    public function getFeed()
    {
        return $this->feed;
    }

    /**     * @param string $feed */
    public function setFeed($feed)
    {
        $this->feed = $feed;
    }

    /**     * @var string     *     * @ORM\Column(name="feed", type="string") */
    private $feed;

    /**     * Get id     *     * @return integer */
    public function getId()
    {
        return $this->id;
    }

    /**     * Set title     *     * @param string $title * @return Page */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**     * Get title     *     * @return string */
    public function getTitle()
    {
        return $this->title;
    }

    /**     * Set content     *     * @param string $content * @return Page */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**     * Get content     *     * @return string */
    public function getContent()
    {
        return $this->content;
    }

    /**     * Set category     *     * @param string $category * @return Page */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**     * Get category     *     * @return string */
    public function getCategory()
    {
        return $this->category;
    }
}
