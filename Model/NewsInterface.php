<?php

namespace Ekyna\Bundle\NewsBundle\Model;

use DateTime;
use Ekyna\Bundle\CmsBundle\Model as Cms;
use Ekyna\Bundle\MediaBundle\Model as Media;
use Ekyna\Bundle\NewsBundle\Entity\NewsTranslation;
use Ekyna\Component\Resource\Model as RM;

/**
 * Interface NewsInterface
 * @package Ekyna\Bundle\NewsBundle\Model
 * @author  Étienne Dauvergne <contact@ekyna.com>
 *
 * @method NewsTranslation translate($locale = null, $create = false)
 */
interface NewsInterface extends
    RM\TimestampableInterface,
    RM\TaggedEntityInterface,
    Cms\SeoSubjectInterface,
    Media\MediaSubjectInterface
{
    /**
     * Sets the name.
     *
     * @param string $name
     *
     * @return $this|NewsInterface
     */
    public function setName(string $name): NewsInterface;

    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName(): ?string;

    /**
     * Sets the title.
     *
     * @param string $title
     *
     * @return $this|NewsInterface
     */
    public function setTitle(string $title): NewsInterface;

    /**
     * Returns the title.
     *
     * @return string
     */
    public function getTitle(): ?string;

    /**
     * Sets the content.
     *
     * @param string $content
     *
     * @return $this|NewsInterface
     */
    public function setContent(string $content): NewsInterface;

    /**
     * Returns the content.
     *
     * @return string
     */
    public function getContent(): ?string;

    /**
     * Sets the slug.
     *
     * @param string $slug
     *
     * @return $this|NewsInterface
     */
    public function setSlug(string $slug): NewsInterface;

    /**
     * Returns the slug.
     *
     * @return string
     */
    public function getSlug(): ?string;

    /**
     * Sets the date.
     *
     * @param DateTime $date
     *
     * @return $this|NewsInterface
     */
    public function setDate(DateTime $date): NewsInterface;

    /**
     * Returns the date.
     *
     * @return DateTime
     */
    public function getDate(): DateTime;

    /**
     * Sets whether the news is enabled.
     *
     * @param boolean $enabled
     *
     * @return $this|NewsInterface
     */
    public function setEnabled(bool $enabled): NewsInterface;

    /**
     * Returns whether the news is enabled.
     *
     * @return bool
     */
    public function getEnabled(): bool;
}
