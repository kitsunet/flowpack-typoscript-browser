<?php
namespace Flowpack\TypoScript\Browser\ViewHelpers;

use TYPO3\Flow\Utility\TypeHandling;
use TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 *
 */
class VariableTypeViewHelper extends AbstractViewHelper
{
    /**
     * @param mixed $variable
     * @return string
     */
    public function render($variable = null)
    {
        if ($variable === null) {
            $variable = $this->renderChildren();
        }
        $type =  TypeHandling::getTypeForValue($variable);

        if ($type === 'array' && (isset($variable['__prototypeObjectName']) || isset($variable['__meta']['class']))) {
            return 'array-prototype';
        }
        if ($type === 'array' && isset($variable['__eelExpression']) && $variable['__eelExpression'] !== '') {
            return 'array-eel';
        }
        if ($type === 'array' && isset($variable['__value']) && $variable['__value'] !== '') {
            return 'array-value';
        }
        if ($type === 'array' && isset($variable['__objectType']) && $variable['__objectType'] !== '' && count($variable) === 3) {
            return 'array-ts-object';
        }
        if ($type === 'array' && isset($variable['__objectType']) && $variable['__objectType'] !== '' && count($variable) > 3) {
            return 'array-ts-object-overwrite';
        }

        return $type;
    }
}