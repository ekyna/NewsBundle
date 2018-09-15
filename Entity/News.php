<?php

namespace Ekyna\Bundle\NewsBundle\Entity;

use Ekyna\Bundle\CmsBundle\Entity\Seo;
use Ekyna\Bundle\CmsBundle\Model as Cms;
use Ekyna\Bundle\MediaBundle\Model as Media;
use Ekyna\Bundle\NewsBundle\Model\NewsInterface;
use Ekyna\Component\Resource\Model as RM;

/**
 * Class News
 * @package Ekyna\Bundle\NewsBundle\Entity
 * @author  Étienne Dauvergne <contact@ekyna.com>
 *
 * @method NewsTranslation translate($locale = null, $create = false)
 */
class News extends RM\AbstractTranslatable implements NewsInterface
{
    use RM\TimestampableTrait,
        RM\TaggedEntityTrait,
        Cms\SeoSubjectTrait,
        Media\MediaSubjectTrait;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \DateTime
     */
    protected $date;

    /**
     * @var boolean
     */
    protected $enabled;


    /**
     * Constructor.
     *
     * @inheritDoc
     */
    public function __construct()
    {
        parent::__construct();

        $this->date = new \DateTime();
        $this->enabled = false;
        $this->seo = new Seo();
    }

    /**
     * Returns the string representation.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return News
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return News
     */
    public function setTitle($title)
    {
        $this->translate()->setTitle($title);

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->translate()->getTitle();
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return News
     */
    public function setContent($content)
    {
        $this->translate()->setContent($content);

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->translate()->getContent();
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return News
     */
    public function setSlug($slug)
    {
        $this->translate()->setSlug($slug);

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->translate()->getSlug();
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return News
     */
    public function setDate(\DateTime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return News
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritdoc}
     */
    public static function getEntityTagPrefix()
    {
        return 'ekyna_news.news';
    }
}
