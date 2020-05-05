<?php

namespace Ekyna\Bundle\NewsBundle\Entity;

use Ekyna\Component\Resource\Model\AbstractTranslation;

/**
 * Class News
 * @package Ekyna\Bundle\NewsBundle\Entity
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class NewsTranslation extends AbstractTranslation
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var string
     */
    protected $slug;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Sets the title.
     *
     * @param string $title
     *
     * @return NewsTranslation
     */
    public function setTitle(string $title): NewsTranslation
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Returns the title.
     *
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Sets the content.
     *
     * @param string $content
     *
     * @return NewsTranslation
     */
    public function setContent(string $content): NewsTranslation
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Returns the content.
     *
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * Sets the slug.
     *
     * @param string $slug
     *
     * @return NewsTranslation
     */
    public function setSlug(string $slug): NewsTranslation
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Returns the slug.
     *
     * @return string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
