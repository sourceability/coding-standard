<?php

namespace Sourceability\CodingStandard\PHPCS\Sniffs;

use PHP_CodeSniffer\Files\File;
use PHP_CodeSniffer\Sniffs\Sniff;
use PhpCsFixer\Fixer\FixerInterface;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Tokens;
use function sprintf;
use const T_OBJECT_OPERATOR;
use const T_STRING;

class NoCollectionAliasesSniff implements Sniff
{
    private const FORBIDDEN_ALIASES = [
        'average' => 'avg',
        'some' => 'contains',
        'unlessEmpty' => 'whenNotEmpty',
        'unlessNotEmpty' => 'whenEmpty',
    ];

    public function register()
    {
        return [
            T_OBJECT_OPERATOR,
        ];
    }

    public function process(File $phpcsFile, $stackPtr): void
    {
        $tokens = $phpcsFile->getTokens();
        $collectLocation = $phpcsFile->findPrevious(T_STRING, $stackPtr - 1, null, false, 'collect', true);
        if ($collectLocation === false) {
            return;
        }

        $methodName = $tokens[$stackPtr + 1]['content'];
        if(array_key_exists($methodName, self::FORBIDDEN_ALIASES)) {
            $phpcsFile->addError(
                sprintf('Use of collection method alias "%s" is forbidden, use "%s" instead', $methodName, self::FORBIDDEN_ALIASES[$methodName]),
                $stackPtr,
                'ForbiddenAlias'
            );
        }
    }
}
