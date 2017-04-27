<?php
namespace Flowpack\Fusion\Browser\Controller;

use Neos\ContentRepository\Domain\Service\ContextFactoryInterface;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\View\ViewInterface;
use Neos\Neos\Controller\Module\AbstractModuleController;
use Neos\Neos\Domain\Repository\SiteRepository;
use Neos\Neos\Domain\Service\ContentContext;
use Neos\Neos\Domain\Service\FusionService;

/**
 *
 */
class FusionController extends AbstractModuleController
{
    /**
     * @Flow\Inject
     * @var FusionService
     */
    protected $fusionService;

    /**
     * @Flow\Inject
     * @var ContextFactoryInterface
     */
    protected $contextFactory;

    /**
     * @Flow\Inject
     * @var SiteRepository
     */
    protected $siteRepository;

    /**
     * @param ViewInterface $view
     * @return void
     */
    public function initializeView(ViewInterface $view)
    {
        parent::initializeView($view);
    }

    /**
     * @return void
     */
    public function indexAction()
    {
        $sites = $this->siteRepository->findAll();

        if (count($sites) === 1) {
            $this->redirect('list', null, null, []);
        }
        $this->view->assign('sites', $sites);
    }

    /**
     * @param string $sitePackageKey
     * @return void
     */
    public function listAction($sitePackageKey = null)
    {
        if ($sitePackageKey === null) {
            $site = $this->siteRepository->findFirstOnline();
        } else {
            $site = $this->siteRepository->findOneBySiteResourcesPackageKey($sitePackageKey);
        }

        /** @var ContentContext $context */
        $context = $this->contextFactory->create(['currentSite' => $site]);
        $fusionTree = $this->fusionService->getMergedFusionObjectTree($context->getCurrentSiteNode());
        $this->view->assign('fusionTree', $fusionTree);
    }
}
