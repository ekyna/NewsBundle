<?php

declare(strict_types=1);

namespace Ekyna\Bundle\NewsBundle\Entity;

use Ekyna\Bundle\NewsBundle\Model\NewsTranslationInterface;
use Ekyna\Component\Resource\Model\AbstractTranslation;

/**
 * Class NewsTranslation
 * @package Ekyna\Bundle\NewsBundle\Entity
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class NewsTranslation extends AbstractTranslation implements NewsTranslationInterface
{
    protected ?string $title = null;
    protected ?string $content = null;
    protected ?string $slug = null;

    public function setTitle(?string $title): NewsTranslationInterface
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setContent(?string $content): NewsTranslationInterface
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setSlug(?string $slug): NewsTranslationInterface
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }
}
