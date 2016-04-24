<?php
namespace Flowpack\TypoScript\Browser\ViewHelpers;

use TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 *
 */
class RemoveHiddenMetaViewHelper extends AbstractViewHelper
{
    /**
     * @param array $value
     * @return array
     */
    public function render(array $value = null)
    {
        if ($value === null) {
            $value = $this->renderChildren();
        }

        unset($value['__objectType']);
        unset($value['__eelExpression']);
        unset($value['__value']);
        unset($value['__prototypeObjectName']);
        return $value;
    }
}