<?php

namespace Sourceability\CodingStandard\PHPStan\Rules;

use PhpParser\Node;
use PhpParser\Node\Expr\BinaryOp;
use PhpParser\Node\Expr\BinaryOp\Identical;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\BooleansInConditions\BooleanRuleHelper;
use PHPStan\Rules\Rule;

class ConstantBooleanIdenticalRule implements Rule
{
    /**
     * @var ConstantBooleanRuleHelper
     */
    private $constantBooleanRuleHelper;

    /**
     * @var BooleanRuleHelper
     */
    private $booleanRuleHelper;

    public function __construct(
        ConstantBooleanRuleHelper $constantBooleanRuleHelper,
        BooleanRuleHelper $booleanRuleHelper
    ) {
        $this->constantBooleanRuleHelper = $constantBooleanRuleHelper;
        $this->booleanRuleHelper = $booleanRuleHelper;
    }

    public function getNodeType(): string
    {
        return Identical::class;
    }

    /**
     * @return string[] errors
     */
    public function processNode(Node $node, Scope $scope): array
    {
        if (!$node instanceof BinaryOp) {
            return [];
        }

        $constantBooleanTypeLeft = $this->constantBooleanRuleHelper->getNonMixedConstantBooleanType(
            $scope,
            $node->left
        );
        $constantBooleanTypeRight = $this->constantBooleanRuleHelper->getNonMixedConstantBooleanType(
            $scope,
            $node->right
        );

        if (null === $constantBooleanTypeLeft
            && null === $constantBooleanTypeRight
        ) {
            return [];
        }

        if (null !== $constantBooleanTypeLeft
            && null !== $constantBooleanTypeRight
        ) {
            return [];
        }

        if (null !== $constantBooleanTypeLeft) {
            if ($this->booleanRuleHelper->passesAsBoolean($scope, $node->right)) {
                if ($constantBooleanTypeLeft->getValue()) {
                    return ['Replace true === $boolean with $boolean'];
                }

                return ['Replace false === $boolean with !$boolean'];
            }
        }

        if (null !== $constantBooleanTypeRight) {
            if ($this->booleanRuleHelper->passesAsBoolean($scope, $node->right)) {
                if ($constantBooleanTypeRight->getValue()) {
                    return ['Replace $boolean === true with $boolean'];
                }

                return ['Replace $boolean === false with !$boolean'];
            }
        }

        return [];
    }
}
