<?php

declare(strict_types=1);

namespace Ekyna\Bundle\NewsBundle\Model;

/**
 * Interface NewsTranslationInterface
 * @package Ekyna\Bundle\NewsBundle\Entity
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
interface NewsTranslationInterface
{
    public function setTitle(?string $title): NewsTranslationInterface;

    public function getTitle(): ?string;

    public function setContent(?string $content): NewsTranslationInterface;

    public function getContent(): ?string;

    public function setSlug(?string $slug): NewsTranslationInterface;

    public function getSlug(): ?string;
}
