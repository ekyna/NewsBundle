<?php

namespace Ekyna\Bundle\NewsBundle\Controller\Admin;

use Ekyna\Bundle\AdminBundle\Controller\Resource\TinymceTrait;
use Ekyna\Bundle\AdminBundle\Controller\Resource\ToggleableTrait;
use Ekyna\Bundle\AdminBundle\Controller\ResourceController;

/**
 * Class NewsController
 * @package Ekyna\Bundle\NewsBundle\Controller\Admin
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class NewsController extends ResourceController
{
    use TinymceTrait;
    use ToggleableTrait;
}
