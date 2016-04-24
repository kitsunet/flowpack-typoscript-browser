<?php
namespace Flowpack\TypoScript\Browser\ViewHelpers;

use TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper;

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