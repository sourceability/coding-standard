<?php

namespace Sourceability\CodingStandard\PHPCS\Sniffs;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;

use const T_CLASS_C;
use const T_FUNC_C;
use const T_LINE;
use const T_METHOD_C;
use const T_NS_C;
use const T_TRAIT_C;

class ForbiddenConstantSniff implements Sniff
{
    public function register()
    {
        return [
            T_LINE,
            T_FUNC_C,
            T_CLASS_C,
            T_TRAIT_C,
            T_METHOD_C,
            T_NS_C,
        ];
    }

    public function process(File $phpcsFile, $stackPtr): void
    {
        $tokens = $phpcsFile->getTokens();
        $keyword = $tokens[$stackPtr]['content'];

        $phpcsFile->addError('Using the %s constant is forbidden.', $stackPtr, 'code', [$keyword]);
    }
}
