<?php
namespace Flowpack\TypoScript\Browser\Command;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Cli\CommandController;
use TYPO3\Neos\Domain\Repository\SiteRepository;
use TYPO3\Neos\Domain\Service\ContentContext;
use TYPO3\Neos\Domain\Service\TypoScriptService;
use TYPO3\TYPO3CR\Domain\Service\ContextFactoryInterface;

/**
 * @Flow\Scope("singleton")
 */
class TypoScriptCommandController extends CommandController
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

    /**
     * @param string $sitePackageKey
     */
    public function listCommand($sitePackageKey)
    {
        $site = $this->siteRepository->findOneBySiteResourcesPackageKey($sitePackageKey);
        /** @var ContentContext $context */
        $context = $this->contextFactory->create(['currentSite' => $site]);

        $typoScriptTree = $this->typoScriptService->getMergedTypoScriptObjectTree($context->getCurrentSiteNode());

        \TYPO3\Flow\var_dump($typoScriptTree);
    }
}