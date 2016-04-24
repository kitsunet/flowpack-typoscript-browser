<?php
namespace Flowpack\TypoScript\Browser\Controller;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Neos\Controller\Module\AbstractModuleController;
use TYPO3\Neos\Domain\Repository\SiteRepository;
use TYPO3\Neos\Domain\Service\ContentContext;
use TYPO3\Neos\Domain\Service\TypoScriptService;
use TYPO3\TYPO3CR\Domain\Service\ContextFactoryInterface;

/**
 *
 */
class TypoScriptController extends AbstractModuleController
{
    /**
     * @Flow\Inject
     * @var TypoScriptService
     */
    protected $typoScriptService;

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

    public function initializeView(\TYPO3\Flow\Mvc\View\ViewInterface $view)
    {
        parent::initializeView($view);
    }

    /**
     *
     */
    public function indexAction()
    {
        $sites = $this->siteRepository->findAll();

        if (count($sites) === 1) {
//            $this->redirect('list', null, null, []);
        }
        $this->view->assign('sites', $sites);
    }

    /**
     * @param string $sitePackageKey
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
        $typoScriptTree = $this->typoScriptService->getMergedTypoScriptObjectTree($context->getCurrentSiteNode());
        $this->view->assign('typoScriptTree', $typoScriptTree);
    }
}