<?php
namespace Flowpack\Fusion\Browser\ViewHelpers;

use Neos\FluidAdaptor\Core\ViewHelper\AbstractViewHelper;

/**
 *
 */
class Md5ViewHelper extends AbstractViewHelper
{
    /**
     * @param string $input
     * @return mixed
     */
    public function render($input = null)
    {
        if ($input === null) {
            $input = $this->renderChildren();
        }
        return md5($input);
    }
}
