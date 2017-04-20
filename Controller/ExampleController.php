<?php

declare(strict_types=1);

namespace Ekyna\Bundle\NewsBundle\Controller;

use Ekyna\Bundle\NewsBundle\Entity\News;
use Ekyna\Bundle\NewsBundle\Repository\NewsRepositoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Twig\Environment;

/**
 * Class ExampleController
 * @package Ekyna\Bundle\NewsBundle\Controller
 * @author  Étienne Dauvergne <contact@ekyna.com>
 */
class ExampleController
{
    private NewsRepositoryInterface $newsRepository;
    private Environment             $twig;

    public function __construct(NewsRepositoryInterface $newsRepository, Environment $twig)
    {
        $this->newsRepository = $newsRepository;
        $this->twig = $twig;
    }

    /**
     * Example index page.
     */
    public function index(Request $request): Response
    {
        $currentPage = $request->query->getInt('page', 1);

        $pager = $this
            ->newsRepository
            ->createFrontPager($currentPage, 12);

        /** @var News[] $news */
        $news = $pager->getCurrentPageResults();

        $content = $this->twig->render('@EkynaNews/Example/index.html.twig', [
            'pager' => $pager,
            'news'  => $news,
        ]);

        return new Response($content);
    }

    /**
     * Example detail page.
     */
    public function detail(Request $request): Response
    {
        $news = $this
            ->newsRepository
            ->findOneBySlug($request->attributes->get('slug'));

        if (null === $news) {
            throw new NotFoundHttpException('News not found.');
        }

        $latest = $this->newsRepository->findLatest()->getIterator();

        $content = $this->twig->render('@EkynaNews/Example/detail.html.twig', [
            'news'   => $news,
            'latest' => $latest,
        ]);

        return new Response($content);
    }
}
