<?php

declare(strict_types=1);

namespace Ekyna\Bundle\NewsBundle\Model;

use DateTimeInterface;
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
    public function setName(string $name): NewsInterface;

    public function getName(): ?string;

    public function setTitle(string $title): NewsInterface;

    public function getTitle(): ?string;

    public function setContent(string $content): NewsInterface;

    public function getContent(): ?string;

    public function setSlug(string $slug): NewsInterface;

    public function getSlug(): ?string;

    public function setDate(DateTimeInterface $date): NewsInterface;

    public function getDate(): DateTimeInterface;

    public function setEnabled(bool $enabled): NewsInterface;

    public function getEnabled(): bool;
}
