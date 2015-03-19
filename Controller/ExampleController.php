<?php

namespace Ekyna\Bundle\NewsBundle\Controller;

use Ekyna\Bundle\CoreBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ExampleController
 * @package Ekyna\Bundle\NewsBundle\Controller
 * @author Étienne Dauvergne <contact@ekyna.com>
 */
class ExampleController extends Controller
{
    /**
     * Example index page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $currentPage = $request->query->get('page', 1);
        $repo = $this->get('ekyna_news.news.repository');
        $pager = $repo->createPager($currentPage, 12, true);

        return $this->render('EkynaNewsBundle:Example:index.html.twig', array(
            'pager' => $pager,
            'news'  => $pager->getCurrentPageResults(),
        ));
    }

    /**
     * Example detail page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function detailAction(Request $request)
    {
        $repo = $this->get('ekyna_news.news.repository');

        $news = $repo->findOneBySlug($request->attributes->get('slug'));

        if (null === $news) {
            throw new NotFoundHttpException('News not found.');
        }

        return $this->render('EkynaNewsBundle:Example:detail.html.twig', array(
            'news' => $news,
        ));
    }
}
