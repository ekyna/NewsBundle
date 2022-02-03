<?php

declare(strict_types=1);

namespace Ekyna\Bundle\NewsBundle\Entity;

use DateTime;
use DateTimeInterface;
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
    use Cms\SeoSubjectTrait;
    use Media\MediaSubjectTrait;
    use RM\TaggedEntityTrait;
    use RM\TimestampableTrait;

    protected ?string           $name = null;
    protected DateTimeInterface $date;
    protected bool              $enabled;

    public function __construct()
    {
        parent::__construct();

        $this->date = new DateTime();
        $this->enabled = false;
        $this->seo = new Seo();
    }

    public function __toString(): string
    {
        return $this->name ?: 'New news';
    }

    public function setName(string $name): NewsInterface
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setTitle(string $title): NewsInterface
    {
        $this->translate()->setTitle($title);

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->translate()->getTitle();
    }

    public function setContent(string $content): NewsInterface
    {
        $this->translate()->setContent($content);

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->translate()->getContent();
    }

    public function setSlug(string $slug): NewsInterface
    {
        $this->translate()->setSlug($slug);

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->translate()->getSlug();
    }

    public function setDate(DateTimeInterface $date): NewsInterface
    {
        $this->date = $date;

        return $this;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function setEnabled(bool $enabled): NewsInterface
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    public static function getEntityTagPrefix(): string
    {
        return 'ekyna_news.news';
    }
}
