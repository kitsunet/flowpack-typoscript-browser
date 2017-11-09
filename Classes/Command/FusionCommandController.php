<?php
namespace Flowpack\Fusion\Browser\Command;

use Neos\ContentRepository\Domain\Service\ContextFactoryInterface;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\Cli\CommandController;
use Neos\Neos\Domain\Repository\SiteRepository;
use Neos\Neos\Domain\Service\ContentContext;
use Neos\Neos\Domain\Service\FusionService;

/**
 * @Flow\Scope("singleton")
 */
class FusionCommandController extends CommandController
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
     * @param string $sitePackageKey
     * @return void
     */
    public function listCommand($sitePackageKey)
    {
        $site = $this->siteRepository->findOneBySiteResourcesPackageKey($sitePackageKey);
        /** @var ContentContext $context */
        $context = $this->contextFactory->create(['currentSite' => $site]);

        $fusionTree = $this->fusionService->getMergedFusionObjectTree($context->getCurrentSiteNode());

        \Neos\Flow\var_dump($fusionTree);
    }
}
