<?php

namespace Ekyna\Bundle\NewsBundle\Entity;

use DateTime;
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
     * @var DateTime
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

        $this->date = new DateTime();
        $this->enabled = false;
        $this->seo = new Seo();
    }

    /**
     * Returns the string representation.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->name ?: 'New news';
    }

    /**
     * @inheritDoc
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): NewsInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function setTitle(string $title): NewsInterface
    {
        $this->translate()->setTitle($title);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getTitle(): ?string
    {
        return $this->translate()->getTitle();
    }

    /**
     * @inheritDoc
     */
    public function setContent(string $content): NewsInterface
    {
        $this->translate()->setContent($content);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getContent(): ?string
    {
        return $this->translate()->getContent();
    }

    /**
     * @inheritDoc
     */
    public function setSlug(string $slug): NewsInterface
    {
        $this->translate()->setSlug($slug);

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSlug(): ?string
    {
        return $this->translate()->getSlug();
    }

    /**
     * @inheritDoc
     */
    public function setDate(DateTime $date): NewsInterface
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @inheritDoc
     */
    public function setEnabled(bool $enabled): NewsInterface
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @inheritDoc
     */
    public static function getEntityTagPrefix()
    {
        return 'ekyna_news.news';
    }
}
